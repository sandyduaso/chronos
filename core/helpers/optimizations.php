<?php

function optimize_file($type, $files = [], $forceGenerateFile = false)
{
    $merger = "";

    switch ($type) {
        case 'js':
            if (! $forceGenerateFile && file_exists(storage_path('js.js'))) {
                return url('storage/js.js');
            }

            foreach ($files as $file) {
                // $merger .= include $file;
                $merger .= file_get_contents($file);
            }
            // Remove comments also applicable in javascript
            // $merger= preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $merger);
            // Remove space after colons
            // $merger= str_replace(': ', ':', $merger);
            // Remove whitespace
            // $merger= str_replace(array("\n", "\t", '  ', '    ', '    '), '', $merger);

            //Generate Etag
            // $etag = md5_file($_SERVER['SCRIPT_FILENAME']);
            // call the browser that support gzip, deflate or none at all, if the browser doest      support compression this function will automatically return to FALSE
            // ob_start('ob_gzhandler');
            // // call the generated etag
            // header("Etag: ".$etag);
            // // Same as the cache-control and this is optional
            // header("Pragma: public");
            // // Enable caching
            // header("Cache-Control: public ");
            // // Expire in one day
            // header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400 ) . ' GMT');
            // // Set the correct MIME type, because Apache won't set it for us
            // header("Content-type: text/javascript");
            // // Set accept-encoding
            // header('Vary: Accept-Encoding');
            // // Write everything out
            // echo $merger;
            // return ob_get_clean();
            if (file_put_contents(storage_path('js.js'), $merger)) {
                return true;
            }
            break;

        default:
            # code...
            break;
    }

    return null;
}
