<?php

/*
 * TemplateEngine by Mariush
 * version 1.0.0
 * 
 * Pages:
 * 
 * $pages['.'] - template for extended layout 
 * $pages['*'] - template for unknown or default page 
 * $pages['/'] - template for main (root) page
 * $pages['path_or_id'] - your defined pages
 * 
 */

class TemplateEngine {
    
    public $templates = array();
    public $pages = array();
    public $output = array();
    public $templateDir = './TemplateEngine/templates';
    public $twigAutoloaderPath = './vendor/twig/twig/lib/Twig';
    
    public function __construct() {
        //require './TemplateEngine/Template.class.php';
        $this->readTemplateDir();
        require_once $this->twigAutoloaderPath.'/Autoloader.php';
        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem($this->templateDir);
        $this->twig = new Twig_Environment($loader, array());  
        
    }
    
    public function init(){
        $this->readTemplateDir();
    }
    
    protected function readTemplateDir(){
        $dir = opendir($this->templateDir);
        while($file = readdir($dir)) {
            if ($file != '.' && $file != '..' && preg_match('/.twig$/',$file)){
        	    $this->templates[] = $file;
            }
        }
        closedir($dir);
    }
    
    public function show($page) {   
        $this->twig->clearCacheFiles();
        $array = array ('template' => $this->output);
        if (isset($this->pages['.']) && file_exists($this->templateDir.'/'.$this->pages['.'].'.twig')){
            $array = array_merge($array, array('layout' => $this->pages['.'].'.twig'));
        }
        if (isset($this->pages[$page]) && file_exists($this->templateDir.'/'.$this->pages[$page].'.twig')){ 
            echo $this->twig->render($this->pages[$page].'.twig',$array);
        }else {
            if (isset($this->pages['*']) && file_exists($this->templateDir.'/'.$this->pages['*'].'.twig')){
                echo $this->twig->render($this->pages['*'].'.twig',$array);
            }else{
                echo 'There\'s no template file for this page';
            }   
        }   
    }
    
}


?>