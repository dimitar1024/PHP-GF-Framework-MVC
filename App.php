<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of App
 *
 * @author dimitar1024
 */

namespace GF;

include_once 'Loader.php';

class App {

    private static $_instance = null;
    private $_config = null;
    
    private function __construct() {
        \GF\Loader::registerNamespace('GF', dirname(__FILE__) . DIRECTORY_SEPARATOR);
        \GF\Loader::registerAutoLoad();
    }

    public function run() {
         $this->_config = \GF\Config::getInstance();
       //if config folder is not set, use defaultone
        if ($this->_config->getConfigFolder() == null) {
            $this->setConfigFolder('../config');
        }
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
}

