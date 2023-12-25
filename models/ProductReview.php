<?php

class ProductReview{

    /**
     * @var PDO
     */
    private $conn;
    private $table = "product_reviews";

    // Product review properties
    public $reviewID;
    public $userID;
    public $productID;
    public $reviewText;
    public $errorBag = [];

    public function __construct($db){
        $this->conn = $db;
    }

    // Validate Input Fields
    private function validateReview(){
        if(empty($this->userID)){
            array_push($this->errorBag, 'Please provide an user ID');
        }
        if(empty($this->productID)){
            array_push($this->errorBag, 'Please provide a product ID');
        }
        if(empty($this->reviewText)){
            array_push($this->errorBag, 'Please provide a review text');
        }
        if(!is_int($this->userID)){
            array_push($this->errorBag, 'Please provide a valid integer type user ID');
        }
        if(!is_int($this->productID)){
            array_push($this->errorBag, 'Please provide a valid integer type product ID');
        }

        if(!empty($this->errorBag)){
            return false;
        }

        return true;
    }

    // Create or insert new product review
    public function create(){

        if($this->validateReview()){

            try {
                
                // Prepare the query
                $query = "INSERT INTO ".$this->table." SET userID = :userID, productID = :productID, reviewText = :reviewText";

                // Prepare the statement
                $stmt = $this->conn->prepare($query);

                // Sanitize Data
                $this->userID = filter_var($this->userID, FILTER_SANITIZE_NUMBER_INT);
                $this->productID = filter_var($this->productID, FILTER_SANITIZE_NUMBER_INT);
                $this->reviewText = filter_var($this->reviewText, FILTER_SANITIZE_STRING);

                // Bind params
                $stmt->bindParam(":userID", $this->userID);
                $stmt->bindParam(":productID", $this->productID);
                $stmt->bindParam(":reviewText", $this->reviewText);

                if($stmt->execute()){
                    return true;
                }

            } catch (\Throwable $th) {
                //throw $th;
                array_push($this->errorBag, $th->getMessage());
                return false;
            }
        }

        return false;
    }
}