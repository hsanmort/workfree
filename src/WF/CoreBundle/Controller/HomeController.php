<?php


namespace WF\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class HomeController extends Controller
{
  public function indexAction(Request $request)
  {
        return $this->render('WFCoreBundle:Home:index.html.twig');

  }
  

}