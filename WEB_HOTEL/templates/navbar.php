<head>
    <link rel="stylesheet" href="../css/navbar.css">
</head>

<?php
// Display messages at top
if (isset($_SESSION['success_message'])) {
    echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}
if (isset($_GET["message"])) {
    $message = $_GET["message"];
    if ($message === "success") {
        echo '<div class="alert alert-success" role="alert">Erfolgreich angemeldet!</div>';
    } elseif ($message === "inactive") {
        echo '<div class="alert alert-danger" role="alert">Dein Account ist inaktiv/wurde deaktiviert. Bitte kontaktiere einen Administrator.</div>';
    } elseif ($message === "incorrect") {
        echo '<div class="alert alert-danger" role="alert">Falsches Passwort</div>';
    } elseif ($message === "notfound") {
        echo '<div class="alert alert-danger" role="alert">User nicht gefunden</div>';
    } elseif ($message === "logout_success") {
        echo '<div class="alert alert-success" role="alert">Erfolgreich abgemeldet!</div>';
    } elseif ($message === "suite_success") {
        echo '<div class="alert alert-success" role="alert">Suite erfolgreich gebucht!</div>';
    } elseif ($message === "stornieren_success") {
        echo '<div class="alert alert-success" role="alert">Suite erfolgreich storniert!</div>';
    } elseif ($message === "booking_error_time") {
        echo '<div class="alert alert-danger" role="alert">Fehler bei der Buchung: Das Abreisedatum muss nach dem Ankunftsdatum liegen!</div>';
    } elseif ($message === "booking_error_future") {
        echo '<div class="alert alert-danger" role="alert">Fehler bei der Buchung: Das Ankunftsdatum muss in der Zukunft liegen!</div>';
    } elseif ($message === "booking_error_date") {
        echo '<div class="alert alert-danger" role="alert">Fehler bei der Buchung: Alle Zimmer dieser Suite für das gewählte Datum sind ausgebucht!</div>';
    } elseif ($message === "wrong_same_password") {
        echo '<div class="alert alert-danger" role="alert">Die neuen Passwörter stimmen nicht überein!</div>';
    }
}

// Current Navbar Page
function isActivePage($page)
{
    $currentPage = isset($_GET['page']) ? $_GET['page'] : '';
    return ($currentPage == $page) ? 'active' : '';
}
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light text-primary">
    <div class="container-fluid">
        <a href="?page=home">
            <img src="../src/img/logo.png" alt="Logo" height="80" class="d-inline-block align-text-top" id="testyimg">
        </a>
        <a class="navbar-brand" href="?page=home">Das I&L Continental</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item <?php echo isActivePage('home'); ?>">
                    <a class="nav-link" href="?page=home">Home</a>
                </li>
                <li class="nav-item <?php echo isActivePage('news'); ?>">
                    <a class="nav-link" href="?page=news">News</a>
                </li>
                <li class="nav-item <?php echo isActivePage('culinary'); ?>">
                    <a class="nav-link" href="?page=culinary">Kulinarik</a>
                </li>
                <?php if (!isLoggedin()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" id="user-name" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Anmelden</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item dropdown exclude-yellow-line">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo getLoggedinUser()['username']; ?>
                            <?php if (isAdmin()) : ?>
                                <span class="badge bg-danger">ADMIN</span>
                            <?php endif; ?>
                            ⬇️
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="?page=profileEdit">Mein Profil</a>
                            <a class="dropdown-item" href="?page=reservations">Reservierungen</a>
                            <a class="dropdown-item" href="?action=logout">Abmelden</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-warning active" href="?page=suites">Reservieren</a>
                    </li>
                <?php endif; ?>
                <?php if (isAdmin()) : ?>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger active" href="?page=fileUpload">File Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger active" href="?page=blogPost">Post Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger active" href="?page=admin">Admin Panel</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<?php
include('login_modal.php');
?>