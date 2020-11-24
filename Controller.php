<?php 
namespace chikari\core;

use chikari\core\middlewares\BaseMiddleware;

class Controller {
    public string $layout = 'main';
    public string $action = '';
    /**
     * @var \chikari\core\middlewares\BaseMiddleware[]
     */
    protected array $middlewares = [];


    public function setLayout($layout) {
        $this->layout = $layout;
    }
    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    

    /**
     * Get the value of middlewares
     *
     * @return  \chikari\core\middlewares\BaseMiddleware[]
     */ 
    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}

?>