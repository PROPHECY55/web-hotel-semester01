<?php if (!isLoggedIn()) : ?>
<?php

    include("dbaccess.php");

    // Sanitize input data (against SQL-Injections)
    function sanitizeInput($data)
    {
        global $conn;
        return mysqli_real_escape_string($conn, htmlspecialchars($data));
    }

    // Form handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve user inputs
        $salutation = sanitizeInput($_POST["salutation"]);
        $firstname = sanitizeInput($_POST["firstname"]);
        $lastname = sanitizeInput($_POST["lastname"]);
        $email = sanitizeInput($_POST["email"]);
        $username = sanitizeInput($_POST["username"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash pw

        // Check if email or username already exist
        $checkExisting = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
        $result = $conn->query($checkExisting);

        if ($result->num_rows > 0) {
            // User with same email or username already exists
            $_SESSION['error_message'] = "Error: Eingegebene E-Mail oder Benutzername existiert bereits. Bitte wählen Sie einen anderen.";
        } else {
            $currentDateTime = date("Y-m-d H:i:s");

            // Default values for role and status
            $defaultRole = "user";
            $defaultStatus = "active";

            // Insert user into dtabase
            $sql = "INSERT INTO users (salutation, firstname, lastname, email, username, password, acc_created, role, status) VALUES ('$salutation', '$firstname', '$lastname', '$email', '$username', '$password', '$currentDateTime', '$defaultRole', '$defaultStatus')";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['success_message'] = "User erfolgreich registriert!";
                sleep(1);
                header("Location: ../index.php?page=home");
                exit();
            } else {
                $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();

    header("Location: index.php?page=register");
    exit();
?>
<?php endif; ?>