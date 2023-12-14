<h1 class="display-6">Login</h1>

<?php
if(!isset($_POST['frm_login'])) {
    ?>

    <div class="col-sm-12 col-md-8 col-lg-4">
        <form action="index.php?page=login" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input name="useremail" type="email" class="form-control" id="email" placeholder="name@example.com" aria-describedby="emailHelpBlock">
                <div id="emailHelpBlock" class="form-text">
                    We'll never share your email with anyone
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="pass" type="password" class="form-control" id="password">

                <input name="frm_login" type="hidden">

                <button type="submit" class="btn btn-primary mt-4">Login</button>
            </div>
        </form>
    </div>

    <?php
} else {
    require_once ROOT . '/tools/dd.php';                        // TODO: remove
    require_once  ROOT . '/services/validationServices.php';
    require_once ROOT . '/services/notifyService.php';
    require_once  ROOT . '/services/authService.php';

    $data = [
        'email' => $_POST['useremail'],
        'pass' => $_POST['pass'],
    ];

    $validationResult = loginValidation($data);

    if (!$validationResult['success']) {
        foreach ($validationResult['errors'] as $error)
            notify($error, 'danger');
    } else {

        $user = signin($data['email'], $data['pass']);

        if(!$user) {
            notify('<div>Email or password is invalid!</div><a href="index.php?page=registration">Registration</a>', 'warning');
        } else {
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            $_SESSION['hash'] = md5($user['email']);

            header('Location: index.php?page=gallery');
        }
    }
}
