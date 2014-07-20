<?php

namespace MonSac\DeSportBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use MonSac\DeSportBundle\Entity\Product;
use MonSac\DeSportBundle\Form\ProductType;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{

    /**
     * Lists all Product entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productCategories = $em->getRepository('MonSacDeSportBundle:ProductCategory')->findAll();

        return $this->render('MonSacDeSportBundle:Product:index.html.twig', array(
            'productCategories' => $productCategories,
        ));
    }

    public function indexAdminAction($page)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('MonSacDeSportBundle:Product')->paginationQuery();

        $pagination = $this->pagination($query,$page,1);

        return $this->render('MonSacDeSportBundle:Product:index_admin.html.twig', array(
            'products' => $pagination,
            'pagination' => $pagination
        ));
    }

    public function searchAdminAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $search = strtolower($request->get('s'));

        $query = $em->getRepository('MonSacDeSportBundle:Product')->search($search);

        $pagination = $this->pagination($query, $page, 1);

        return $this->render('MonSacDeSportBundle:Product:index_admin.html.twig', array(
            'products' => $pagination,
            'pagination' => $pagination
        ));
    }

    /**
     * Creates a new Product entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Product();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'Le produit a bien été enregistré');

            return $this->redirect($this->generateUrl('admin_products'));
        }

        return $this->render('MonSacDeSportBundle:Product:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Product entity.
    *
    * @param Product $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Product $entity)
    {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('admin_product_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Product entity.
     *
     */
    public function newAction()
    {
        $entity = new Product();
        $form   = $this->createCreateForm($entity);

        return $this->render('MonSacDeSportBundle:Product:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Product entity.
     *
     */
    public function showAction($productSlug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MonSacDeSportBundle:Product')->findOneBySlug($productSlug);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('MonSacDeSportBundle:Product:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MonSacDeSportBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MonSacDeSportBundle:Product:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Product entity.
    *
    * @param Product $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Product $entity)
    {
        $form = $this->createForm(new ProductType(), $entity, array(
            'action' => $this->generateUrl('admin_product_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Product entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MonSacDeSportBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            foreach($entity->getImages() as $image) {
                $image->setProduct($entity);
                $em->persist($image);
            }

            $em->flush();

            return $this->redirect($this->generateUrl('admin_product_edit', array('id' => $id)));
        }

        return $this->render('MonSacDeSportBundle:Product:edit.html.twig', array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Product entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MonSacDeSportBundle:Product')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Product entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl(''));
    }

    /**
     * Creates a form to delete a Product entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_product_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    public function productByCategoryAction($productCategorySlug)
    {
        $em = $this->getDoctrine()->getManager();

        $productCategory = $em->getRepository('MonSacDeSportBundle:ProductCategory')->findOneBySlug($productCategorySlug);
        $products = $em->getRepository('MonSacDeSportBundle:Product')->findByProductCategory($productCategory->getId());

        return $this->render('MonSacDeSportBundle:Product:productByCategory.html.twig', array(
                'products' => $products,
                'productCategory' => $productCategorySlug
            ));
    }

    /* Paginate function */
    private function pagination($query, $page, $maxLimit)
    {
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page,
            $maxLimit
        );

        return $pagination;
    }
}
