<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author dimitar1024
 */
namespace GF\Session;
interface ISession {
    
    public function getSessionId();
    public function saveSession();
    public function destroySession();
    public function __get($name);
    public function __set($name,$value);
}


