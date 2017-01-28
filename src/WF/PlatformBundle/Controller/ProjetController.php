<?php


namespace WF\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedExecption;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use WF\PlatformBundle\Entity\Projet;
use WF\PlatformBundle\Form\ProjetType;
use WF\UserBundle\Entity\Freelancer;
use WF\PlatformBundle\Entity\Offre;
use WF\PlatformBundle\Form\OffreType;





class ProjetController extends Controller
{
 
  public function indexAction($page)
  {
    //  if($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')){

    //new added
      if($page<1)
      {
        $page=1;
        //throw new NotFoundHttpException("404 page ".$page." notFound ");
      }

    $nbPerPage=10;
    $listeProjets= $this->getDoctrine()
      ->getManager()
      ->getRepository('WFPlatformBundle:Projet')
      //->findAll()
      ->getAllProjets($page,$nbPerPage)
      ;
      $listecategorie= $this->getDoctrine()
      ->getManager()
      ->getRepository('WFPlatformBundle:Categorie')
      ->findAll()
      
      ;
      $nbPages = ceil(count($listeProjets)/$nbPerPage);
      if($page>$nbPages){
         throw new NotFoundHttpException('Page "'.$page.'" inexistante.');

      }


    return $this->render('WFPlatformBundle:Projet:index.html.twig',array(
      'listecategorie' => $listecategorie,
      'listeProjets' => $listeProjets,
      'nbPages'      => $nbPages,
      'page'         => $page
      ));

      //}
      //else{
      //   throw new AccessDeniedException('acces limite il faut etre authentifie');
      //}

  }

  
    public function viewprojetAction($page)
    {
           if($page<1)
            {
              throw $this->createNotFoundExeption("404 page ".$page." notFound ");
            }

          $nbPerPage=10;
          $listeProjets= $this->getDoctrine()
            ->getManager()
            ->getRepository('WFPlatformBundle:Projet')
            //->getProjets($page,$nbPerPage)
            ->getAllProjets($page,$nbPerPage)
            ;
            $nbprojet=count($listeProjets);
            $nbPages = ceil(count($listeProjets)/$nbPerPage);
            if($page>$nbPages){
               throw new NotFoundHttpException('Page "'.$page.'" inexistante.');}

          return $this->render('WFPlatformBundle:Projet:viewprojet.html.twig',array(
            'listeProjets'=>$listeProjets,
            'nbPages'     =>$nbPages,
            'nbprojet'    => $nbprojet,
            'page'        =>$page
            ));
    }
    

  
  //new added
    public function viewidprojetAction($id)
      {
        $em= $this->getDoctrine()->getManager();
        $projet = $em->getRepository('WFPlatformBundle:Projet')->find($id);
        if($projet==null){
          throw new NotFoundHttpException("le projet N'existe plus");
            }
            return $this->render('WFPlatformBundle:Projet:viewprojet.html.twig',array('projet' =>  $projet));

      }


    public function addprojetAction(Request $request)
    {
      if ($request->isMethod('POST'))
      {
        $request->getSession()->getFlashBag()->add('info','your project has been added wait for the confirmation.');
        return $this->redirect($this->generateUrl('wf_platform_viewprojet',array('id'=>1)));
        }
      return $this->render('WFPlatformBundle:Projet:addprojet.html.twig');
    }

    /**
     * @Security("has_role('ROLE_CLIENT')")
    */
     public function addAction(Request $request)
        {
          $projet = new Projet();
          $form = $this->get('form.factory')->create(new ProjetType(), $projet);

          if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($projet);
            $em->flush();
            $projet->upload();
            $em->persist($projet);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirect($this->generateUrl('wf_platform_view', array('id' => $projet->getId())));
          }

          return $this->render('WFPlatformBundle:Projet:add.html.twig', array(
            'form' => $form->createView(),
          ));
        }


      public function findfreelancerAction($page)
  {
    

  
      if($page<1)
      {
        throw new NotFoundHttpException("404 page ".$page." notFound ");
      }

    $nbPerPage=10;
    $listeFreelancers= $this->getDoctrine()
      ->getManager()
      ->getRepository('WFUserBundle:Freelancer')
      ->findAll()
      //->getAllfreelancer($page,$nbPerPage)
      ;
      $nbfree=count($listeFreelancers);
      $nbPages = ceil(count($listeFreelancers)/$nbPerPage);
      if($page>$nbPages){
         throw new NotFoundHttpException('Page "'.$page.'" inexistante.');

      }


    return $this->render('WFPlatformBundle:Projet:findfreelancer.html.twig',array(
      
      'listeFreelancers' => $listeFreelancers,
      'nbPages'      => $nbPages,
      'nbfree'       => $nbfree,
      'page'         => $page
      ));

  }
   /**
     * @Route("/platform/freelancer/apply", name="wf_freelancer_apply")
     * @Security("has_role('ROLE_FREELANCER')")
     */

     public function applyAction(Request $request)
    {
      $id = $request->query->get('id');
        $offre = new Offre();
          $form = $this->get('form.factory')->create(new OffreType(), $offre);

          if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();
           

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            return $this->redirect($this->generateUrl('wf_platform_view', array('id' => $offre->getId())));

            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
          }

          return $this->render('WFPlatformBundle:Projet:apply.html.twig', array(
            'form' => $form->createView(),
            'id'       => $id,
            
          ));
       
    }
    /**
     * @Security("has_role('ROLE_CLIENT')")
     */
    public function viewoffreAction($pId)
    {
           /*if($page<1)
            {
              throw $this->createNotFoundExeption("404 page ".$page." notFound ");
            }
            */
          //$nbPerPage=10;
            $leProjet= $this->getDoctrine()
            ->getManager()
            ->getRepository('WFPlatformBundle:Projet')
            ->findOneById($pId);
            //var_dump($leProjet);
          $listeOffres= $this->getDoctrine()
            ->getManager()
            ->getRepository('WFPlatformBundle:Offre')
            //->getOffres($page,$nbPerPage)
            ->getOffresOfProjet($pId)
            ;
           /* $nbPages = ceil(count($listeOffres)/$nbPerPage);
            if($page>$nbPages){
               throw new NotFoundHttpException('Page "'.$page.'" inexistante.');}

*/
               $nboffre=ceil(count($listeOffres));
          return $this->render('WFPlatformBundle:Projet:viewoffre.html.twig',array(
            'leProjet'=>$leProjet,
            'listeOffres'=>$listeOffres,
            'nboffre'=>$nboffre,
            /*'nbPages'     =>$nbPages,
            'page'        =>$page*/
            ));
    }


    public function checkoutAction(Request $request, $pId, $oId)
    {
        $em = $this->getDoctrine()->getManager();
        //$form = $this->createFormBuilder()->getForm();
        //$form = $this->createFormBuilder()->getForm();
        //$form->handleRequest($request);
        //var_dump($_REQUEST['radio-inline']);
        if (isset($_REQUEST['radio-inline'])) {
          $leProjet= $this->getDoctrine()
            ->getManager()
            ->getRepository('WFPlatformBundle:Projet')
            ->findOneById($pId);
          $offre= $this->getDoctrine()
            ->getManager()
            ->getRepository('WFPlatformBundle:Offre')
            ->findOneById($oId);
          $leProjet->setOffre($offre);
          $em->persist($leProjet);
          $em->flush();
          //var_dump($_REQUEST['radio-inline']);
          return $this->redirect($this->generateUrl('wf_platform_view',array('id'=>$pId)));
        }

        return $this->render('WFPlatformBundle:Projet:checkout.html.twig',array(
          'oId' => $oId,
          'pId' => $pId,
          ));
    }
    public function checkoutRecAction()
    {
      return $this->render('WFPlatformBundle:Projet:checkoutRec.html.twig');
    }

}