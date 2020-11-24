<?php
namespace chikari\core;

use chikari\core\Router;
use chikari\core\db\DbModel;
use chikari\core\Request;
use chikari\core\Session;
use chikari\core\db\Database;
use chikari\core\Response;
use chikari\core\Controller;


class Application {
    public static string $ROOT_DIR;

    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public Database $db;
    public string $userClass;
    public Response $response;
    public Session $session;
    public ?Controller $controller = null;
    public ?UserModel $user;
    public View $view;
    public static Application $app;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->view = new View();
        $this->router = new Router($this->request, $this->response);

        $this->db = new Database($config['db']);

        $primaryValue = $this->session->get('user');
        if($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    /**
     * Get the value of controller
     */ 
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set the value of controller
     *
     * @return  self
     */ 
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user) 
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout() 
    {
        $tihs->user = null;
        $this->session->remove('user');
    }
}
?>