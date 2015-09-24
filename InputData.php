<?php

namespace GF;

/**
 * Description of InputData
 *
 * @author dimitar1024
 */
class InputData {
    private static $_instance = null;
    private $_get = null;    
    private $_post = null;
    private $_cookies = null;

private function __construct() {
    $this->_cookies = $_COOKIE;
    }

    
    public function setPost($ar) {
        if (is_array($ar)) {
            $this->_post = $ar;
        }
    }

    public function setGet($ar) {
        if (is_array($ar)) {
            $this->_get = $ar;
        }
    }

    public function hasGet($id) {
        return array_key_exists($id, $this->_get);
    }

    public function hasPost($name) {
        return array_key_exists($name, $this->_post);
    }
    
    public function hasCookies($name) {
        return array_key_exists($name, $this->_cookies);
    }

    
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new \GF\App();
        }
        return self::$_instance;
    }
}
