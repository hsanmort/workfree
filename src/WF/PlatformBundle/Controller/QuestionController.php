<?php

namespace WF\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WF\PlatformBundle\Entity\Question;
use WF\PlatformBundle\Form\QuestionType;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Question controller.
 *
 * @Route("/recruteur/tests/{idTest}/questions")
 */
class QuestionController extends Controller
{

    /**
     * Lists all Question entities.
     *
     * @Route("/", name="questions")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($idTest)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('WFPlatformBundle:Question')->findByTest($idTest);

        return array(
            'idTest' => $idTest,
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Question entity.
     *
     * @Route("/", name="questions_create")
     * @Method("POST")
     * @Template("WFPlatformBundle:Question:new.html.twig")
     */
    public function createAction(Request $request, $idTest)
    {
        $entity = new Question();
        $form = $this->createCreateForm($entity, $idTest);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('WFPlatformBundle:Test')->findOneById($idTest);

        $nbrQsts = $em->getRepository('WFPlatformBundle:Question')->findByTest($idTest);
        //var_dump(sizeof($nbrQsts));
        $propositions = new ArrayCollection();
        foreach ($entity->getPropositions() as $prop) {
            $propositions->add($prop);
        }

        //var_dump($form);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $reponse = 1;
            if (isset($_REQUEST['reponse_props'])) {
                $reponse = $_REQUEST['reponse_props'];
            }
            if ($reponse) {
                //$entity->setReponseQues($reponse);
            }
            foreach ($propositions as $i => $prop) {
                $prop->setNumeroPropo($i+1);
                //var_dump($prop);
                if ($i == $reponse-1) {
                    $entity->setReponseQues($prop->getNumeroPropo());
                }
            }

            $entity->setTest($test);
            if (!$nbrQsts) {
                $entity->setNumeroQues(1);
            }else{
                $entity->setNumeroQues(sizeof($nbrQsts)+1);
            }

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tests_show', array(
                'id' => $idTest,
                )));
        }

        return array(
            'idTest' => $idTest,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Question entity.
     *
     * @param Question $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Question $entity, $idTest)
    {
        $form = $this->createForm(new QuestionType(), $entity, array(
            'action' => $this->generateUrl('questions_create', array(
                'idTest' => $idTest
                )),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Question entity.
     *
     * @Route("/new", name="questions_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($idTest)
    {
        $entity = new Question();
        $form   = $this->createCreateForm($entity, $idTest);

        return array(
            'idTest' => $idTest,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Question entity.
     *
     * @Route("/{id}", name="questions_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($idTest, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WFPlatformBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $deleteForm = $this->createDeleteForm($idTest, $id);

        return array(
            'idTest' => $idTest,
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Question entity.
     *
     * @Route("/{id}/edit", name="questions_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($idTest, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WFPlatformBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $editForm = $this->createEditForm($entity, $idTest);
        $deleteForm = $this->createDeleteForm($idTest, $id);

        return array(
            'idTest' => $idTest,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Question entity.
    *
    * @param Question $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Question $entity, $idTest)
    {
        $form = $this->createForm(new QuestionType(), $entity, array(
            'action' => $this->generateUrl('questions_update', array(
                'idTest' => $idTest,
                'id' => $entity->getId()
                )),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Question entity.
     *
     * @Route("/{id}", name="questions_update")
     * @Method("PUT")
     * @Template("WFPlatformBundle:Question:edit.html.twig")
     */
    public function updateAction(Request $request, $idTest, $id)
    {
        $reponse = 1;
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('WFPlatformBundle:Question')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Question entity.');
        }

        $deleteForm = $this->createDeleteForm($idTest, $id);
        $editForm = $this->createEditForm($entity, $idTest);
        
        
        $propositions = new ArrayCollection();
        foreach ($entity->getPropositions() as $prop) {
            $propositions->add($prop);
        }
        $editForm->handleRequest($request);
        //return var_dump($request->request->all()['wf_platformbundle_question']);
        
        if ($editForm->isValid()) {
            if (isset($_REQUEST['reponse_props'])) {
                $reponse = $_REQUEST['reponse_props'];
            }
            if ($reponse) {
                //$entity->setReponseQues($reponse);
            }
            $deleted = 0;
            //var_dump($editForm->getData());
            foreach ($propositions as $i => $prop) {
                $prop->setNumeroPropo($i+1-$deleted);
                //var_dump($prop->getDescriptionPropo());
                if (false === $entity->getPropositions()->contains($prop)) {
                    // remove the test from the Tag
                    //$prop->getTests()->removeElement($test);
                    // if it was a many-to-one relationship, remove the relationship like this
                    $prop->setQuestion(null);
                    //$em->persist($prop);
                    // if you wanted to delete the Tag entirely, you can also do that
                    $em->remove($prop);
                    $deleted = $deleted +1;
                }
            }
            foreach ($entity->getPropositions() as $i => $prop) {
                $entity->getPropositions()->get($i)->setNumeroPropo($i+1);
                if ($i == $reponse-1) {
                    $entity->setReponseQues($prop->getNumeroPropo());
                }
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tests_show', array(
                'id' => $idTest
                )));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Question entity.
     *
     * @Route("/{id}", name="questions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $idTest, $id)
    {
        $form = $this->createDeleteForm($idTest, $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('WFPlatformBundle:Question')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Question entity.');
            }

            $entity->setTest(null);
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tests_show', array(
                'id' => $idTest
                )));
    }

    /**
     * Creates a form to delete a Question entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($idTest, $id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('questions_delete', array(
                'idTest' => $idTest,
                'id' => $id
                )))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => 'Delete', 'attr' => array(
                    'class'=> 'btn-u'
            )))
            ->getForm()
        ;
    }
}
