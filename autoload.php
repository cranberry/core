<?php

/*
 * This file is part of Cranberry\Core
 */
namespace Cranberry\Core;

$pathCranberryCoreBase = __DIR__;
$pathCranberryCoreSrc = $pathCranberryCoreBase . '/src/Core';

/*
 * Initialize autoloading
 */
include_once( $pathCranberryCoreSrc . '/Autoloader.php' );
Autoloader::register();
