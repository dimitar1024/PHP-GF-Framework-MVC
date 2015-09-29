<?php

namespace GF;


class InputData
{
    private static $_instance = null;
    private $_get = array();
    private $_post = array();
    private $_cookies = array();

    private function __construct()
    {
        $this->_cookies = $_COOKIE;
    }

    /**
     * @return InputData
     */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new InputData();
        }

        return self::$_instance;
    }

    /**
     * @param array $get
     */
    public function setGet($get)
    {
        if (is_array($get)) {
            $this->_get = $get;
        }
    }

    /**
     * @param array $post
     */
    public function setPost($post)
    {
        if (is_array($post)) {
            $this->_post = $post;
        }
    }

    public function get($id, $normalize = null, $default = null)
    {
        if ($this->hasGet($id)) {
            return Normalizer::normalize($this->_get[$id], $normalize);
        }

        return $default;
    }

    public function getForDb($name, $normalize = null, $default = null){
        $normalize = 'noescape|' . $normalize;

        return $this->get($name, $normalize, $default);
    }

    public function post($name, $normalize = null, $default = null)
    {
        if ($this->hasPost($name)) {
            return Normalizer::normalize($this->_post[$name], $normalize);
        }

        return $default;
    }

    public function postForDb($name, $normalize = null, $default = null){
        $normalize = 'noescape|' . $normalize; // data must clear for database

        return $this->post($name, $normalize, $default);
    }

    public function cookies($name, $normalize = null, $default = null)
    {
        if ($this->hasCookies($name)) {
            return Normalizer::normalize($this->_cookies[$name], $normalize);
        }

        return $default;
    }

    public function cookiesForDb($name, $normalize = null, $default = null){
        $normalize = 'noescape|' . $normalize; // data must clear for database

        return $this->cookies($name, $normalize, $default);
    }

    private function hasGet($id)
    {
        return array_key_exists($id, $this->_get);
    }

    private function hasPost($name)
    {
        return array_key_exists($name, $this->_post);
    }

    private function hasCookies($name)
    {
        return array_key_exists($name, $this->_cookies);
    }
}