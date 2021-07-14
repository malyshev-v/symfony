<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

class LuckyController
{
    /**
     * @Route ("/lucky/test", name="lucky_test")
     */
    public function testAction() {
        echo 'This is the test action in lucky controller.';
    }

    /**
     * @Route ("/lucky/number", name="lucky_number")
     */
    public function numberAction() {
        echo 'Number action';
    }
}
