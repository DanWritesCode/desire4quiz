<?php
require_once("./classes/Question.php");

class Quiz {
  private $id = null;
  private $title = null;
  private $questions = null;
  private $description = null;
  private $timeAllowed = null;
  private $autoGrade = false;
  private $totalMarks = 0;

  public function __construct($id, $data = array()) {
    $this->id = $id;
  }

  public function export($exportQuestions = true) {
    if ($exportQuestions && $this->questions != null && sizeof($this->questions) > 0) {
      $r = ["id" => $this->getId(), "title" => $this->getTitle(), "description" => $this->getDescription(), "timeAllowed" => $this->getTimeAllowed()];
      $qs = [];
      foreach ($this->getQuestions() as $q) $qs[] = $q->export();
      $r["questions"] = $qs;
      return $r;
    }

    return ["id" => $this->getId(), "title" => $this->getTitle(), "description" => $this->getDescription(), "timeAllowed" => $this->getTimeAllowed()];
  }

  public function load($conn, $loadQuestions = false) {
    $stmt = $conn->prepare("SELECT `title`, `description`, `timeAllowedMins`, `autoGrade` FROM quizzes WHERE id = ?;");
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
    $stmt->bind_result($this->title, $this->description, $this->timeAllowed, $this->autoGrade);
    $r = $stmt->fetch();
    if (!$r) return false;
    $stmt->close();

    if ($loadQuestions) {
      $this->questions = Question::getQuestionsForQuiz($conn, $this->id);
      $totalMarks = 0;
      foreach ($this->getQuestions() as $question) {
        $totalMarks += $question->getMarks();
      }
      $this->setTotalMarks($totalMarks);
    }

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
  public function getTitle() {
    return $this->title;
  }

  /**
   * @param null $title
   */
  public function setTitle($title) {
    $this->title = $title;
  }

  /**
   * @return null
   */
  public function getQuestions() {
    return $this->questions;
  }

  /**
   * @param null $questions
   */
  public function setQuestions($questions) {
    $this->questions = $questions;
  }

  /**
   * @return null
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @return null
   */
  public function getTimeAllowed() {
    return $this->timeAllowed;
  }

  /**
   * @return bool
   */
  public function isAutoGrade() {
    return $this->autoGrade;
  }

  /**
   * @param bool $autoGrade
   */
  public function setAutoGrade($autoGrade) {
    $this->autoGrade = $autoGrade;
  }

  /**
   * @return int
   */
  public function getTotalMarks(): int {
    return $this->totalMarks;
  }

  /**
   * @param int $totalMarks
   */
  public function setTotalMarks(int $totalMarks) {
    $this->totalMarks = $totalMarks;
  }

  public function grade() {
    $totalMarks = 0;

    foreach ($this->getQuestions() as $question) {
      foreach ($question->getAnswers() as $answer) {
        if ($answer->getAnswerType() == "MC") {
          // Multiple-choice type answers (also used for True/False type answers)
          if ($answer->getCorrectAnswer() == 1 && $answer->getId() == $question->getResponse()) {
            $totalMarks += $question->getMarks();
            break;
          }
        } else if ($answer->getAnswerType() == "EQ") {
          // Textbox type answers, where the answer is done by direct comparison
          if (strtolower($answer->getCorrectAnswer()) == strtolower($question->getResponse())) {
            $totalMarks += $question->getMarks();
            break;
          }
        }
      }
    }

    return $totalMarks;
  }

}
