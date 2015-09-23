<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GF;

/**
 * Description of FrontController
 *
 * @author dimitar1024
 */
class FrontController {

    private static $_instance = null;

    private function __construct() {
        
    }

    /**
     * 
     * @return \GF\App
     */
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new \GF\App();
        }
        return self::$_instance;
    }

    public function dispatch() {
        
    }

}
