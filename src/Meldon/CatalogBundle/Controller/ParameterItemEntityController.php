<?php

namespace Meldon\CatalogBundle\Controller;

use Meldon\CatalogBundle\Entity\ParameterItemEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Parameteritementity controller.
 *
 */
class ParameterItemEntityController extends Controller
{
    /**
     * Lists all parameterItemEntity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parameterItemEntities = $em->getRepository('MeldonCatalogBundle:ParameterItemEntity')->findAll();

        return $this->render('parameteritementity/index.html.twig', array(
            'parameterItemEntities' => $parameterItemEntities,
        ));
    }

    /**
     * Creates a new parameterItemEntity entity.
     *
     */
    public function newAction(Request $request)
    {
        $parameterItemEntity = new Parameteritementity();
        $form = $this->createForm('Meldon\CatalogBundle\Form\ParameterItemEntityType', $parameterItemEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parameterItemEntity);
            $em->flush();

            return $this->redirectToRoute('par_item_show', array('id' => $parameterItemEntity->getId()));
        }

        return $this->render('parameteritementity/new.html.twig', array(
            'parameterItemEntity' => $parameterItemEntity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a parameterItemEntity entity.
     *
     */
    public function showAction(ParameterItemEntity $parameterItemEntity)
    {
        $deleteForm = $this->createDeleteForm($parameterItemEntity);

        return $this->render('parameteritementity/show.html.twig', array(
            'parameterItemEntity' => $parameterItemEntity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing parameterItemEntity entity.
     *
     */
    public function editAction(Request $request, ParameterItemEntity $parameterItemEntity)
    {
        $deleteForm = $this->createDeleteForm($parameterItemEntity);
        $editForm = $this->createForm('Meldon\CatalogBundle\Form\ParameterItemEntityType', $parameterItemEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('par_item_edit', array('id' => $parameterItemEntity->getId()));
        }

        return $this->render('parameteritementity/edit.html.twig', array(
            'parameterItemEntity' => $parameterItemEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a parameterItemEntity entity.
     *
     */
    public function deleteAction(Request $request, ParameterItemEntity $parameterItemEntity)
    {
        $form = $this->createDeleteForm($parameterItemEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parameterItemEntity);
            $em->flush();
        }

        return $this->redirectToRoute('par_item_index');
    }

    /**
     * Creates a form to delete a parameterItemEntity entity.
     *
     * @param ParameterItemEntity $parameterItemEntity The parameterItemEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ParameterItemEntity $parameterItemEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('par_item_delete', array('id' => $parameterItemEntity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
