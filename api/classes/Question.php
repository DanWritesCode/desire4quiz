<?php
require_once("./classes/Answer.php");

class Question {
  private $id;
  private $quizId = null;
  private $question = null;
  private $marks = null;
  private $answers = null;

  public function __construct($id, $data = array()) {
    $this->id = $id;
    foreach($data as $key => $value) {
      $this->$key = $value;
    }

  }

  public function export($exportAnswers = true) {
      if($exportAnswers && $this->answers != null && sizeof($this->answers) > 0) {
        $r = ["id" => $this->getId(), "question" => $this->getQuestion(), "marks" => $this->getMarks()];
        $as = [];
        foreach($this->getAnswers() as $a)
          $as[] = $a->export(false);
        $r["answers"] = $as;
        return $r;
      }
      return ["id" => $this->getId(), "question" => $this->getQuestion(), "marks" => $this->getMarks()];
  }

  public function load($conn, $loadAnswers = true) {
    $stmt = $conn->prepare("SELECT quizId, question, marks FROM questions WHERE id = ?;");
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
    $stmt->bind_result($this->quizId, $this->question, $this->marks);
    $r = $stmt->fetch();
    if(!$r)
      return false;

    $stmt->close();

    if($loadAnswers)
      $this->answers = Answer::getAnswersForQuiz($conn, $this->id);

    return true;
  }

  public static function getQuestionsForQuiz($conn, $quizId) {
    $stmt = $conn->prepare("SELECT id, question, marks FROM questions WHERE quizId = ?;");
    $stmt->bind_param("i", $quizId);
    $stmt->execute();

    $questions = [];

    $id = 0; $question = null; $marks = null;
    $stmt->bind_result($id, $question, $marks);
    while($row = $stmt->fetch()) {
      $data = array(
        "quizId" => $quizId,
        "question" => $question,
        "marks" => $marks
      );
      $questions[] = new Question($id, $data);
    }
    $stmt->close();

    // Get answers
    foreach($questions as $question)
      $question->setAnswers(Answer::getAnswersForQuiz($conn, $question->getId()));

    return $questions;
  }

  /**
   * @return null
   */
  public function getId() {
    return $this->id;
  }

  /**
   * @param null $id
   */
  public function setId($id) {
    $this->id = $id;
  }

  /**
   * @return null
   */
  public function getQuizId() {
    return $this->quizId;
  }

  /**
   * @param null $quizId
   */
  public function setQuizId($quizId) {
    $this->quizId = $quizId;
  }

  /**
   * @return null
   */
  public function getQuestion() {
    return $this->question;
  }

  /**
   * @param null $question
   */
  public function setQuestion($question) {
    $this->question = $question;
  }

  /**
   * @return null
   */
  public function getMarks() {
    return $this->marks;
  }

  /**
   * @param null $marks
   */
  public function setMarks($marks) {
    $this->marks = $marks;
  }

  /**
   * @return null
   */
  public function getAnswers() {
    return $this->answers;
  }

  /**
   * @param null $answers
   */
  public function setAnswers($answers) {
    $this->answers = $answers;
  }

}
