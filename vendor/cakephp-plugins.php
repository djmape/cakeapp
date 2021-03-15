<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'CkEditor' => $baseDir . '/vendor/cakecoded/ckeditor/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Froala' => $baseDir . '/vendor/froala/wysiwyg-cake/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/',
        'Trois/Tinymce' => $baseDir . '/vendor/3xw/cakephp-tinymce/',
        'WyriHaximus/TwigView' => $baseDir . '/vendor/wyrihaximus/twig-view/',
        'tinymce' => $baseDir . '/plugins/tinymce/'
    ]
];