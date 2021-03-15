<?php
use Cake\Core\Configure;

Configure::load('Trois/Tinymce.tinymce');
collection((array) Configure::read('Trois/Tinymce.config'))->each(function ($file) {
    Configure::load($file,'default',true);
});
