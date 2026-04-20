<?php

namespace App\Core;

use BadMethodCallException;
use InvalidArgumentException;

readonly class Route
{
    /**
     * @param  string  $method
     * @param  string  $path
     * @param  class-string  $controller
     * @param  string  $action
     */
    public function __construct(
        public string $method,
        public string $path,
        public string $controller,
        public string $action
    ){}

    /**
     * @return mixed the result of the controller action
     * @throws InvalidArgumentException on Invalid controller
     * @throws BadMethodCallException on Invalid action
     */
    public function resolve(): mixed
    {
       if(!class_exists($this->controller)) {
           throw new InvalidArgumentException('Controller not found: '.$this->controller);
       }

       if(!method_exists($this->controller, $this->action)) {
           throw new BadMethodCallException('Method not found: '.$this->controller.'::'.$this->action);
       }

       return call_user_func([$this->controller, $this->action]);
    }
}