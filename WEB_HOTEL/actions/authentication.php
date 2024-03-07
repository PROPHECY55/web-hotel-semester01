<?php

function isLoggedIn()
{
    return isset($_SESSION['username']);
}

function isAdmin()
{
    if (isLoggedIn()) {
        return $_SESSION['role'] === 'admin';
    }
    return false;
}

function isActive()
{
    if (isLoggedIn()) {
        return $_SESSION['status'] === 'active';
    }
    return false;
}

// Refresh User role
function refreshUserRole($conn)
{
    if (isLoggedIn()) {
        $username = $_SESSION['username'];
        $sql = "SELECT role FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['role'] = $row['role'];
        }
    }
}

function getLoggedinUser()
{
    if (isLoggedIn()) {
        // username, role, status need to be set in $_SESSION array during login!
        $username = $_SESSION['username'];
        $role = $_SESSION['role'];
        $status = $_SESSION['status'];

        return [
            'username' => $username,
            'role' => $role,
            'status' => $status
        ];
    } else {
        return [
            'username' => 'anonym',
            'role' => '',
            'status' => ''
        ];
    }
}