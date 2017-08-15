<?php

    namespace Sentinel\Exception;
    
    use Exception;

    class Config extends Exception
    {
        
        public function __construct($msg) {
            
            parent::__construct('Sentinel Configuration Error: '. $msg);
        }
        
    }