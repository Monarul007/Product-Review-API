<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");

include_once "config/Database.php";
include_once "models/ProductReview.php";

// Initialize the database & connect to it
$database = new Database();
$thedb = $database->connect();

// Get data from request
$data = json_decode(file_get_contents("php://input"));

$response = array();

// Save product review
$productReview = new ProductReview($thedb);
if(empty($data)){
    array_push($productReview->errorBag, "Please provide all the required fields");
    $response["status"] = 422;
    $response["message"] = $productReview->errorBag;

    echo json_encode($response);

    exit;
}

$productReview->userID = $data->userID;
$productReview->productID = $data->productID;
$productReview->reviewText = $data->reviewText;

if($productReview->create()){
    $response["error"] = false;
    $response["status"] = 200;
    $response["message"] = "Product Review Submitted Successfully!";
}else{
    $response["error"] = true;
    $response["status"] = 422;
    $response["message"] = $productReview->errorBag;
}

echo json_encode($response);