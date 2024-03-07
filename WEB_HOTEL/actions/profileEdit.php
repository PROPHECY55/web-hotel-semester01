<?php
include_once('authentication.php');
include('dbaccess.php');

$user = getLoggedinUser();
$username = $user['username'];

// Fetch current users information from database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Retrieve form data
    $oldPassword = $_POST['old_password'];
    $salutation = $_POST['salutation'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if old password is correct
    if (password_verify($oldPassword, $row['password'])) {
        // Old password is correct
        if (empty($newPassword) && empty($confirmPassword)) {
            // If both password fields empty = keep old password
            $hashedPassword = $row['password'];
        } elseif ($newPassword == $confirmPassword) {
            // If passwords match = hash new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        } else {
            echo '<script>window.location.href = "/index.php?page=home&message=wrong_same_password";</script>';
            exit();
        }

        // Update user information in database
        $updateSql = "UPDATE users SET salutation = '$salutation', firstname = '$firstname', 
                  lastname = '$lastname', email = '$email', username = '$newUsername', 
                  password = '$hashedPassword' WHERE username = '$username'";

        if ($conn->query($updateSql) === TRUE) {
            $successMessage = urlencode("profileEdit_success");
            header("Location: ?page=profileEdit&message=$successMessage");
            exit();
        } else {
            echo "Error updating: " . $conn->error;
        }
    } else {
        echo "Error fetching user details.";
        header("Location: ?action=logout");
    }
}
$conn->close();