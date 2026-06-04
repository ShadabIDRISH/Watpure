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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Display the welcome page after successful login
            echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Login Successful</title>
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
                    .load-bar-container {
                        position: relative;
                        width: 300px;
                        height: 20px;
                        margin: 20px auto;
                        background: #ddd;
                        border-radius: 10px;
                        overflow: hidden;
                    }
                    .load-bar {
                        width: 0;
                        height: 100%;
                        background: #4caf50;
                        animation: loadbar-animation 5s linear forwards;
                    }
                    @keyframes loadbar-animation {
                        from {
                            width: 0%;
                        }
                        to {
                            width: 100%;
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
                    <p>You have successfully logged in. We're happy to see you again!</p>
                    <p>You will be redirected to the homepage in <span id='countdown'>5</span> seconds.</p>
                    <div class='load-bar-container'>
                        <div class='load-bar'></div>
                    </div>
                    <a href='indexx.html'>Go to Home Page</a>
                </div>
                <script>
                    let countdown = 5;
                    const countdownElement = document.getElementById('countdown');

                    const timer = setInterval(() => {
                        countdown--;
                        countdownElement.textContent = countdown;

                        if (countdown === 0) {
                            clearInterval(timer);
                            window.location.href = 'indexx.html';
                        }
                    }, 1000);
                </script>
            </body>
            </html>
            ";
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
    $conn->close();
}
?>
