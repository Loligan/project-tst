<?php

namespace Meldon\CatalogBundle\Controller;

use Meldon\CatalogBundle\Entity\categoryEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Categoryentity controller.
 *
 */
class categoryEntityController extends Controller
{
    /**
     * Lists all categoryEntity entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categoryEntities = $em->getRepository('MeldonCatalogBundle:categoryEntity')->findAll();

        return $this->render('categoryentity/index.html.twig', array(
            'categoryEntities' => $categoryEntities,
        ));
    }

    /**
     * Creates a new categoryEntity entity.
     *
     */
    public function newAction(Request $request)
    {
        $categoryEntity = new Categoryentity();
        $form = $this->createForm('Meldon\CatalogBundle\Form\categoryEntityType', $categoryEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categoryEntity);
            $em->flush();

            return $this->redirectToRoute('category_show', array('id' => $categoryEntity->getId()));
        }

        return $this->render('categoryentity/new.html.twig', array(
            'categoryEntity' => $categoryEntity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a categoryEntity entity.
     *
     */
    public function showAction(categoryEntity $categoryEntity)
    {
        $deleteForm = $this->createDeleteForm($categoryEntity);

        return $this->render('categoryentity/show.html.twig', array(
            'categoryEntity' => $categoryEntity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing categoryEntity entity.
     *
     */
    public function editAction(Request $request, categoryEntity $categoryEntity)
    {
        $deleteForm = $this->createDeleteForm($categoryEntity);
        $editForm = $this->createForm('Meldon\CatalogBundle\Form\categoryEntityType', $categoryEntity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_edit', array('id' => $categoryEntity->getId()));
        }

        return $this->render('categoryentity/edit.html.twig', array(
            'categoryEntity' => $categoryEntity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a categoryEntity entity.
     *
     */
    public function deleteAction(Request $request, categoryEntity $categoryEntity)
    {
        $form = $this->createDeleteForm($categoryEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($categoryEntity);
            $em->flush();
        }

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a categoryEntity entity.
     *
     * @param categoryEntity $categoryEntity The categoryEntity entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(categoryEntity $categoryEntity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $categoryEntity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
