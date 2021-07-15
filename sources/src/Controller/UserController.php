<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * @Route ("/user/test", name="user_test")
     */
    public function testAction() {
        echo 'This is the test action in user controller.';
        die;
    }
}
