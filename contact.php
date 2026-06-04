<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "watpure_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Display confirmation message
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Message Sent</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    background-color: #f4f4f9;
                    padding: 50px;
                }
                .message-box {
                    margin: 20px auto;
                    padding: 20px;
                    border: 2px solid #4caf50;
                    background-color: #fff;
                    border-radius: 10px;
                    display: inline-block;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                }
                h1 {
                    color: #4caf50;
                }
                p {
                    color: #333;
                    font-size: 1.2em;
                }
                .main-button {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    color: #fff;
                    background-color: #4caf50;
                    text-decoration: none;
                    border-radius: 5px;
                    transition: 0.3s;
                    font-size: 1.1em;
                }
                .main-button:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <div class='message-box'>
                <h1>Thank You, $name!</h1>
                <p>Your message has been sent successfully. We will get back to you shortly.</p>
                <a href='indexx.html' class='main-button'>Go to Main Page</a>
            </div>
        </body>
        </html>
        ";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
