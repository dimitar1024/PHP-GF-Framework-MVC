<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultRouter
 *
 * @author dimitar1024
 */

namespace GF\Routers;

class DefaultRouter implements \GF\Routers\IRouter {

    public function getURI() {
        return substr($_SERVER["PHP_SELF"], strlen($_SERVER['SCRIPT_NAME']) + 1);
    }

    public function getPost() {
        return $_POST;
    }

}

