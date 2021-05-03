<?php
// Some PHP debug lines here
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
    GET /quiz/id - Gets the quiz information by ID (name, description, etc)
    POST /quiz/id - Starts the quiz and gets the questions
    PUT /quiz/id - Stores and processes answers, grading if available
*/
// An isset a day makes the error go away
if(!isset($request) || !isset($request["sliced"]))
  renderError("Failure.");

// All endpoints require a quizId..
if(sizeof($request["sliced"]) < 3)
  renderError("Insufficient arguments - " . sizeof($request["sliced"]));

require_once("classes/Quiz.php");

// A valid quizId that is..
$quizId = $request["sliced"][2];
validate([$quizId => "int"]);

// Load Quiz
$q = new Quiz($quizId);
$r = $q->load($conn, true);
if(!$r)
  renderError("Quiz not found", 404);

if($request["type"] == "GET") {
  die(json_encode($q->export(false)));

} else if($request["type"] == "POST") {
  die(json_encode($q->export(true)));

} else if($request["type"] == "PUT") {
  // Process answers, grade
  $response = $q->export(false);
  unset($response["description"]);
  unset($response["timeAllowed"]);
  $response["autoGrade"] = boolval($q->isAutoGrade());

  if(!empty($request["input"]) && sizeof($request["input"]) > 0) {
    $qs = $q->getQuestions();
    foreach($request["input"] as $key=>$val) {
      foreach($qs as $myQ) {
        if($myQ->getId() == $key) {
          $myQ->setResponse($val);
          // TODO put answer in sql
          break;
        }
      }
    }

    if($q->isAutoGrade()) {
      $marks = $q->grade();

      $response["grade"] = [];
      $response["grade"]["totalMarks"] = $q->getTotalMarks();
      $response["grade"]["marks"] = $marks;
      $response["grade"]["percentage"] = $marks/$q->getTotalMarks();
    }
    die(json_encode($response));
  } else {
    renderError("Cannot PUT answers - no valid answers provided!");
  }

}
