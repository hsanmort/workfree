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

use WF\PlatformBundle\Form\FormationType;
use WF\PlatformBundle\Form\ExperienceType;

use WF\PlatformBundle\Entity\Formation;
use WF\PlatformBundle\Entity\Experience;




class FreelancerController extends BaseController
{

	/**
	 * @Route("/freelancer/profile/wall", name="freelancer_profile_wall")
	 */
    public function wallAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //var_dump($user);
        return $this->render('WFUserBundle:Freelancer:wall.html.twig', array(
            'user' => $user
        ));
    }



    /**
	 * @Route("/freelancer/profile/edit", name="freelancer_profile_edit")
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
                $url = $this->generateUrl('freelancer_profile_wall');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
            return $response;
        }

        return $this->render('FOSUserBundle:Freelancer:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/freelancer/profile/users", name="freelancer_profile_users")
     */

    public function usersAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //var_dump($user);
        return $this->render('WFUserBundle:Freelancer:users.html.twig', array(
            'user' => $user
        ));
    }
    /**
     * @Route("/freelancer/profile/projects", name="freelancer_profile_projects")
     */

     public function projectsAction()
    {        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        
        $offre = $em->getRepository('WFPlatformBundle:Offre')->findByFreelancer($this->getUser());
        //var_dump($offre);
        return $this->render('WFUserBundle:Freelancer:projects.html.twig', array(
            'user' => $user,
            'offres'=>$offre
        ));
    }


    /**
     * @Route("/register/confirm", name="freelancer_confirm")
     */
    public function confirmAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }


        $form = $this->createFormBuilder()->setMethod('POST')
        ->setAction($this->generateUrl('freelancer_confirm'))
        ->add('adresse', 'text')
        ->add('photo', 'file')
        ->add('cv', 'file')
        ->add('resume', 'textarea')
        ->add('formations', 'collection', array(
            'type' => new FormationType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            ))
        ->add('experiences', 'collection', array(
            'type' => new ExperienceType(),
            'allow_add'    => true,
            'allow_delete' => true,
            'by_reference' => false,
            ))
        ->add('submit', 'submit')
        ->getForm();


        $form->handleRequest($request);

        //var_dump($formGeneral->getData());
        if ($form->isValid()) {
            //var_dump($form->getData());
            $user->setFile($form->getData()['photo']);
            $user->setFileCv($form->getData()['cv']);
            $user->setResume($form->getData()['resume']);
            $user->setAdresse($form->getData()['adresse']);

            foreach ($form->getData()['formations'] as $f) {
                $frm = new Formation();
                $frm = $f;
                $frm->setFreelancer($user);
                $em->persist($frm);
            }
            foreach ($form->getData()['experiences'] as $e) {
                $exp = new Experience();
                $exp = $e;
                $exp->setFreelancer($user);
                $em->persist($exp);
            }
            $user->uploadCv();
            $user->upload();
            $em->persist($user);
            $em->flush();

        }




        return $this->render('WFUserBundle:Freelancer:confirm.html.twig', array(
            'user' => $user,
            'form' => $form->createView()
        ));
    }
   


}

 ?>