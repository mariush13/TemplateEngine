<?php

/*
 * advPath by Mariush
 * version 1.1.0
 * 
 */

class Path {
    
    public $sitePath = '/';
    
    public function __construct(){
        
    }
  
    public function getPath($fullPath = false, $file = false, $get = false, $fullArray = false){
        
        $path = urldecode($_SERVER['REQUEST_URI']);     
        if ($this->sitePath != '/') {
            $path = str_replace($this->sitePath, '', $path);
        }
        $url = explode('?',$path)[0];
        $getParams = explode('?',$path)[1];
        $urlArray = explode('/',$url);
        $getArray = explode('&',$getParams);
        if ($getArray != null){
            foreach ($getArray as $param){
                $params[] = array('name'=>explode('=',$param)[0], 'value' => explode('=',$param)[1]);
            }
        }
        $last = $urlArray[sizeof($urlArray)-1];
        if (preg_match('|^.*(\\.).*$|', $last,$fName)){
             $fileName = $fName[0];
             unset($urlArray[sizeof($urlArray)-1]);
             $url = str_replace('/'.$fileName,'',$url);
        }
        if ($fullPath){
            if ($fullArray){
                unset($urlArray[0]);
                return array('url' => $urlArray, 'file' => $fileName, 'params' => $params);
            }
            $return = $url;
            if ($file){
                $return .= '/'.$fileName;
            }
            if ($get){
                $return .= '?'.$getParams;
            }
            return $return;
        }else {
            $return = $url;
            if ($file && $fileName != ''){
                $return = $fileName;
            }
            if ($get) {
                $return .= '?'.$getParams;
            }
            return $return;
        }
    }  
    
}
    
?>