# cakephp-tinymce plugin for CakePHP
Tinymce 4 cakephp

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

	composer require 3xw/cakephp-tinymce
	
In your src/Application.php file 

	$this->addPlugin(\Trois\Tinymce\Plugin::class, ['boostrap' => true]);

## Configuration
At the end of config/boostrap file
	
	Configure::write('Trois/Tinymce.config', ['tinymce']);
	
With your own configuration, create file config/tinymce.php ex:

	<?php
	use Cake\Routing\Router;
	
	return [
	  'Trois/Tinymce'  => [
	    'height' => '500',
	    'language' => 'fr_FR',
	    'language_url' => 'https://static.3xw.ch/tinymce/lang/fr_FR.js',
	    'menubar' => false,
	    'plugins' => ['advlist autolink lists link charmap print preview searchreplace visualblocks code fullscreen emoticons insertdatetime table contextmenu paste  code help wordcount'],
	    'toolbar'  => 'attachment | insert | undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist | emoticons | code | removeformat ',
	    'block_formats' => 'Paragraphe=p;Titre 1=h1;Titre 2=h2;Titre 3=h3',
	    'formats' => [
	      'bold' => ['inline'  => 'strong'],
	      'italic' => ['inline'  => 'em'],
	      'underline' => ['inline'  => 'u'],
	      'strikethrough' => ['inline'  => 'del'],
	      'lead' => ['block'  => 'p', 'classes'  => 'lead'],
	    ],
	    'valid_elements' => '*[style],p[style],strong,em,i,u,del,a[href|target],ul,ol,li[style],table,th,td[style],tr,img[src|style|class|alt|width|height]',
	    'valid_styles' => ['*' => 'text-align,color'],
	    'content_css' => []
	  ]
	];
	
## Usage
In your view files:

	echo $this->element('Trois/Tinymce.tinymce',[
	  'field' => 'content',
	  'value' => $post->content,
	  'init' => [ // optional
	    'some_settings' => 'coucou',
	    'toolbar'  => 'code | removeformat ', // override settings and add only code & removeformat
	]);