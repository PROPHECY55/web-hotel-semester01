<?php if (isAdmin()) : ?>

    <head>
        <link rel="stylesheet" href="../css/admin_reservations.css">
    </head>
    <div class="container mt-5">
        <?php

        // Got form sent?
        if (isset($_POST['filter_status'])) {
            $desiredBookingStatus = $_POST['filter_status'];
        } else {
            $desiredBookingStatus = 'Alle'; // Standard
        }

        // SQL
        if ($desiredBookingStatus == 'Alle') {
            $stmt = $conn->prepare("SELECT * FROM bookings");
        } else {
            $stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_status = ?");
            $stmt->bind_param("s", $desiredBookingStatus);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        // Dropdown-Menü
        echo '<form method="post" action="" class="mb-3">
            <label for="filter_status">Filter nach Status:</label>
            <select name="filter_status" id="filter_status" class="form-control">
                <option value="Alle" ' . ($desiredBookingStatus == 'Alle' ? 'selected' : '') . '>Alle</option>
                <option value="Neu" ' . ($desiredBookingStatus == 'Neu' ? 'selected' : '') . '>Neu</option>
                <option value="Bestätigt" ' . ($desiredBookingStatus == 'Bestätigt' ? 'selected' : '') . '>Bestätigt</option>
                <option value="Storniert" ' . ($desiredBookingStatus == 'Storniert' ? 'selected' : '') . '>Storniert</option>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Filtern</button>
        </form>';

        // show reservations if exist
        if ($result->num_rows > 0) {
            echo '<h2>Alle Buchungen:</h2>';

            // Show data from database
            echo '<div class="row">';
            echo '<table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Suite</th>
                        <th>Benutzer</th>
                        <th>Ankunftsdatum</th>
                        <th>Abreisedatum</th>
                        <th>Erwachsene / Kinder</th>
                        <th>Status</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>';
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='/index.php?page=booking_details&id={$row['booking_id']}'>{$row['booking_id']}</a></td>";
                echo "<td>{$row['suite']}</td>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['arrival_date']}</td>";
                echo "<td>{$row['departure_date']}</td>";
                echo "<td>{$row['adults']} Erwachsene / {$row['children']} Kinder</td>";
                echo "<td>{$row['booking_status']}</td>";

                // Bestätigen/Stornieren button
                echo '<td>';
                if ($row['booking_status'] == 'Neu') {
                    echo '<form method="post" action="">
                        <input type="hidden" name="booking_id" value="' . $row['booking_id'] . '">
                        <button type="submit" name="confirm_booking" class="btn btn-success">Bestätigen</button>
                      </form>';
                } elseif ($row['booking_status'] == 'Bestätigt') {
                    echo '<form method="post" action="">
                        <input type="hidden" name="booking_id" value="' . $row['booking_id'] . '">
                        <button type="submit" name="cancel_booking" class="btn btn-danger">Stornieren</button>
                      </form>';
                }
                echo '</td>';

                echo "</tr>";
            }
            echo '</tbody></table>';
            echo '</div>';
        } else {
            echo '<p>Es gibt keine Buchungen mit dem gewünschten Status.</p>';
        }

        $stmt->close();

        // confirm button
        if (isset($_POST['confirm_booking'])) {
            $bookingIdToConfirm = $_POST['booking_id'];

            // Update booking_status
            $confirmStmt = $conn->prepare("UPDATE bookings SET booking_status = 'Bestätigt' WHERE booking_id = ?");
            $confirmStmt->bind_param("i", $bookingIdToConfirm);

            if ($confirmStmt->execute()) {
                echo '<script>window.location.href = "/index.php?page=admin_reservations";</script>';
            } else {
                echo '<p class="alert alert-danger mt-3">Fehler beim Bestätigen der Buchung.</p>';
            }

            $confirmStmt->close();
        }

        // cancel button
        if (isset($_POST['cancel_booking'])) {
            $bookingIdToCancel = $_POST['booking_id'];

            // update booking_status in database auf 'storniert'
            $cancelStmt = $conn->prepare("UPDATE bookings SET booking_status = 'Storniert' WHERE booking_id = ?");
            $cancelStmt->bind_param("i", $bookingIdToCancel);

            if ($cancelStmt->execute()) {
                echo '<script>window.location.href = "/index.php?page=admin_reservations";</script>';
            } else {
                echo '<p class="alert alert-danger mt-3">Fehler beim Stornieren der Buchung.</p>';
            }

            $cancelStmt->close();
        }

        ?>
    </div>

    </body>

    </html>
<?php endif; ?>