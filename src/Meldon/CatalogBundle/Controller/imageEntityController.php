<?php

namespace Meldon\CatalogBundle\Controller;

use Meldon\CatalogBundle\Entity\imageEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Imageentity controller.
 *
 */
class imageEntityController extends Controller
{
    /**
     * Lists all imageEntity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imageEntities = $em->getRepository('MeldonCatalogBundle:imageEntity')->findAll();

        return $this->render('imageentity/index.html.twig', array(
            'imageEntities' => $imageEntities,
        ));
    }

    /**
     * Creates a new imageEntity entity.
     *
     */
    public function newAction(Request $request)
    {
        $imageEntity = new Imageentity();
        $form = $this->createForm('Meldon\CatalogBundle\Form\imageEntityType', $imageEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imageEntity);
            $em->flush();

            return $this->redirectToRoute('img_show', array('id' => $imageEntity->getId()));
        }

        return $this->render('imageentity/new.html.twig', array(
            'imageEntity' => $imageEntity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imageEntity entity.
     *
     */
    public function showAction(imageEntity $imageEntity)
    {
        $deleteForm = $this->createDeleteForm($imageEntity);

        return $this->render('imageentity/show.html.twig', array(
            'imageEntity' => $imageEntity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imageEntity entity.
     *
     */
    public function editAction(Request $request, imageEntity $imageEntity)
    {
        $deleteForm = $this->createDeleteForm($imageEntity);
        $editForm = $this->createForm('Meldon\CatalogBundle\Form\imageEntityType', $imageEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('img_edit', array('id' => $imageEntity->getId()));
        }

        return $this->render('imageentity/edit.html.twig', array(
            'imageEntity' => $imageEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imageEntity entity.
     *
     */
    public function deleteAction(Request $request, imageEntity $imageEntity)
    {
        $form = $this->createDeleteForm($imageEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imageEntity);
            $em->flush();
        }

        return $this->redirectToRoute('img_index');
    }

    /**
     * Creates a form to delete a imageEntity entity.
     *
     * @param imageEntity $imageEntity The imageEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(imageEntity $imageEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('img_delete', array('id' => $imageEntity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
