<?php

namespace App\Controller;

class DefaultController
{
    /**
     * @Route ("/", name="index")
     */
    public function indexAction() {
        echo 'Hello World!';
    }
}
