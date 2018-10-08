<?php

/**
 *------------------------------------------------------------------------------
 * NOTICE
 *------------------------------------------------------------------------------
 * If you can't use the public/ folder as your Document Root, you may use
 * this file instead. Make sure you also have a .htaccess along side this
 * file.
 *
 * It is IMPORTANT to note that THIS IS LESS SECURE as the whole Pluma PHP Code
 * is beaming across the universe.
 *
 * You MIGHT need to put an index(.php||.html) on every folder just to make sure.
 *
 * Anyway...
 * Also note, you MIGHT need to change the files/folders permission.
 * If the stylesheet and/or javascript files inside your module
 * doesn't load, try to set the directory and files to 0777, or the equivalent
 * on your system.
 *
 * END OF NOTICE
 *------------------------------------------------------------------------------
 *
 * Pluma - A Web CMS
 *
 * @package  Pluma
 * @author   John Lioneil P. Dionisio <john.dionisio1@gmail.com>
 *
 *------------------------------------------------------------------------------
 * Register The Auto Loader
 *------------------------------------------------------------------------------
 *
 * Composer provides a convenient, automatically generated class loader for
 * our application. Code below will require it into the script here so that
 * we don't have to worry about manual loading any of our classes later on.
 *
 */

require __DIR__ . '/bootstrap/autoload.php';

/**
 *------------------------------------------------------------------------------
 * Error Reporting System & Exception Handlers
 *------------------------------------------------------------------------------
 *
 * These files are for development environment only as it may print out
 * sensitive information from the server.
 *
 */

require __DIR__ . '/bootstrap/exceptions.php';

/**
 *------------------------------------------------------------------------------
 * Application
 *------------------------------------------------------------------------------
 *
 * Get the app instance.
 *
 */
$app = require_once __DIR__ . '/bootstrap/app.php';

// Change the public_path to use current directory.
$app->instance('path.public', realpath(__DIR__));

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
