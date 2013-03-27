<?php

// simplex/web/secure.php

$input = isset($_GET['name']) ? $_GET['name'] : 'World';
 
// Generates a warning
@header('Content-Type: text/html; charset=utf-8');
 
printf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
