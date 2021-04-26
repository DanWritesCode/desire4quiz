<?php
require_once("./classes/Question.php");

class Quiz {
  private $id = null;
  private $title = null;
  private $questions = null;

  public function __construct($id, $data = array()) {
    $this->id = $id;
  }

  public function export($exportQuestions = true) {
    if($exportQuestions && $this->questions != null && sizeof($this->questions) > 0) {
      $r = ["id" => $this->getId(), "title" => $this->getTitle()];
      $qs = [];
      foreach($this->getQuestions() as $q)
        $qs[] = $q->export();
      $r["questions"] = $qs;
      return $r;
    }

    return ["id" => $this->getId(), "title" => $this->getTitle()];
  }

  public function load($conn, $loadQuestions = false) {
    $stmt = $conn->prepare("SELECT title FROM quizzes WHERE id = ?;");
    $stmt->bind_param("i", $this->id);
    $stmt->execute();
    $stmt->bind_result($this->title);
    $r = $stmt->fetch();
    if(!$r)
      return false;
    $stmt->close();

    if($loadQuestions)
      $this->questions = Question::getQuestionsForQuiz($conn, $this->id);

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


}