<?php

/**
 * Description of FrontController
 *
 * @author boneff
 */
class FrontController{
    const DEFAULT_CONTROLLER = "Web";
    const DEFAULT_ACTION     = "index";
    
    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();
    protected $basePath      = "controllers/";

    public function __construct(array $options) {
        if (isset($options["controller"])) {
            $this->setController($options["controller"]);
        }
        if (isset($options["action"])) {
            $this->setAction($options["action"]);
        }
        if (isset($options["params"])) {
            $this->setParams($options["params"]);
        }
    }

    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
            throw new InvalidArgumentException(
                "The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
        return $this;
    }
    
    public function setAction($action) {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new InvalidArgumentException(
                "The controller action '$action' has been not defined.");
        }
        $this->action = $action;
        return $this;
    }
    
    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }

    public function run() {
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }
}