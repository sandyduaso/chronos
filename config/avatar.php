<?php

use Laravolt\Avatar\Generator\DefaultGenerator;

return [

    /**
     *--------------------------------------------------------------------------
     * Image Driver
     *--------------------------------------------------------------------------
     * Avatar use Intervention Image library to process image.
     * Meanwhile, Intervention Image supports "GD Library" and "Imagick" to process images
     * internally. You may choose one of them according to your PHP
     * configuration. By default PHP's "GD Library" implementation is used.
     *
     * Supported: "gd", "imagick"
     *
     */
    'driver' => 'gd',

    // Initial generator class
    'generator' => DefaultGenerator::class,

    // Whether all characters supplied must be replaced with their closest ASCII counterparts
    'ascii' => false,

    // Image shape: circle or square
    'shape' => 'square',

    // Image width, in pixel
    'width' => 300,

    // Image height, in pixel
    'height' => 300,

    // Number of characters used as initials. If name consists of single word, the first N character will be used
    'chars' => 2,

    // font size
    'fontSize' => 78,

    // convert initial letter to uppercase
    'uppercase' => false,

    // Fonts used to render text.
    // If contains more than one fonts, randomly selected based on name supplied
    'fonts' => ['path/to/OpenSans-Bold.ttf', 'path/to/rockwell.ttf'],

    // List of foreground colors to be used, randomly selected based on name supplied
    'foregrounds' => [
        '#FFFFFF',
    ],

    // List of background colors to be used, randomly selected based on name supplied
    'backgrounds' => [
        '#85A0A1',
        '#BEAAD0',
        '#185686',
        '#D3C5B6',
    ],

    'border' => [
        'size' => 1,

        // border color, available value are:
        // 'foreground' (same as foreground color)
        // 'background' (same as background color)
        // or any valid hex ('#aabbcc')
        'color' => 'background'
    ]
];
