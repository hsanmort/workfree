<?php


namespace WF\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Controller\ProfileController as BaseController;
use WF\PlatformBundle\Entity\Projet;




class ClientController extends BaseController
{




	/**
	 * @Route("/client/profile/wall", name="client_profile_wall")
	 */
    public function wallAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $uId=$user->getId();
       

        $leClient= $this->getDoctrine()
            ->getManager()
            ->getRepository('WFUserBundle:Client')
            ->findOneById($uId);
            //var_dump($leProjet);
          $listeProjet= $this->getDoctrine()
            ->getManager()
            ->getRepository('WFPlatformBundle:Projet')
            ->getProjetOfUser($uId)
            ;
           
          return $this->render('WFUserBundle:Client:profile_wall.html.twig',array(
            'user' => $user,
            'leClient'=>$leClient,
            'listeProjet'=>$listeProjet,
            
           
            ));


    }



    /**
	 * @Route("/client/profile/edit", name="client_profile_edit")
	 */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);
            $user->upload();

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('client_profile_wall');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            return $response;
        }

        return $this->render('FOSUserBundle:Client:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

     /**
     * @Route("/client/profile/users", name="client_profile_users")
     */

    public function usersAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //var_dump($user);
        return $this->render('WFUserBundle:Client:users.html.twig', array(
            'user' => $user
        ));
    }
    /**
     * @Route("/client/profile/projects", name="client_profile_projects")
     */

     public function projectsAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //var_dump($user);
        $uId=$user->getId();
       

        $leClient= $this->getDoctrine()
            ->getManager()
            ->getRepository('WFUserBundle:Client')
            ->findOneById($uId);
            //var_dump($leProjet);
          $listeProjet= $this->getDoctrine()
            ->getManager()
            ->getRepository('WFPlatformBundle:Projet')
            ->getProjetOfUser($uId)
            ;
           
          return $this->render('WFUserBundle:Client:projects.html.twig',array(
            'user' => $user,
            'leClient'=>$leClient,
            'listeProjet'=>$listeProjet,
            
           
            ));
        
    }


}

 ?>