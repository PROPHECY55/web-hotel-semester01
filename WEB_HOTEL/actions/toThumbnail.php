<?php if (isAdmin()) : ?>
<?php
    // Check if main image exists
    if (isset($_FILES["file"])) {
        $main_image_path = $target_file;
        $thumbnail_dir = __DIR__ . "/../src/uploads_thumbnails/";

        // Create thumbnails only for allowed file types
        if (in_array($imageFileType, $allowed_types)) {
            // Load main image
            $source_image = imagecreatefromstring(file_get_contents($main_image_path));

            if ($source_image !== false) {
                // Get image dimensions
                $width = imagesx($source_image);
                $height = imagesy($source_image);

                // Thumbnail Dimensions
                $thumbnail_width = 450;
                $thumbnail_height = 400;

                // Create new image with new dimensions
                $thumbnail = imagecreatetruecolor($thumbnail_width, $thumbnail_height);

                // Resize+crop
                imagecopyresampled($thumbnail, $source_image, 0, 0, 0, 0, $thumbnail_width, $thumbnail_height, $width, $height);

                // Save thumbnail
                $thumbnail_file = $thumbnail_dir . basename($_FILES["file"]["name"]);
                imagejpeg($thumbnail, $thumbnail_file);

                // Free memory
                imagedestroy($source_image);
                imagedestroy($thumbnail);
            } else {
                $message = "Error";
                header("Location: ../index.php?page=fileUpload&status=error&message=" . urlencode($message));
            }
        }
    }
?>
<?php endif; ?>