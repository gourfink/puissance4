<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{

	/**
     * Matches /move exactly
     *
     * @Route("/move", name="move_token")
     */
    public function move()
    {
        // ...
    }

}