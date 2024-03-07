<head>
    <link rel="stylesheet" href="../css/booking_details.css">
</head>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<div class="container text-center">
    <?php
    // ID in get?
    if (isset($_GET['id'])) {
        $bookingId = $_GET['id'];

        // SQL
        $stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ?");
        $stmt->bind_param("i", $bookingId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Results there check
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // tables
            echo '<div class="mt-4">';
            echo '<h2 class="mb-4">Details zur Buchung</h2>';
            echo '<div class="row">';
            echo '<div class="col-md-6">';
            echo '<table class="table table-bordered table-gold table-shadow">';
            echo '<tbody>';
            echo '<tr><td>ID</td><td>' . $row['booking_id'] . '</td></tr>';
            echo '<tr><td>Suite</td><td>' . $row['suite'] . '</td></tr>';
            echo '<tr><td>Benutzer</td><td>' . $row['username'] . '</td></tr>';
            echo '<tr><td>Ankunftsdatum</td><td>' . $row['arrival_date'] . '</td></tr>';
            echo '<tr><td>Abreisedatum</td><td>' . $row['departure_date'] . '</td></tr>';
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '<div class="col-md-6">';
            echo '<table class="table table-bordered table-gold table-shadow">';
            echo '<tbody>';
            echo '<tr><td>Erwachsene / Kinder</td><td>' . $row['adults'] . ' Erwachsene / ' . $row['children'] . ' Kinder</td></tr>';
            echo '<tr><td>Status</td><td>' . $row['booking_status'] . '</td></tr>';
            echo '<tr><td>Frühstück</td><td>' . ($row['breakfast'] ? 'Ja' : 'Nein') . '</td></tr>';
            echo '<tr><td>Parkplatz</td><td>' . ($row['parking'] ? 'Ja' : 'Nein') . '</td></tr>';
            echo '<tr><td>Haustiere</td><td>' . ($row['pets'] ? 'Ja' : 'Nein') . '</td></tr>';
            echo '<tr><td>Preis</td><td>' . $row['current_price'] . '</td></tr>';
            echo '<tr><td>Buchungsdatum</td><td>' . $row['booking_date'] . '</td></tr>';
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<p>Keine Daten gefunden für die Buchungs-ID: ' . $bookingId . '</p>';
        }

        $stmt->close();
    } else {
        echo '<p>Keine Buchungs-ID angegeben.</p>';
    }

    $conn->close();
    ?>
</div>