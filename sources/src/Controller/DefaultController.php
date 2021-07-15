<?php

namespace App\Controller;

class DefaultController
{
    /**
     * @Route ("/", name="default_index")
     */
    public function indexAction() {
        echo 'Hello World!';
    }
}
