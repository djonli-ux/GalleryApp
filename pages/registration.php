<h1 class="display-6">Registration</h1>

<?php
if(!isset($_POST['frm_registration'])) {
?>

<div class="col-sm-12 col-md-8 col-lg-4">
    <form action="index.php?page=registration" method="post">
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

            <label for="pass_c" class="form-label">Confirm Password</label>
            <input name="pass_confirm" type="password" class="form-control" id="pass_c">

            <input name="frm_registration" type="hidden">

            <button type="submit" class="btn btn-primary mt-4">Registration</button>
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
        'confirm' => $_POST['pass_confirm'],
    ];

    $validationResult = registrationValidation($data);


    if (!$validationResult['success']) {
        foreach ($validationResult['errors'] as $error)
            notify($error, 'danger');
    } else {
        if (!signup($data['email'], $data['pass']))
            notify('<div>You are already registered!</div><a href="index.php?page=login">Login</a>', 'warning');
        else {
            $path = STORAGE . '/' . md5($data['email']);
            if (!file_exists($path)) {
                //TODO: change permissions from 0777 (dev only)
                mkdir($path, 0777, true);
            }
            header('Location: index.php?page=login');
        }
    }
}
