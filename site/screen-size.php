<?php
if (isset($_POST['width']) && isset($_POST['height'])) {
    $width = $_POST['width'];
    $height = $_POST['height'];

    // Store, log, or process screen size here
    echo "Width: $width, Height: $height";
}
?>
