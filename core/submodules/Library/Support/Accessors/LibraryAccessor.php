<?php

namespace Library\Support\Accessors;

use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\File;
use Parchment\Helpers\Word;

trait LibraryAccessor
{
    /**
     * Gets the thumbnail of the library resource.
     *
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return $this->guessThumbnailFromMimeType($this->mimetype, $this->url);
    }

    /**
     * Gets the human readable size of the library resource.
     *
     * @return string
     */
    public function getFilesizeAttribute()
    {
        return Word::bytes($this->size);
    }

    /**
     * Gets the icon of the mimetype of the library resource.
     *
     * @return string
     */
    public function getIconAttribute()
    {
        return $this->guesIconFromMimeType($this->mimetype);
    }

    protected function guessThumbnailFromMimeType($mime, $url = false)
    {
        if ($mime !== config('thumbnails.accepted')) {
            switch ($mime) {
                case 'application/zip':
                case 'application/rar':
                case 'application/x-zip-compressed':
                case 'application/x-rar-compressed':
                    $archivePath = settings('package.storage_path', 'public/package').'/'.date('Y-m-d', strtotime($this->created_at))."/{$this->id}";
                    if (file_exists(storage_path("$archivePath/thumbnail.png"))) {
                        $url = url("storage/$archivePath/thumbnail.png");
                    } else {
                        // Brownish Monokai
                        $url = config("thumbnails.thumbnails.$mime");
                    }
                    break;

                case 'audio/mpeg':
                case 'audio/mp3':
                    $url = config("thumbnails.thumbnails.$mime");
                    break;

                case 'video/*':
                case 'video/ogv':
                case 'video/ogg':
                case 'video/wmv':
                case 'video/mp4':
                    $url = config("thumbnails.thumbnails.video/mp4");
                    break;

                case null:
                default:
                    $url = url("storage/$url");
                    break;
            }
        }

        return $url;
    }

    /**
     * Gues the icon of the lbrary entry.
     *
     * @param  string $mime
     * @return string
     */
    protected function guesIconFromMimeType($mime)
    {
        $icon = 'perm_media';
        $icons = config('thumbnails.icons', []);
        if (array_key_exists($mime, $icons)) {
            $icon = $icons[$mime];
        }

        return $icon;
    }

    /**
     * Check if mimetype of file is extractable.
     *
     * @param  string $mimetype
     * @return boolean
     */
    public static function isExtractable($mimetype)
    {
        $extractables = config("extractables", []);
        if (in_array($mimetype, $extractables)) {
            return true;
        }

        return false;
    }

    public static function extract($path, $outputPath)
    {
        try {
            if (File::exists($path)) {
                $zipper = new Zipper;

                if (! file_exists($outputPath)) {
                    File::makeDirectory($outputPath, $mode = 0777, true, true);
                }
                $zipper->zip($path)->extractTo($outputPath);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return true;
    }
}
