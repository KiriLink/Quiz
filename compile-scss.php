<?php

require_once 'vendor/autoload.php';

use Leafo\ScssPhp\Compiler;

$scss = file_get_contents('public/css/countdown.scss');

$compiler = new Compiler();
$css = $compiler->compile($scss);

file_put_contents('public/css/countdown.css', $css);

echo "SCSS compilado exitosamente!\n";
