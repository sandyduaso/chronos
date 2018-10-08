<?php

$modules = get_modules_path();

collect($modules)->each(function ($module) {
    if (file_exists("{$module}/routes/web.php")) {
        require_once $module."/routes/web.php";
    }
});
