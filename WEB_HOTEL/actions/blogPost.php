<?php if (isAdmin()) : ?>
    <?php
    include('dbaccess.php');

    $title = $_POST['title'];
    $textDescription = $_POST['text_description'];
    $selectedImage = $_POST['selected_image'];
    $username = getLoggedinUser()['username'];

    $sql = "INSERT INTO posts (title, text_description, selected_image, username, upload_date) VALUES ('$title', '$textDescription', '$selectedImage', '$username', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Blog-Beitrag erfolgreich gepostet!";
    } else {
        echo "Fehler beim Posten des Blog-Beitrags: " . $conn->error;
    }

    header("Location: ../index.php?page=news");
    $conn->close();
    ?>
<?php endif; ?>