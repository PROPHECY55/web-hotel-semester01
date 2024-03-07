<head>
    <link rel="stylesheet" href="../css/booking.css">
</head>

<div class="container mt-5">
    <h2>Room Reservation</h2>

    <?php
    // base prices
    $deluxePrice = 120;
    $executivePrice = 200;
    $presidentialPrice = 450;
    ?>

    <form method="post" action="../actions/booking.php">
        <div class="form-group">
            <label for="arrivalDate">Anreisedatum:</label>
            <input type="date" class="form-control" name="arrivalDate" id="arrivalDate" onchange="updatePrice()" required>
        </div>
        <div class="form-group">
            <label for="departureDate">Abreisedatum:</label>
            <input type="date" class="form-control" name="departureDate" id="departureDate" onchange="updatePrice()" required>
        </div>
        <br>
        <div class="form-group">
            <label for="adults">Erwachsene:</label>
            <input type="number" class="form-control" name="adults" id="adults" value="1" min="1" max="5" onchange="updatePrice()" required>
        </div>
        <div class="form-group">
            <label for="children">Kinder:</label>
            <input type="number" class="form-control" name="children" id="children" value="0" min="0" max="5" onchange="updatePrice()" required>
        </div>
        <br>
        <div class="form-group">
            <label for="suiteName">Suite:</label>
            <select class="form-control" name="suiteName" id="suiteName" onchange="updatePrice()" required>
                <option value="Deluxe" data-price="<?php echo $deluxePrice; ?>">Deluxe Suite</option>
                <option value="Executive" data-price="<?php echo $executivePrice; ?>">Executive Suite</option>
                <option value="Presidential" data-price="<?php echo $presidentialPrice; ?>">Presidential Suite</option>
            </select>
        </div>
        <br>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="breakfast" id="breakfast" onchange="updatePrice()">
            <label class="form-check-label" for="breakfast">Mit Frühstück</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="parking" id="parking" onchange="updatePrice()">
            <label class="form-check-label" for="parking">Mit Parkplatz</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="pets" id="pets" onchange="updatePrice()">
            <label class="form-check-label" for="pets">Haustiere?</label>
        </div>
        <br>
        <div class="form-group">
            <label for="currentPrice">Derzeitiger Preis:</label>
            <input type="text" class="form-control" name="currentPrice" id="currentPrice" readonly>
        </div>

        <br>
        <button type="submit" class="btn btn-warning">Suite Buchen</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<p class="alert alert-success mt-3">Suite erfolgreich reserviert!</p>';
    }
    ?>

</div>

<script>
    function updatePrice() {
        var arrivalDate = new Date(document.getElementById('arrivalDate').value);
        var departureDate = new Date(document.getElementById('departureDate').value);
        var adults = parseInt(document.getElementById('adults').value);
        var children = parseInt(document.getElementById('children').value);
        var suiteSelect = document.getElementById('suiteName');
        var selectedSuite = suiteSelect.options[suiteSelect.selectedIndex];
        var suitePrice = parseInt(selectedSuite.getAttribute('data-price'));
        var withBreakfast = document.getElementById('breakfast').checked;
        var withParking = document.getElementById('parking').checked;
        var withPets = document.getElementById('pets').checked;

        // Calculate number of nights
        var numberOfNights = Math.ceil((departureDate - arrivalDate) / (1000 * 60 * 60 * 24));

        // Calculate base price
        var basePrice = suitePrice * numberOfNights;

        if (adults > 1) {
            basePrice += adults * 40;
        }

        basePrice += children * 20;

        // Adjust price based on options
        if (withBreakfast) {
            basePrice += 20;
        }

        if (withParking) {
            basePrice += 10;
        }

        if (withPets) {
            basePrice += 10;
        }

        // Display current price
        document.getElementById('currentPrice').value = basePrice + '€';
    }
</script>