<?php
/**
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

require __DIR__ . '/../bootstrap/autoload.php';

/**
 *------------------------------------------------------------------------------
 * Error Reporting System & Exception Handlers
 *------------------------------------------------------------------------------
 *
 * These files are for development environment only as it may print out
 * sensitive information from the server.
 *
 */

require __DIR__ . '/../bootstrap/exceptions.php';

/**
 *------------------------------------------------------------------------------
 * Application
 *------------------------------------------------------------------------------
 *
 * Get the app instance.
 *
 */

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
