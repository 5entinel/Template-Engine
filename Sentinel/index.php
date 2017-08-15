<?php

    /**
    * This is just a simple example
    *
    **/

    require_once 'Sentinel/SentinelAutoload.php';

    use Sentinel\Sentinel;

    try {
        
        $Sentinel = new Sentinel([
            'binder' => ['{{', '}}'],
            'dir' => __DIR__.'/tpl'
        ]);
        
        /** Assign **/
        $Sentinel->assign('project_name', 'Sentinel');
        
        /** Multi Assign **/
        $Sentinel->assign([
            
            'title' => 'Sentinel Template engine',
            
            'me' => [
                'name' => 'Dammy',
                'age' => '18',
                'level' => 'novice'
            ],
            
        ]);
        
        $Sentinel->build('index');
        
        
    } catch (\Sentinel\Exception\Build | \Sentinel\Exception\Config $e) {
        
        die($e->getMessage());
        
    }
