<?php

namespace WF\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WF\PlatformBundle\Entity\Test;
use WF\PlatformBundle\Form\TestType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use FOS\UserBundle\Model\UserInterface;
use WF\PlatformBundle\Entity\TestFreelancer;

/**
 * Test controller.
 *
 */
class TestController extends Controller
{

    /**
     * Lists all Test entities.
     *
     * @Route("recruteur/tests/last", name="testsLast")
     * @Method("GET")
     * @Template()
     */
    public function lastAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('WFPlatformBundle:Test')->findAll();
        $entities = $em->getRepository('WFPlatformBundle:Test')->findByRecruteur($this->getUser());
        
        return array(
            'entities' => $entities,
        );
    }


    /**
     * @Route("recruteur/tests/", name="tests_recruteur")
     * @Method("GET")
     */
    public function testsRecruteurAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //var_dump($user);
        $em = $this->getDoctrine()->getManager();

        $allTests = $em->getRepository('WFPlatformBundle:Test')->findByRecruteur($this->getUser());

        return $this->render('WFPlatformBundle:Test:all_tests_recruteur.html.twig', array(
            'user' => $user,
            'allTests' => $allTests
        ));   
    }


    /**
     * @Route("/freelancer/tests/find", name="freelancer_find_tests")
     * @Template()
     */
    public function freelancerFindTestsAction()
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();

        $tests = $em->getRepository('WFPlatformBundle:Test')->findAllValid();


        return $this->render('WFPlatformBundle:Test:freelancer_find_tests.html.twig', array(
            'user' => $user,
            'tests' => $tests
        ));
    }

    /**
     * @Route("/freelancer/tests/take/{id}", name="freelancer_take_test")
     * @Template()
     */
    public function freelancerTakeTestAction(Request $request, $id)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();

        $test = $em->getRepository('WFPlatformBundle:Test')->findOneById($id);


        return $this->render('WFPlatformBundle:Test:freelancer_take_test.html.twig', array(
            'user' => $user,
            'test' => $test
        ));
    }

    /**
     * @Route("/freelancer/tests/validate/{id}", name="freelancer_validate_test")
     * @Template()
     */
    public function freelancerValidateTestAction(Request $request, $id)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('WFPlatformBundle:Test')->findOneById($id);

        $resultats = array();
        $vrai = 0;
        $faux = 0;
        $count = 0;
        try {
            $count = $_REQUEST['count'];
        } catch (Exception $e) {
            
        }
        foreach ($test->getQuestions() as $qst) {
            $correct = null;
            $prop = null;
            if (isset($_REQUEST[$qst->getId()])) {
                $prop = $_REQUEST[$qst->getId()];
                //var_dump($_REQUEST[$qst->getId()]);
                if ($qst->getReponseQues() == $prop) {
                    $resultats[] = "Vrai";
                    $vrai++;
                }else {
                    $resultats[] = "Faux";
                    $faux++;
                }
            }else {
                $resultats[] = "Faux";
            }
            
        }

        $pass = new TestFreelancer();
        $pass->setFreelancer($user);
        $pass->setTest($test);
        $pass->setTime($count);
        if (empty($resultats)) {
            $pass->setNote(0);
        }else{
            $pass->setNote($vrai/count($resultats)*100);
        }
        if ($count == 0) {
            $pass->setNote(0);
        }
        
        //var_dump($pass);
        try {
            $em->persist($pass);
            $em->flush();
            
        } catch (Exception $e) {
            //var_dump($pass);
        }


        return $this->render('WFPlatformBundle:Test:freelancer_result_test.html.twig', array(
            'user' => $user,
            'resultats' => $resultats,
            'test' => $test,
            'pass' => $pass
        ));
    }


    /**
     * @Route("freelancer/tests/", name="tests_freelancer")
     * @Method("GET")
     */
    public function testsFreelancerAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //var_dump($user);
        $em = $this->getDoctrine()->getManager();

        $allTests = $em->getRepository('WFPlatformBundle:TestFreelancer')->findByFreelancer($this->getUser());

        return $this->render('WFPlatformBundle:Test:all_tests_freelancer.html.twig', array(
            'user' => $user,
            'allTests' => $allTests
        ));   
    }






    /*************************************************/

    /**
     * Lists all Test entities.
     *
     * @Route("recruteur/tests/index", name="tests")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$entities = $em->getRepository('WFPlatformBundle:Test')->findAll();
        $entities = $em->getRepository('WFPlatformBundle:Test')->findByRecruteur($this->getUser());

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Test entity.
     *
     * @Route("recruteur/tests/", name="tests_create")
     * @Method("POST")
     * @Template("WFPlatformBundle:Test:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Test();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setRecruteur($this->getUser());
            //var_dump($entity);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tests_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Test entity.
     *
     * @param Test $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Test $entity)
    {
        $form = $this->createForm(new TestType(), $entity, array(
            'action' => $this->generateUrl('tests_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create Test'));

        return $form;
    }

    /**
     * Displays a form to create a new Test entity.
     *
     * @Route("recruteur/tests/new", name="tests_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Test();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Test entity.
     *
     * @Route("recruteur/tests/{id}", name="tests_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WFPlatformBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Test entity.
     *
     * @Route("recruteur/tests/{id}/edit", name="tests_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WFPlatformBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }


        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Test entity.
    *
    * @param Test $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Test $entity)
    {
        $form = $this->createForm(new TestType(), $entity, array(
            'action' => $this->generateUrl('tests_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Test entity.
     *
     * @Route("recruteur/tests/{id}", name="tests_update")
     * @Method("PUT")
     * @Template("WFPlatformBundle:Test:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WFPlatformBundle:Test')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Test entity.');
        }

        $questions = new ArrayCollection();
        foreach ($entity->getQuestions() as $qst) {
            $questions->add($qst);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tests_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Test entity.
     *
     * @Route("recruteur/tests/{id}", name="tests_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WFPlatformBundle:Test')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Test entity.');
            }

            $entity->setRecruteur(null);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tests_recruteur'));
    }

    /**
     * Creates a form to delete a Test entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tests_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'Delete', 'attr' => array(
                    'class'=> 'btn-u'
            )))
            ->getForm()
        ;
    }
}
