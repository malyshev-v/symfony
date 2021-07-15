<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route ("/", name="default_index")
     */
    public function indexAction() {
        echo 'Hello World!';
        die;
    }
}
