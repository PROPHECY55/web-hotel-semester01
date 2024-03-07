<head>
    <link rel="stylesheet" href="../css/reservations.css">
</head>

<?php
include 'actions/dbaccess.php';
?>

<div class="container mt-5">
    <?php
    if (!isset($_SESSION['username'])) {
        echo '<p class="alert alert-danger mt-3">Sie müssen angemeldet sein, um Reservierungen anzuzeigen.</p>';
    } else {
        $username = $_SESSION['username'];

        $stmt = $conn->prepare("SELECT * FROM bookings WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        // if reservations show
        if ($result->num_rows > 0) {
            echo '<h2>Ihre Reservierungen:</h2>';
            echo '<div class="row">';

            // From database data
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['suite'] . '<span class="badge bg-' . ($row['booking_status'] == 'Neu' ? 'success' : 'warning') . ' float-end">' . $row['booking_status'] . '</span></h5>
                                <p class="card-text">' . date("d M Y", strtotime($row['arrival_date'])) . ' - ' . date("d M Y", strtotime($row['departure_date'])) . '</p>
                                <p class="card-text">' . $row['adults'] . ' Erwachsene / ' . $row['children'] . ' Kinder</p>';

                // is already storniert? before button
                if ($row['booking_status'] != 'Storniert') {
                    echo '<form method="post" action="">
                            <input type="hidden" name="booking_id" value="' . $row['booking_id'] . '">
                            <button type="submit" name="cancel_booking" class="btn btn-danger">Stornieren</button>
                        </form>';
                }

                echo '</div>
                    </div>
                </div>';
            }

            echo '</div>';
        } else {
            echo '<p>Sie haben noch keine Reservierungen.</p>';
        }

        $stmt->close();
    }

    if (isset($_POST['cancel_booking'])) {
        $bookingIdToCancel = $_POST['booking_id'];

        // Aktualisiere den booking_status in der Datenbank auf 'Storniert'
        $cancelStmt = $conn->prepare("UPDATE bookings SET booking_status = 'Storniert' WHERE booking_id = ?");
        $cancelStmt->bind_param("i", $bookingIdToCancel);

        if ($cancelStmt->execute()) {
            echo '<script>window.location.href = "/index.php?page=reservations&message=stornieren_success";</script>';
        } else {
            echo '<p class="alert alert-danger mt-3">Fehler beim Stornieren der Buchung.</p>';
        }

        $cancelStmt->close();
    }
    ?>
</div>