<?php

namespace AppBundle\Controller;
use AppBundle\AppBundle;
use AppBundle\Entity\Address;
use AppBundle\Entity\Member;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Created by PhpStorm.
 * User: yoann
 * Date: 06/10/2017
 * Time: 00:30
 */

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function getHomepageAction(Request $request)
    {
        return new Response("<html><body></body></html>");
    }
}