<?php

    namespace Sentinel\Exception;
    
    use Exception;

    class Build extends Exception
    {
        
        public function __construct($msg) {
            
            parent::__construct('Sentinel Build Error: '. $msg);
        }
    }