<?php

namespace App\Components;
use T4\Commands\Application;
use T4\Http\E403Exception;
use T4\Mvc\Route;

class Controller
    extends \T4\Mvc\Controller
{
    protected function afterAction($action)
    {

         $this->data->user = $this->app->user ? $this->app->user->name :  null;

        return true;
    }

    protected  function error($code, $message){
        header('HTTP/1.0 '.$code.' Forbidden', true, $code);
        $route = new Route($this->app->config->errors[$code]);
        $route->params->message=$message;
        $this->app->runRoute($route, 'html');
        die;
    }

}