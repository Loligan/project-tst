<?php

namespace Meldon\CatalogBundle\Controller;

use Meldon\CatalogBundle\Entity\parameterEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Parameterentity controller.
 *
 */
class parameterEntityController extends Controller
{
    /**
     * Lists all parameterEntity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parameterEntities = $em->getRepository('MeldonCatalogBundle:parameterEntity')->findAll();

        return $this->render('parameterentity/index.html.twig', array(
            'parameterEntities' => $parameterEntities,
        ));
    }

    /**
     * Creates a new parameterEntity entity.
     *
     */
    public function newAction(Request $request)
    {
        $parameterEntity = new Parameterentity();
        $form = $this->createForm('Meldon\CatalogBundle\Form\parameterEntityType', $parameterEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parameterEntity);
            $em->flush();

            return $this->redirectToRoute('param_show', array('id' => $parameterEntity->getId()));
        }

        return $this->render('parameterentity/new.html.twig', array(
            'parameterEntity' => $parameterEntity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a parameterEntity entity.
     *
     */
    public function showAction(parameterEntity $parameterEntity)
    {
        $deleteForm = $this->createDeleteForm($parameterEntity);

        return $this->render('parameterentity/show.html.twig', array(
            'parameterEntity' => $parameterEntity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing parameterEntity entity.
     *
     */
    public function editAction(Request $request, parameterEntity $parameterEntity)
    {
        $deleteForm = $this->createDeleteForm($parameterEntity);
        $editForm = $this->createForm('Meldon\CatalogBundle\Form\parameterEntityType', $parameterEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('param_edit', array('id' => $parameterEntity->getId()));
        }

        return $this->render('parameterentity/edit.html.twig', array(
            'parameterEntity' => $parameterEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a parameterEntity entity.
     *
     */
    public function deleteAction(Request $request, parameterEntity $parameterEntity)
    {
        $form = $this->createDeleteForm($parameterEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parameterEntity);
            $em->flush();
        }

        return $this->redirectToRoute('param_index');
    }

    /**
     * Creates a form to delete a parameterEntity entity.
     *
     * @param parameterEntity $parameterEntity The parameterEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(parameterEntity $parameterEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('param_delete', array('id' => $parameterEntity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
