<?php
namespace App\Controller;

use Cake\Controller\Controller;

class AccueilsController extends Controller
{

    public function initialize()
    {
        // Active toujours le component CSRF.
        $this->loadComponent('Csrf');
    }
    public function index() {
        $this->render('/accueils/index');
    }

}
