<?php

namespace Meldon\CatalogBundle\Controller;

use Meldon\CatalogBundle\Entity\itemEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Itementity controller.
 *
 */
class itemEntityController extends Controller
{
    /**
     * Lists all itemEntity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $itemEntities = $em->getRepository('MeldonCatalogBundle:itemEntity')->findAll();

        return $this->render('itementity/index.html.twig', array(
            'itemEntities' => $itemEntities,
        ));
    }

    /**
     * Creates a new itemEntity entity.
     *
     */
    public function newAction(Request $request)
    {
        $itemEntity = new Itementity();
        $form = $this->createForm('Meldon\CatalogBundle\Form\itemEntityType', $itemEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($itemEntity);
            $em->flush();

            return $this->redirectToRoute('item_show', array('id' => $itemEntity->getId()));
        }

        return $this->render('itementity/new.html.twig', array(
            'itemEntity' => $itemEntity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a itemEntity entity.
     *
     */
    public function showAction(itemEntity $itemEntity)
    {
        $deleteForm = $this->createDeleteForm($itemEntity);

        return $this->render('itementity/show.html.twig', array(
            'itemEntity' => $itemEntity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing itemEntity entity.
     *
     */
    public function editAction(Request $request, itemEntity $itemEntity)
    {
        $deleteForm = $this->createDeleteForm($itemEntity);
        $editForm = $this->createForm('Meldon\CatalogBundle\Form\itemEntityType', $itemEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('item_edit', array('id' => $itemEntity->getId()));
        }

        return $this->render('itementity/edit.html.twig', array(
            'itemEntity' => $itemEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a itemEntity entity.
     *
     */
    public function deleteAction(Request $request, itemEntity $itemEntity)
    {
        $form = $this->createDeleteForm($itemEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($itemEntity);
            $em->flush();
        }

        return $this->redirectToRoute('item_index');
    }

    /**
     * Creates a form to delete a itemEntity entity.
     *
     * @param itemEntity $itemEntity The itemEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(itemEntity $itemEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('item_delete', array('id' => $itemEntity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
