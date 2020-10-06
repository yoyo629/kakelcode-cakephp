<?php

namespace App\Controller;

use App\Controller\AppController;

class HelloController extends AppController
{
    public $autoRender = false;

    public function index()
    {
        echo "<html><body><h1>Hello</h1>";
        echo "<p>This is page.</p></body></html>";
    }
}
