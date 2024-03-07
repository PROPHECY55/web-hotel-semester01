<?php
session_start();

include('dbaccess.php');
include('authentication.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $loggedInUser = getLoggedinUser();
    $username = getLoggedinUser()['username'];

    $arrivalDate = $_POST['arrivalDate'];
    $departureDate = $_POST['departureDate'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $suite = $_POST['suiteName'];
    $breakfast = isset($_POST['breakfast']) ? 1 : 0;
    $parking = isset($_POST['parking']) ? 1 : 0;
    $pets = isset($_POST['pets']) ? 1 : 0;
    $currentPrice = $_POST['currentPrice'];
    $currentDate = date("Y-m-d");

    if ($arrivalDate < $currentDate) {
        echo '<script>window.location.href = "/index.php?page=booking&message=booking_error_future";</script>';
    } elseif ($arrivalDate >= $departureDate) {
        echo '<script>window.location.href = "/index.php?page=booking&message=booking_error_time";</script>';
    } else {
        // Prüfe die Verfügbarkeit der Zimmer für die gewählte Suite und Datum
        $stmt = $conn->prepare("SELECT COUNT(*) as booked_rooms FROM bookings WHERE suite = ? AND ? BETWEEN arrival_date AND departure_date");
        $stmt->bind_param("ss", $suite, $arrivalDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $bookedRooms = $row['booked_rooms'];
        $stmt->close();

        // Die maximale Anzahl der Zimmer pro Suite und Datum
        $maxRoomsPerSuite = 3;

        if ($bookedRooms >= $maxRoomsPerSuite) {
            // Finde das nächste verfügbare Datum für die ausgewählte Suite
            $stmt = $conn->prepare("SELECT MIN(departure_date) AS next_available_date FROM bookings WHERE suite = ? AND departure_date >= ?");
            $stmt->bind_param("ss", $suite, $currentDate);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $nextAvailableDate = $row['next_available_date'];
            $stmt->close();

            if ($nextAvailableDate) {
                // Berechne die Anzahl der Nächte
            //    $numberOfNights = ceil((strtotime($nextAvailableDate) - strtotime($arrivalDate)) / (60 * 60 * 24));

                // Berechne das Ende des aktuellen Buchungszeitraums
            //    $endOfCurrentBooking = date("Y-m-d", strtotime($nextAvailableDate . ' -1 day'));

                echo '<p class="alert alert-danger mt-3">Fehler bei der Buchung: Alle Zimmer dieser Suite für das gewählte Datum sind ausgebucht!';
            //    echo ' Alternativ ist die Suite wieder ab dem ' . date("d M Y", strtotime($nextAvailableDate)) . ' verfügbar.</p>';
            //    echo '<p class="alert alert-info mt-3">Möglicher Zeitraum: ' . date("d M Y", strtotime($nextAvailableDate)) . ' - ' . date("d M Y", strtotime("$nextAvailableDate +$numberOfNights days")) . '</p>';
                sleep('3');
                echo '<script>window.location.href = "/index.php?page=booking&message=booking_error_date";</script>';
            } else {
                echo '<script>window.location.href = "/index.php?page=booking&message=booking_error_date";</script>';
            }
        } else {
            // Buchung durchführen, da Zimmer verfügbar sind
            $bookingDate = date("Y-m-d");

            $stmt = $conn->prepare("INSERT INTO bookings (username, arrival_date, departure_date, adults, children, suite, breakfast, parking, pets, current_price, booking_date, booking_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Neu')");
            $stmt->bind_param("sssiisiiids", $username, $arrivalDate, $departureDate, $adults, $children, $suite, $breakfast, $parking, $pets, $currentPrice, $bookingDate);

            if ($stmt->execute()) {
                header("Location: ../index.php?page=reservations&message=suite_success");
            } else {
                echo '<p class="alert alert-danger mt-3">Fehler bei der Buchung: ' . $stmt->error . '</p>';
            }

            $stmt->close();
        }
    }
}

$conn->close();