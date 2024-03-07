<head>
    <link rel="stylesheet" href="../css/profileEdit.css">
</head>

<?php

$user = getLoggedinUser();

// Fetch current users information from databas
$username = $user['username'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if (isset($_GET['message']) && $_GET['message'] === "profileEdit_success") {
    $successMessage = '<div class="alert alert-success" role="alert">Daten erfolgreich aktualisiert! Bitte melden Sie sich nochmal an.</div>';
    echo $successMessage;
    echo '<meta http-equiv="refresh" content="2;url=?action=logout">';
    exit();
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Display form
?>

    <h1 class="text-center">Stammdaten Ändern</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <form action="?action=profileEdit" method="post">
                    <div class="form-group text-center">
                        <label for="salutation">Anrede</label>
                        <select class="form-control" id="salutation" name="salutation" required>
                            <option value="Mr" <?php echo ($row['salutation'] == 'Mr') ? 'selected' : ''; ?>>Herr</option>
                            <option value="Mrs" <?php echo ($row['salutation'] == 'Mrs') ? 'selected' : ''; ?>>Frau</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <label for="firstname">Vorname</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" maxlength="50" value="<?php echo $row['firstname']; ?>" required>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <label for="lastname">Nachname</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" maxlength="50" value="<?php echo $row['lastname']; ?>" required>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <label for="email">Email-Adresse</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" pattern="[A-Za-z0-9]{1,20}" maxlength="20" value="<?php echo $row['username']; ?>" required>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <label for="password">Neues Passwort</label>
                        <input type="password" class="form-control" id="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}">
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <label for="confirm_password">Passwort bestätigen</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}" <?php echo empty($newPassword) ? '' : 'required'; ?>>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <label for="old_password">Altes Passwort</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    <br>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning">Änderungen speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
} else {
    echo "Error fetching user details.";
}
?>

<script>
    function checkPassword() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        var submitButton = document.querySelector("button[type='submit']");

        if (password !== '' && confirm_password === '') {
            submitButton.disabled = true;
        } else {
            submitButton.disabled = false;
        }
    }
</script>