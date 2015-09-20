<?php
namespace GF;
/**
 * Description of Config
 *
 * @author dimitar1024
 */
class Config {
    private function __construct() {
        
    }
    
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new \GF\Config();
        }
        
        return self::$_instance;
    }
}
