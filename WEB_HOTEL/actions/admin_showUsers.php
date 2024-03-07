<?php if (isAdmin()) : ?>
<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form + update database
        $user_id = $_POST['user_id'];
        $salutation = $_POST['salutation'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        // Handle password change
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $update_sql = "UPDATE users SET user_id='$user_id', salutation='$salutation', firstname='$firstname', lastname='$lastname', email='$email', username='$username', role='$role', status='$status', password='$password' WHERE user_id=$user_id";

        if (mysqli_query($conn, $update_sql)) {
            echo "Updated successfully";
        } else {
            echo "Error updating: " . mysqli_error($conn);
        }
    }

    header("Location: ../index.php?page=admin");
?>
<?php endif; ?>