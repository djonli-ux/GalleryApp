<h1 class="display-6">Upload</h1>

<?php
    require_once ROOT . '/services/notifyService.php';

    if (!isset($_POST['frm_upload'])) {
?>

<div class="col-sm-12 col-md-8 col-lg-4">
                                                        <!-- for file sending due to form: enctype="multipart/form-data" -->
    <form action="index.php?page=upload" method="post" enctype="multipart/form-data">
        <div class="mb-3">
                                                          <!-- 50mb -->
            <input type="hidden" name="MAX_FILE_SIZE" value="52428800">

            <label for="file" class="form-label">Choose your image</label>
            <input name="user_img[]" type="file" accept="image/*" class="form-control" id="file" multiple>

            <input name="frm_upload" type="hidden">

            <button type="submit" class="btn btn-primary mt-4">Upload</button>
        </div>
    </form>
</div>

<?php
    } else {
        require_once ROOT . '/tools/dd.php';                        // TODO: remove
        require_once ROOT . '/services/notifyService.php';

        $filesInfo = $_FILES['user_img'];

        $movedFiles = [];

        try {
            for ($i = 0; $i < count($filesInfo['name']); ++$i) {
                $nameInfo = pathinfo($filesInfo['name'][$i]);

                $filename = bin2hex(random_bytes(FILENAME_LENGTH));
                $extension = $nameInfo['extension'];
                $destPath = STORAGE . '/' . $_SESSION['hash'] . '/' . $filename . '.' . $extension;

                if (is_uploaded_file($filesInfo['tmp_name'][$i])) {
                    if (!move_uploaded_file($filesInfo['tmp_name'][$i], $destPath))
                        throw new Exception();
                    else {
                        $movedFiles[] = $destPath;
                        header('Location: index.php?page=upload');
                    }
                }
            }
        }
        catch (Exception $ex) {
            foreach ($movedFiles as $mf)
                unlink($mf);
            notify('Upload files error!', 'warning');
        }
    }
?>