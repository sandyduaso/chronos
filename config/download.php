<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Allowed File Extensions
     *--------------------------------------------------------------------------
     *
     * Array of downloadable files.
     * The application, by default, is using the 'restricted' key for checking
     * if a file is allowed.
     *
     */
    'allowed' => [
        // '*',
    ],

    /**
     *--------------------------------------------------------------------------
     * Restricted File Extensions
     *--------------------------------------------------------------------------
     *
     * Non-downloadable files.
     * By default, the application will check these arrays if the file requested
     * for download is not restricted.
     *
     */
    'restricted' => [
        'php',
        'env',
    ],

    /**
     *--------------------------------------------------------------------------
     * Array of Supported file extensions
     *--------------------------------------------------------------------------
     *
     */
    'supported' => [
        '7z',
        'css',
        'docx',
        'gif',
        'htm',
        'html',
        'jpe',
        'jpeg',
        'jpg',
        'js',
        'json',
        'map',
        'mp3',
        'mp4',
        'mpeg',
        'mpga',
        'ogg',
        'ogv',
        'pdf',
        'png',
        'ppt',
        'pptx',
        'rar',
        'swf',
        'tiff',
        'wmv',
        'xls',
        'xlsx',
        'xml',
        'zip',
        'woff',
        'ttf',

        // Uppercase
        '7Z',
        'CSS',
        'DOCX',
        'GIF',
        'HTM',
        'HTML',
        'JPE',
        'JPEG',
        'JPG',
        'JS',
        'JSON',
        'MAP',
        'MP3',
        'MP4',
        'MPEG',
        'MPGA',
        'OGG',
        'OGV',
        'PDF',
        'PNG',
        'PPT',
        'PPTX',
        'RAR',
        'SWF',
        'TIFF',
        'WMV',
        'XLS',
        'XLSX',
        'XML',
        'ZIP',
        'WOFF',
        'TTF',
    ]
];
