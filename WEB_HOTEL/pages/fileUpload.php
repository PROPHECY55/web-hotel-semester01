<?php if (isAdmin()) : ?>

    <head>
        <link rel="stylesheet" href="../css/fileupload.css">
    </head>

    <div class="container mt-5">
        <h2>File Upload</h2>
        <br>

        <!-- Print Success/Error Message-->
        <?php
        if (isset($_GET['message']) && isset($_GET['status'])) {
            $message = htmlspecialchars($_GET['message']);
            $status = $_GET['status'];

            $alertClass = ($status === 'success') ? 'alert-success' : 'alert-warning';

            echo '<div class="alert ' . $alertClass . '" role="alert">' . $message . '</div>';
        }
        ?>

        <form action="?action=fileUpload" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Bild auswählen:</label>
                <input type="file" name="file" id="file" class="form-control-file" accept="image/*">
            </div>
            <br>
            <button type="submit" class="btn btn-warning">Upload</button>
        </form>
    </div>
<?php endif; ?>