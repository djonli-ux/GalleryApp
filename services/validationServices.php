<?php

function registrationValidation(array $data) {
    $result = [
        'success' => false,
        'errors' => [],
    ];

    if (!$data['email'] || !$data['pass'] || !$data['confirm'])
        $result['errors'][] = 'All fields are required';        // adding to the end

    if ($data['pass'] !== $data['confirm'])
        $result['errors'][] = 'Failed confirm password';

    if (!$result['errors'])
        $result['success'] = true;

    return $result;
}

function loginValidation(array $data): array {
    $result = [
        'success' => false,
        'errors' => [],
    ];

    if (!$data['email'] || !$data['pass'])
        $result['errors'][] = 'All fields are required';

    if (!$result['errors'])
        $result['success'] = true;

    return $result;
}