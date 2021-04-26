<?php
class Answer {
  private $id;
  private $questionId = null;
  private $answerType = null;
  private $answer = null;

  public function __construct($id, $data = array()) {
    $this->id = $id;
  }

  public function export($includeAnswers = false) {
    // TODO
    return [];
  }

  public function load($conn) {
    $stmt = $conn->prepare("SELECT id, answerType, answer FROM answers WHERE questionId = ?;");
    $stmt->bind_param("i", $this->questionId);
    $stmt->execute();
    $stmt->bind_result($this->id, $this->answerType, $this->answer);
    $r = $stmt->fetch();
    if(!$r)
      return false;

    $stmt->close();
    return true;
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
  public function getAnswer() {
    return $this->answer;
  }

  /**
   * @param null $answer
   */
  public function setAnswer($answer) {
    $this->answer = $answer;
  }

  public static function getAnswersForQuiz($conn, $questionId) {
    $stmt = $conn->prepare("SELECT id, answerType, answer FROM answers WHERE questionId = ?;");
    $stmt->bind_param("i", $questionId);
    $stmt->execute();

    $answers = [];
    $id = 0; $answerType = null; $answer = null;
    $stmt->bind_result($id, $answerType, $answer);
    while($row = $stmt->fetch()) {
      $data = array(
        "questionId" => $questionId,
        "answerType" => $answerType,
        "answer" => $answer
      );
      $answers[] = new Answer($id, $data);
    }

    $stmt->close();
    return $answers;
  }

}
