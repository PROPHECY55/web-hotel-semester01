<?php if (!isLoggedIn()) : ?>
<?php
    include("dbaccess.php");

    // Sanitize input data (against MySQL-Injection)
    function sanitizeInput($data)
    {
        global $conn;
        return mysqli_real_escape_string($conn, htmlspecialchars($data));
    }

    // Form handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve user inputs
        $username = sanitizeInput($_POST["username"]);
        $password = $_POST["password"]; // Password not hashed here!! Need for Vergleich

        // Check if user exists
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User found, check password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Check if user status is active
                if ($row["status"] === 'active') {
                    // Start session and set user info in session variables
                    session_start();
                    $_SESSION["username"] = $username;
                    $_SESSION["role"] = $row["role"];
                    $_SESSION["status"] = $row["status"];

                    // Success
                    header("Location: ../index.php?page=home&message=success");
                    exit();
                } else {
                    // Inactive
                    header("Location: ../index.php?page=home&message=inactive");
                    exit();
                }
            } else {
                // Incorrect PW
                header("Location: ../index.php?page=home&message=incorrect");
                exit();
            }
        } else {
            // User not found
            header("Location: ../index.php?page=home&message=notfound");
            exit();
        }
    }

    $conn->close();
?>
<?php endif; ?>