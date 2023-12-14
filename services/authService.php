<?php

function signup (string $email, string $pass): bool {

            // deserealization                                               // if(null) => [empty string]  else left part of expression
    $users = json_decode(file_get_contents(DB_USERS), true) ?? [];

    if(in_array($email, array_column($users, 'email')))
        return false;

    $user = [
        'email' => $email,
                  // hash processing
        'pass' => md5($pass),
    ];

    $users[] = $user;
                                        // serealization
    file_put_contents(DB_USERS, json_encode($users));

    return true;
}

function signin (string $email, string $pass): ?array {
    $users = json_decode(file_get_contents(DB_USERS), true) ?? [];
    if(!in_array($email, array_column($users, 'email')))
        return null;

    $user = $users[array_search($email, array_column($users, 'email'))];

    return $user['pass'] === md5($pass) ? $user : null;
}

function checkAuth():bool {
    return isset($_SESSION['login']) && $_SESSION['login'];
}

function logout() {
    session_destroy();
}
