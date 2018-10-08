<?php

if (! function_exists('blacksmith_path')) {
    /**
     * The Blacksmith base path.
     *
     * @param  string $path
     * @return string
     */
    function blacksmith_path($path = "")
    {
        return realpath(__DIR__."/../$path");
    }
}

if (! function_exists('blacksmith_base_path')) {
    /**
     * The Blacksmith template path.
     *
     * @param  string $path
     * @return string
     */
    function blacksmith_base_path($path = "")
    {
        return blacksmith_path("../$path");
    }
}

if (! function_exists('blacksmith_write_to_env')) {
    /**
     * Write values to an env file.
     *
     * @param  array $data
     * @return boolean
     */
    function blacksmith_write_to_env($data)
    {
        if (! count($data)) {
            return;
        }

        $pattern = '/([^\=]*)\=[^\n]*/';

        $envFile = blacksmith_path('../../.env');

        $lines = file($envFile);
        $newLines = [];
        foreach ($lines as $line) {
            preg_match($pattern, $line, $matches);

            if (! count($matches)) {
                $newLines[] = $line;
                continue;
            }

            if (! key_exists(trim($matches[1]), $data)) {
                $newLines[] = $line;
                continue;
            }

            if (strpos(trim($matches[1]), ' ') !== false) {
                $line = trim($matches[1]) . "={$data[trim($matches[1])]}\n";
            } else {
                $value = preg_match('/\s/', $data[trim($matches[1])])
                         ? "\"{$data[trim($matches[1])]}\""
                         : $data[trim($matches[1])];
                $line = trim($matches[1]) . "={$value}\n";
            }
            $newLines[] = $line;
        }

        $newContent = implode('', $newLines);

        file_put_contents($envFile, $newContent);

        return true;
    }
}
