<head>
    <link rel="stylesheet" href="../css/register.css">
</head>

<?php

// Display error messages
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']);
}
?>

<form action="?action=register" method="post">
    <h2>Registrieren</h2>

    <label for="salutation">Anrede</label>
    <select id="salutation" name="salutation" required>
        <option value="Mr">Herr</option>
        <option value="Mrs">Frau</option>
    </select><br>

    <label for="firstname">Vorname</label>
    <input type="text" id="firstname" name="firstname" maxlength="50" required><br>

    <label for="lastname">Nachname</label>
    <input type="text" id="lastname" name="lastname" maxlength="50" required><br>

    <label for="email">Email-Adresse</label>
    <input type="email" id="email" name="email" required><br>

    <label for="username">Username</label>
    <input type="text" id="username" name="username" pattern="[A-Za-z0-9]{1,20}" maxlength="20" required><br>

    <label for="password">Passwort</label>
    <input type="password" id="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}$" required><br>

    <label for="confirmPassword">Passwort wiederholen</label>
    <input type="password" id="confirmPassword" name="confirmPassword" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}$" required><br>

    <p class="agreement-text">
        Wenn du fortfährst, stimmst du unserer
        <a href="#">Nutzungsvereinbarung</a>
        zu und bestätigst, dass du die
        <a href="#">Datenschutzerklärung</a>
        verstehst.
    </p>

    <input type="submit" value="Registrieren">
</form>