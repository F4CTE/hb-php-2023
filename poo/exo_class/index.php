<?php
require_once __DIR__.'/classes/style-bdd.php';
require_once __DIR__.'/classes/band-bdd.php';
require_once __DIR__.'/classes/band-class.php';
require_once __DIR__.'/classes/style-class.php';

$bandDb = new band_Db();
$styleDb = new style_Db();


var_dump($styleDb->getstyles());