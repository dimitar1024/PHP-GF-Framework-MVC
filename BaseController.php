<?php

namespace GF;


use GF\DB\SimpleDB;
use GF\Sessions\ISession;

class BaseController
{

    /**
     * @var App
     */
    protected $app;

    /**
     * @var View
     */
    protected $view;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var InputData
     */
    protected $input;

    protected $validator;

    /**
     * @var SimpleDB
     */
    protected $db;

    /**
     * @var ISession
     */
    protected $session;

    public function __construct()
    {
        $this->app = App::getInstance();
        $this->view = View::getInstance();
        $this->config = $this->app->getConfig();
        $this->input = InputData::getInstance();
        $this->session = $this->app->getSession();
        $this->db = new SimpleDB();
    }

    protected function redirect($uri)
    {
        header("Location: $uri");
    }
}