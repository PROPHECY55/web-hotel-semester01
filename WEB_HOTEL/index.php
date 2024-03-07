<?php
session_start();
include 'actions/dbaccess.php';
include 'actions/authentication.php';

// Include Actions
$action = isset($_GET['action']) ? $_GET['action'] : null;

// Admin Only Actions
if (!isAdmin()) {
    $restrictedActions = ['fileUpload', 'blogPost', 'admin_showUsers', 'admin_showReservations', 'admin_saveChanges'];
    if (in_array($action, $restrictedActions)) {
        include "pages/error403.php";
        include 'templates/footer.php';
        exit();
    }
}

switch ($action) {
    case "login":
        include("actions/login.php");
        break;
    case 'logout':
        include("actions/logout.php");
        break;
    case 'fileUpload':
        include("actions/fileUpload.php");
        break;
    case 'blogPost':
        include("actions/blogPost.php");
        break;
    case 'blogShow':
        include("actions/blogShow.php");
        break;
    case 'booking':
        include("actions/booking.php");
        break;
    case 'bookingShow':
        include("actions/bookingShow.php");
        break;
    case 'profileEdit':
        include("actions/profileEdit.php");
        break;
    case 'admin_showUsers':
        include("actions/admin_showUsers.php");
        break;
    case 'admin_showReservations':
        include("actions/admin_showReservations.php");
        break;
    case 'admin_saveChanges':
        include("actions/admin_saveChanges.php");
        break;
    case 'register':
        include("actions/register.php");
        break;
}

include "templates/header.php";
include 'templates/navbar.php';

$page = isset($_GET['page']) ? $_GET['page'] : null;

// Admin Only Access Pages
if (!isAdmin()) {
    $restrictedPages = ['admin', 'fileUpload', 'blogPost', 'admin_reservations', 'booking_details'];
    if (in_array($page, $restrictedPages)) {
        include "pages/error403.php";
        include 'templates/footer.php';
        exit();
    }
}

// LoggedIn Only Access Pages
if (!isLoggedIn()) {
    $restrictedPages = ['profileEdit', 'reservations', 'suites', 'booking'];
    if (in_array($page, $restrictedPages)) {
        include "pages/error403.php";
        include 'templates/footer.php';
        exit();
    }
}

// Active Users Only Access Pages
if (!isActive()) {
    $restrictedPages = ['profileEdit', 'reservations', 'suites', 'booking'];
    if (in_array($page, $restrictedPages)) {
        include "pages/error403.php";
        include 'templates/footer.php';
        exit();
    }
}

// LoggedIn Only Access Pages
if (isLoggedIn()) {
    $restrictedPages = ['register', 'login_modal'];
    if (in_array($page, $restrictedPages)) {
        include "pages/error403.php";
        include 'templates/footer.php';
        exit();
    }
}

// Include Pages
switch ($page) {
    case 'home':
        include "pages/home.php";
        break;
    case 'login_modal':
        include "pages/login_modal.php";
        break;
    case 'register':
        include "pages/register.php";
        break;
    case 'profileEdit':
        include "pages/profileEdit.php";
        break;
    case 'fileUpload':
        include "pages/fileUpload.php";
        break;
    case 'help':
        include "pages/help.php";
        break;
    case 'imprint':
        include "pages/imprint.php";
        break;
    case 'legal':
        include "pages/legal.php";
        break;
    case 'news':
        include "pages/news.php";
        break;
    case 'blogPost':
        include "pages/blogPost.php";
        break;
    case 'culinary':
        include "pages/culinary.php";
        break;
    case 'reservations':
        include "pages/reservations.php";
        break;
    case 'suites':
        include "pages/suites.php";
        break;
    case 'contact':
        include "pages/contact.php";
        break;
    case 'booking':
        include "pages/booking.php";
        break;
    case 'admin':
        include "pages/admin.php";
        break;
    case 'admin_reservations':
        include "pages/admin_reservations.php";
        break;
    case 'booking_details':
        include "pages/booking_details.php";
        break;
    default:
        include "pages/error404.php";
}

include 'templates/footer.php';
