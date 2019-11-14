<?php


namespace Project;
use Project\Controller;

use Twig\Extension\DebugExtension;
use Twig\Extensions\TextExtension;


class Router
{

    const DEFAULT_PATH = 'Project\Controller\\';

    const DEFAULT_CONTROLLER = 'UserController';

    const DEFAULT_METHOD = 'logout';

    private $twig = null;

    private $controller = self::DEFAULT_CONTROLLER;

    private $method = self::DEFAULT_METHOD;


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
    }

    public function parseUrl()
    {
        $action = filter_input(INPUT_GET, 'action');
        if (!isset($action)) {
            $action = 'user';
        }
        $action = explode('!', $action);
        $this->controller = $action[0];
        $this->method = count($action) == 1 ? 'logout' : $action[1];
    }


    public function setController()
    {
        $this->controller = ucfirst(strtolower($this->controller)) . 'Controller';

        $this->controller = self::DEFAULT_PATH . $this->controller;

        if (!class_exists($this->controller)) {
            $this->controller = self::DEFAULT_PATH . self::DEFAULT_CONTROLLER;
        }
    }

    public function setMethod()
    {
        $this->method = strtolower($this->method);

        if (!method_exists($this->controller, $this->method)) {
            $this->method = self::DEFAULT_METHOD;

        }
    }

    function display()
    {
        $UserController = new $this->controller($this->twig);
        $method = $this->method;
        $response = $UserController->$method();
        echo filter_var($response);
    }

}