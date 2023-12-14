<?php

require_once ROOT . '/services/authService.php';

logout();

header('Location: index.php?page=login');
