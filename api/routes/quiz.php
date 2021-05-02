<?php
// Some PHP debug lines here
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

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

if($request["type"] == "GET") {
    $q = new Quiz($quizId);
    $r = $q->load($conn);
    if(!$r)
      renderError("Quiz not found", 404);

    die(json_encode($q->export(false)));

} else if($request["type"] == "POST") {
  $q = new Quiz($quizId);
  $r = $q->load($conn, true);
  if(!$r)
    renderError("Quiz not found", 404);

  die(json_encode($q->export(true)));
}
