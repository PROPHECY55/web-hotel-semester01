<?php if (isAdmin()) : ?>

    <head>
        <link rel="stylesheet" href="../css/blogPost.css">
    </head>

    <div class="container mt-5">
        <h2>Blog Post Erstellen</h2>

        <div>
            <p>Posten als: <?php echo getLoggedinUser()['username']; ?> <span class="badge badge-danger" style="background-color: red;">ADMIN</span></p>
        </div>

        <form method="post" action="?action=blogPost" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Titel:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="text_description">Beschreibung:</label>
                <textarea class="form-control" id="text_description" name="text_description" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label>Wähle ein Bild aus <i>(from ../src/uploads_thumbnails/):</i></label>
                <div class="d-flex flex-wrap">
                    <?php
                    $imageFolder = "src/uploads_thumbnails/";
                    $images = glob($imageFolder . "*.{jpg,png,gif}", GLOB_BRACE);

                    foreach ($images as $image) {
                        echo '<label class="mr-3"><input type="radio" name="selected_image" value="' . $image . '"><img src="' . $image . '" alt="image" class="img-thumbnail" width="100"></label>';
                    }
                    ?>
                </div>
            </div>

            <br>
            <button type="submit" class="btn btn-warning">Posten</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo '<p class="text-success mt-3">Blog Post successfully posted!</p>';
        }
        ?>

    </div>
<?php endif; ?>