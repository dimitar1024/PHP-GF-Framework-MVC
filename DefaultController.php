<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DefaultController
 *
 * @author dimitar1024
 */

namespace GF;

class DefaultController {
    
    /**
     *
     * @var \GF\App 
     */
    public $app;
    /**
     *
     * @var \GF\View
     */
    public $view;
    /**
     *
     * @var \GF\Config 
     */
    public $config;
    /**
     *
     * @var \GF\InputData 
     */
    public $input;

    public function __construct() {
        $this->app = \GF\App::getInstance();
        $this->view = \GF\View::getInstance();
        $this->config = $this->app->getConfig();
        $this->input = \GF\InputData::getInstance();
    }
    
    public function jsonResponse(){
        
    }

}

