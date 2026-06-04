<?php
// Connection details
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

// Get form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password for security

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $username, $email, $password);

    if ($stmt->execute()) {
        // Display the welcome page after successful registration
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Registration Successful</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    text-align: center;
                    background-color: #f4f4f9;
                    margin: 0;
                    padding: 0;
                }
                .success-container {
                    margin-top: 50px;
                    padding: 20px;
                    background: #fff;
                    border: 2px solid #4caf50;
                    border-radius: 10px;
                    display: inline-block;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #4caf50;
                }
                p {
                    font-size: 16px;
                    color: #555;
                }
                .countdown {
                    margin: 20px auto;
                    width: 100px;
                    height: 100px;
                    border: 10px solid #4caf50;
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 20px;
                    font-weight: bold;
                    color: #4caf50;
                    animation: countdown-animation 5s linear forwards;
                }
                @keyframes countdown-animation {
                    from {
                        transform: rotate(0deg);
                    }
                    to {
                        transform: rotate(360deg);
                    }
                }
                a {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    color: #fff;
                    background-color: #4caf50;
                    text-decoration: none;
                    border-radius: 5px;
                    transition: 0.3s;
                }
                a:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <div class='success-container'>
                <h2>Welcome, $username!</h2>
                <p>Your registration was successful. We're excited to have you on board!</p>
                <p>You will be redirected to the login page in <span id='countdown'>5</span> seconds.</p>
                <div class='countdown'>5</div>
                <a href='login.html'>Go to Login Page</a>
            </div>
            <script>
                let countdown = 5;
                const countdownElement = document.getElementById('countdown');
                const countdownDiv = document.querySelector('.countdown');

                const timer = setInterval(() => {
                    countdown--;
                    countdownElement.textContent = countdown;
                    countdownDiv.textContent = countdown;

                    if (countdown === 0) {
                        clearInterval(timer);
                        window.location.href = 'login.html';
                    }
                }, 1000);
            </script>
        </body>
        </html>
        ";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
