<?php


namespace WF\UserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Controller\ProfileController as BaseController;


/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends BaseController
{
    /**
     * Show the user
     */
    /*public function showAction()
    {
        $response = new RedirectResponse($this->generateUrl('fos_user_security_login'));
        if ($this->isGranted('ROLE_CLIENT')) {
            $response = $this->forward('WFUserBundle:Client:show', array( "request" => $request ));
        }elseif ($this->isGranted('ROLE_FREELANCER')) {
            $response = $this->forward('WFUserBundle:Freelancer:show', array( "request" => $request ));
        }elseif ($this->isGranted('ROLE_RECRUTEUR')) {
            $response = $this->forward('WFUserBundle:Recruteur:show', array( "request" => $request ));
        }elseif ($this->isGranted('ROLE_ADMIN')) {
            $response = $this->forward('WFUserBundle:Admin:show', array( "request" => $request ));
        }

        return $response;
    }
*/
    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $response = new RedirectResponse($this->generateUrl('fos_user_security_login'));
        if ($this->isGranted('ROLE_CLIENT')) {
            $response = $this->forward('WFUserBundle:Client:edit', array( "request" => $request ));
        }elseif ($this->isGranted('ROLE_FREELANCER')) {
            $response = $this->forward('WFUserBundle:Freelancer:edit', array( "request" => $request ));
        }elseif ($this->isGranted('ROLE_RECRUTEUR')) {
            $response = $this->forward('WFUserBundle:Recruteur:edit', array( "request" => $request ));
        }elseif ($this->isGranted('ROLE_ADMIN')) {
            $response = $this->forward('WFUserBundle:Admin:edit', array( "request" => $request ));
        }

        return $response;
    }
    
    public function wallAction()
    {
        $response = new RedirectResponse($this->generateUrl('fos_user_security_login'));
        if ($this->isGranted('ROLE_CLIENT')) {
            $response = $this->forward('WFUserBundle:Client:wall');
        }elseif ($this->isGranted('ROLE_FREELANCER')) {
            $response = $this->forward('WFUserBundle:Freelancer:wall');
        }elseif ($this->isGranted('ROLE_RECRUTEUR')) {
            $response = $this->forward('WFUserBundle:Recruteur:wall');
        }elseif ($this->isGranted('ROLE_ADMIN')) {
            $response = $this->forward('WFUserBundle:Admin:wall');
        }

        return $response;
    }
    /* public function usersAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //var_dump($user);
        return $this->render('WFUserBundle:Profile:users.html.twig', array(
            'user' => $user
        ));
    }*/
    public function usersAction()
    {
        $response = new RedirectResponse($this->generateUrl('fos_user_security_login'));
        if ($this->isGranted('ROLE_CLIENT')) {
            $response = $this->forward('WFUserBundle:Client:users');
        }elseif ($this->isGranted('ROLE_FREELANCER')) {
            $response = $this->forward('WFUserBundle:Freelancer:users');
        }elseif ($this->isGranted('ROLE_RECRUTEUR')) {
            $response = $this->forward('WFUserBundle:Recruteur:users');
        }elseif ($this->isGranted('ROLE_ADMIN')) {
            $response = $this->forward('WFUserBundle:Admin:users');
        }

        return $response;
    }

    /*public function projectsAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //var_dump($user);
        return $this->render('WFUserBundle:Profile:projects.html.twig', array(
            'user' => $user
        ));
    }*/
    public function projectsAction()
    {
        $response = new RedirectResponse($this->generateUrl('fos_user_security_login'));
        if ($this->isGranted('ROLE_CLIENT')) {
            $response = $this->forward('WFUserBundle:Client:projects');
        }elseif ($this->isGranted('ROLE_FREELANCER')) {
            $response = $this->forward('WFUserBundle:Freelancer:projects');
        }elseif ($this->isGranted('ROLE_RECRUTEUR')) {
            $response = $this->forward('WFUserBundle:Recruteur:projects');
        }elseif ($this->isGranted('ROLE_ADMIN')) {
            $response = $this->forward('WFUserBundle:Admin:projects');
        }

        return $response;
    }
    
}
