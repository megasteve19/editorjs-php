<?php 

// Initialize the json handler.
$jsonHandler = new \Megasteve19\EditorJS\JsonHandler();

// Set the sample JSON string.
$jsonHandler->setJson($sampleData);

// Dump the parsed JSON.
// print_r($jsonHandler->toArray());

// Set the sample data.
$jsonHandler->setData($jsonHandler->toArray());

// Dump the JSON string.
// print_r($jsonHandler->toJson());

// Works fine!
