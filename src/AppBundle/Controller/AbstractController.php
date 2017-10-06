<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AbstractController extends Controller
{
    public function getEm()
    {
        return $this->getDoctrine()->getManager();
    }

}