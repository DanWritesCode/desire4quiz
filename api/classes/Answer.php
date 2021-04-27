<?php
class Answer {
  private $id;
  private $questionId = null;
  private $answerType = null;
  private $answerText = null;
  private $correctAnswer = null;


  public function __construct($id, $data = array()) {
    $this->id = $id;
    foreach($data as $key => $value) {
      $this->$key = $value;
    }
  }

  public function export($includeCorrect = false) {
    if($includeCorrect && $this->correctAnswer != null && sizeof($this->correctAnswer) > 0) {
      return ["id" => $this->getId(), "question" => $this->getQuestionId(), "answerType" => $this->getAnswerType(), "answerText" => $this->getAnswerText(), "correctAnswer" => $this->correctAnswer];
    }
    return ["id" => $this->getId(), "question" => $this->getQuestionId(), "answerType" => $this->getAnswerType(), "answerText" => $this->getAnswerText()];
  }

  public function load($conn) {
    $stmt = $conn->prepare("SELECT id, answerType, answerText, correctAnswer FROM answers WHERE questionId = ?;");
    $stmt->bind_param("i", $this->questionId);
    $stmt->execute();
    $stmt->bind_result($this->id, $this->answerType, $this->answerText, $this->correctAnswer);
    $r = $stmt->fetch();
    if(!$r)
      return false;

    $stmt->close();
    return true;
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
  public function getQuestionId() {
    return $this->questionId;
  }

  /**
   * @param null $questionId
   */
  public function setQuestionId($questionId) {
    $this->questionId = $questionId;
  }

  /**
   * @return null
   */
  public function getAnswerType() {
    return $this->answerType;
  }

  /**
   * @param null $answerType
   */
  public function setAnswerType($answerType) {
    $this->answerType = $answerType;
  }

  /**
   * @return null
   */
  public function getAnswerText() {
    return $this->answerText;
  }

  /**
   * @param null $answer
   */
  public function setAnswerText($answer) {
    $this->answerText = $answer;
  }

  public static function getAnswersForQuiz($conn, $questionId) {
    $stmt = $conn->prepare("SELECT id, answerType, answerText, correctAnswer FROM answers WHERE questionId = ?;");
    $stmt->bind_param("i", $questionId);
    $stmt->execute();

    $answers = [];
    $id = 0; $answerType = null; $answerText = null; $correctAnswer = null;
    $stmt->bind_result($id, $answerType, $answerText, $correctAnswer);
    while($row = $stmt->fetch()) {
      $data = array(
        "questionId" => $questionId,
        "answerType" => $answerType,
        "answerText" => $answerText,
        "correctAnswer" => $correctAnswer,
      );
      $answers[] = new Answer($id, $data);
    }

    $stmt->close();
    return $answers;
  }

}
