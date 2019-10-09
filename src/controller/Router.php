<?php


namespace Project\controller;


class Router
{
    private $twig = null ;

    private $controller=null;

    private $method=null;

    public function __construct(){
     /* Set the Template Engine Twig */
     $this->setTemplate();
     $this->parseUrl();
     $this->setController();
     $this->setMethod();
    }

    function setTemplate(){
     $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../view');
     $this->twig = new \Twig\Environment($loader, [
        'cache' => false,
    ]);
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


       public function setController(){
        $this->controller = ucfirst(strtolower($this->controller)) . 'Controller';
    }

    public function setMethod(){
        $this->method = strtolower($this->method) . 'Method';
    }


    function display(){

        if ($this->controller=== 'UserController'){
            $UserController = new UserController($this->twig);

            if($this->method === 'connexionMethod') {

                $UserController->connexion();

            }elseif($this->method === 'inscriptionMethod'){

                $UserController->inscription();

            }else{
                $UserController->error();
            }
        }
 }

}


