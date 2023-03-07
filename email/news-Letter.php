<?php
require_once 'email-class.php';
header('Location: test.html');
$sub = new Email($_POST['email']);
$myfile = fopen(__DIR__."/emails.txt", "a");
fwrite($myfile, $sub->getEmail().PHP_EOL);
fclose($myfile);


