<?php

const ROOT = __DIR__;

require "vendor/autoload.php";
use App\Manager\ArticleManager;

$manager = new ArticleManager();
$manager->save();

