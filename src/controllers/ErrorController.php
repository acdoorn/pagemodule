<?php namespace Acdoorn\Pagemodule;
use BaseController;
use View;
use Request;
class ErrorController extends BaseController {

    protected $layout = 'pagemodule::layouts.base';

    public function showError($errorcode) 
    {
        $this->layout->menu = View::make('pagemodule::partials.menu');
        $this->layout->content = View::make('pagemodule::error.'.$errorcode);
    }
}
