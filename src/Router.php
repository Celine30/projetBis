<?php


namespace Project;
use Project\Controller;

use Twig\Extension\DebugExtension;
use Twig\Extensions\TextExtension;
//use Twig\Extra\String\StringExtension;

class Router
{
    private $twig = null;

    private $controller = null;

    private $method = null;

    public function __construct()
    {
        $this->setTemplate();
        $this->parseUrl();
        $this->setController();
        $this->setMethod();
    }

    function setTemplate()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/view');
        $this->twig = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);

        $this->twig->addExtension(new DebugExtension());
        $this->twig->addGlobal('session', $_SESSION);
        $this->twig->addExtension(new TextExtension());
       // $this->twig->addExtension(new StringExtension());

    }

    public function parseUrl()
    {
        $action = filter_input(INPUT_GET, 'action');
        if (!isset($action)) {
            $action = 'user';
        }
        $action = explode('!', $action);
        $this->controller = $action[0];
        $this->method = count($action) == 1 ? 'connexion' : $action[1];
    }


    public function setController()
    {
        $this->controller = ucfirst(strtolower($this->controller)) . 'Controller';
    }

    public function setMethod()
    {
        $this->method = strtolower($this->method);
    }


    function display()
    {
        $controller = 'Project\Controller\\'. $this->controller;
        $UserController = new $controller($this->twig);
        $method = $this->method;
        $response = $UserController->$method();
        echo filter_var($response);

    }

}