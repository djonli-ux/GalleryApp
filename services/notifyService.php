<?php

function notify (string $message, string $type) {
    if($message) {
        ?>
            <div class="col-sm-12 col-md-8 col-lg-4">
                <div class="alert alert-<?= $type ?>">
                    <?= $message ?>
                </div>
            </div>
        <?php
    }
}
