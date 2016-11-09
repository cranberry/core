<?php

/*
 * This file is part of Cranberry\Core
 */
namespace Cranberry\Core;

$pathBaseCore	= __DIR__;
$pathSrcCore	= $pathBaseCore . '/src/Core';
$pathVendorCore	= $pathBaseCore . '/vendor';

/*
 * Initialize autoloading
 */
include_once( $pathSrcCore . '/Autoloader.php' );
Autoloader::register();
