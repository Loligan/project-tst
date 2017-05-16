<?php

namespace Meldon\CatalogBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManager;
use Meldon\CatalogBundle\Entity\categoryEntity;
use Meldon\CatalogBundle\Entity\itemEntity;
use Meldon\CatalogBundle\Entity\ParameterItemEntity;
use Meldon\CatalogBundle\MeldonCatalogBundle;
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
     * SHOW ALL
     */
    public function showallbycategoryAction(Request $request,categoryEntity $categoryEntity)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $request->query->all();
        var_dump($query);

// Get by param******************
        $criteria = new Criteria();
        $expr = $criteria::expr();
        $criteria->andWhere($expr->contains("categoryItem",$categoryEntity));
        if(count($query)!=0){
            foreach ($query as $param => $value){
                $criteria->andWhere($expr->contains("params",'"'.$param.'":"'.(string)$value.'"'));
            }
        }

//      -------------  TST =============

//        $valsIds= $em->getRepository('MeldonCatalogBundle:ParameterItemEntity')->findBy(array("name" => "Operation System","isNumber" => false,"stringValue"=>"Android"));

        $em2 = $this->getDoctrine()->getEntityManager();
        $query= $em2->createQuery("select u from MeldonCatalogBundle:ParameterItemEntity  u where u.isNumber=1 and u.numberValue>=1024 order by u.id desc ");
        $valsIds = $query->getResult();
        $ids = array();
        foreach ($valsIds as $valsId){
            array_push($ids,$valsId->getItemEntityId());
        }
//

        $items = $em->getRepository("MeldonCatalogBundle:itemEntity")->findBy(array("id"=>$ids),array("id"=>"DESC"));
        foreach ($items as $item){
            print "ITEM:".$item->getId()." = ".$item->getName()."     ___________";
        }

//        ----------TST END-----------------

        // ******************
//        $itemEntities = $em->getRepository('MeldonCatalogBundle:itemEntity')->findBy(array("categoryItem"=>$categoryEntity));
        $itemEntities = $em->getRepository('MeldonCatalogBundle:itemEntity')->matching($criteria);

//        GET ALL PARAMS
        $em = $this->getDoctrine()->getManager();
        $paramsEntities = $em->getRepository("MeldonCatalogBundle:parameterEntity")->findBy(array("categoryEntity"=>$categoryEntity));
        //

        return $this->render('itementity/showAllItems.html.twig', array(
            'itemEntities' => $itemEntities,
            'paramsEntities' => $paramsEntities
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
            ->getForm();
    }
}
