<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validatator
 *
 * @author janis.janovskis@gmail.com
 */
class validatator {
    //put your code here
    
    private $patterns = array();
    /**
     *
     * @var <string> String we are going to validate abd replace malicious code 
     */
    private $script;
    
    
    public $safeString;


    /**
     * 
     * @param array $patterns
     */
    
    
    public function __construct(array $patterns) {
        $this->patterns = $patterns;
    }

    /**
     * 
     * @return <array> patterns array
     */
    
    public function getPatterns(){
        return $this->patterns;
    }
    
    /**
     * 
     * @param <string> $item
     */
    public function setPattern($item){
        array_push(&$this->patterns, $item);
    }
    
    /*
     * searches and returns for a particular pattern
     */
    
    public function getPattern($pattern){
        return (in_array($pattern, $this->patterns)) ? $pattern : NULL;
    }
    
    public function loadMalicousScript($script){
        switch (TRUE) {
            case is_file($script):
                
                $this->script = file_get_contents($script);

                break;
            
            case is_string($script):
                
                $this->script = $script;
                
                break;

            default:
                return;
                break;
        }
        
        return $this;
    }
    
    public function analyzeReplace(){
        
        $this->safeString = preg_replace($this->patterns, "", $this->script);
        
        return $this;
        
    }
    
    public function __toString() {
        return $this->safeString;
    }
}

?>
