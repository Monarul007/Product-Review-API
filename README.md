# Product-Review-API
A simple REST API endpoint using PHP (without any frameworks like Laravel) that allows a user to submit a product review. The endpoint accepts POST requests with JSON data containing a product ID, user ID, and the review text. Ensures basic validation of the input data and return an appropriate response.

## Installation

Upload script folder somewhere and enjoy!
For local development you may run PHP's built-in web server:
`php -S localhost:8080`

## Configuration
Edit the following lines in the bottom of the file "config/Database.php":

```php
    private $host = 'xxx';
    private $dbname = 'xxx';
    private $dbusername = 'xxx';
    private $dbpassword = 'xxx';
```

### Create
If you want to create a record the request can be written in URL format as:
`POST /`

You have to send a body containing:
```json
{
    "userID": 1,
    "productID": 10,
    "reviewText": "<p>Very Good & Effective Product</p>"
}
```
And it will return the status code 200 And response:
```json
{
    "error": false,
    "status": 200,
    "message": "Product Review Submitted Successfully!"
}
```

To Ensure basic validation of the input data provide invalid data and it will return an appropriate response like below:
```json
{
    "error": true,
    "status": 422,
    "message": [
        "Please provide an user ID",
        "Please provide a product ID",
        "Please provide a review text",
        "Please provide a valid integer type user ID",
        "Please provide a valid integer type product ID"
    ]
}
```