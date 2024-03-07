<?php if (isAdmin()) : ?>
<?php
    include("dbaccess.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_ids = $_POST['user_id'];
        $usernames = $_POST['username'];
        $emails = $_POST['email'];
        $salutations = $_POST['salutation'];
        $firstnames = $_POST['firstname'];
        $lastnames = $_POST['lastname'];
        $roles = $_POST['role'];
        $statuses = $_POST['status'];
        $new_passwords = $_POST['new_password'];

        for ($i = 0; $i < count($user_ids); $i++) {
            $user_id = $user_ids[$i];
            $username = $usernames[$i];
            $email = $emails[$i];
            $salutation = $salutations[$i];
            $firstname = $firstnames[$i];
            $lastname = $lastnames[$i];
            $role = $roles[$i];
            $status = $statuses[$i];
            $new_password = $new_passwords[$i];

            // Check if new password is not empty
            if (!empty($new_password)) {
                // Hash new password
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Perform update with new hashed password
                $update_sql = "UPDATE users SET 
                            username='$username', 
                            email='$email', 
                            salutation='$salutation', 
                            firstname='$firstname', 
                            lastname='$lastname', 
                            role='$role', 
                            status='$status', 
                            password='$hashed_password' 
                            WHERE user_id=$user_id";
            } else {
                // Perform update without changing pw
                $update_sql = "UPDATE users SET 
                            username='$username', 
                            email='$email', 
                            salutation='$salutation', 
                            firstname='$firstname', 
                            lastname='$lastname', 
                            role='$role', 
                            status='$status' 
                            WHERE user_id=$user_id";
            }

            if (!mysqli_query($conn, $update_sql)) {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }

        header("Location: ../index.php?page=admin&success=1");
        exit();
    } else {
        header("Location: ../index.php?page=admin");
        exit();
    }
?>
<?php endif; ?>