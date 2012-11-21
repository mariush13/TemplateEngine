<?php
 
ini_set('Display_errors', 'On');
ini_set('Error_reporting','On');
error_reporting(E_ALL);

require './TemplateEngine.class.php';
require '.../advPath/Path.class.php';

$view = new TemplateEngine;
$view->templateDir = './templates';
$view->init();
/*
 * For FSite, array keys can be pages ID's
 */
$view->pages = array(
    '.' => 'layout',
    '*' => 'default',
    '/' => 'mainpage',
    '/strona_glowna' => 'mainpage',
    '/podstrona' => 'subpage'
);

$path = new Path;
$page = $path->getPath(false, false, false, false);

$view->output = array(
	'text' => 'some text',
	'blocks' => array(
        '1' => array(
            'template' => 'block1.twig',
            'content' => 'block1 content',
            'title' => 'block1 title',
            'margin' => '0px;'
        ),
        '2' => array(
            'template' => 'block1.twig',
            'content' => 'block2 content',
            'title' => 'block1 title',
            'margin' => '10px;'
        )
    )
);

/*
 * For FSite, $page can be page ID
 */
$view->show($page);

?>