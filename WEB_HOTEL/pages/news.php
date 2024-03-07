<head>
    <link rel="stylesheet" href="../css/news.css">
</head>

<?php
include 'actions/dbaccess.php';
?>

<div class="container mt-5">
    <h2>Blog Beiträge</h2>

    <?php
    $sql = "SELECT * FROM posts ORDER BY upload_date DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="row blog-post mb-3">';
            echo '<div class="col-md-8">';
            echo '<br><h2>' . $row['title'] . '</h2>';
            echo '<small class="text-muted">' . date("d M Y", strtotime($row['upload_date'])) . ' - by ' . $row['username'] . '</small><br>';
            echo '<p>' . $row['text_description'] . '</p>';
            echo '</div>';
            echo '<div class="col-md-4">';
            echo '<img src="' . $row['selected_image'] . '" alt="image" class="img-fluid">';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Keine Beiträge gefunden.</p>';
    }
    ?>
</div>