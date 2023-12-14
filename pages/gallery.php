<h1 class="display-6">Gallery</h1>

<?php
    require_once ROOT . '/tools/dd.php'; // TODO: remove

    $albumDir = $_SESSION['hash'];
    $path = STORAGE . '/' . $albumDir;

    $files = array_diff(scandir($path), ['.', '..']);

    $imagesPerRow = 5;
    $count = 0;
?>

<div class="container">
    <div class="row row-cols -<?= $imagesPerRow ?>">
        <?php
                foreach ($files as $image):
                $link = 'storage/' . $albumDir . '/' . $image;
            ?>
            <div class="col mb-3">
                <a href="<?= $link ?>" target="_blank">
                    <img class="photo img-thumbnail" src="<?= $link ?>" alt="<?= $image ?>">
                </a>
            </div>
            <?php
                $count++;
                if ($count % $imagesPerRow === 0) {
                    echo '</div><div class="row row-cols-' . $imagesPerRow . '">';
                }
            ?>
        <?php endforeach; ?>
    </div>
</div>
