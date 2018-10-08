<?php

namespace Template\Support\Traits;

use Illuminate\Support\Facades\File;

trait TemplateFileMetadata
{
    /**
     * Allowed keys in headers.
     *
     * @var array
     */
    protected static $headers = ["Template Name", "Author", "Description", "Icon", "Version"];

    /**
     * Array of view templates.
     *
     * @var array
     */
    protected $templates;

    /**
     * Retrieve metadata from a file.
     *
     * @param  string $path
     * @return array
     */
    public static function getFileData($path)
    {
        $metadata = [];
        try {
            $fp = fopen($path, 'r');
            $pages = fread($fp, 8192);
            fclose($fp);
            $file_data = str_replace("\r", "\n", $pages);
            $headers = self::$headers;
            foreach ($headers as $field => $regex) {
                if (preg_match('/^[ \t\/*#@]*' . preg_quote($regex, '/') . ':(.*)$/mi', $file_data, $match) && $match[1]) {
                    $metadata[camel_case($regex)] = trim($match[1]);
                } else {
                    $metadata[camel_case($regex)] = "";
                }
            }
        } catch (\Exception $e) {
            return [];
        }

        return $metadata;
    }

    /**
     * Get the templates from merged from this module and with the
     * active theme.
     *
     * @return array
     */
    public static function getTemplatesFromFiles()
    {
        $instance = new static;

        $theme_path = themes_path(settings('active_theme', 'default'))."/views/templates";
        $templates = [];
        if (file_exists($theme_path)) {
            $templates = File::files(themes_path(settings('active_theme', 'default'))."/views/templates");
        }
        $templatesTemplates = File::files(get_module('template')."/views/templates");
        $templates = array_merge($templatesTemplates, $templates);

        foreach ($templates as $i => $template) {
            $meta = self::getFileData($template->getPathName());
            $instance->templates[basename($template->getFileName())] = [
                'path' => $template->getPathName(),
                'name' => $meta['templateName'],
                'icon' => isset($meta['icon']) && ! empty($meta['icon']) ? $meta['icon'] : 'label',
                'value' => str_replace(".blade.php", "", $template->getFileName()),
                'metadata' => $meta,
            ];
        }

        return array_values($instance->templates);
    }
}
