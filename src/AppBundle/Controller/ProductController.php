<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Products;
use AppBundle\Form\ProductsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller {

    /**
     * @Route("product/create", name="create_product")
     */
    public function createAction(Request $request) {
        $product = new Products();

        $form = $this->createForm(ProductsType::class, $product);
        $form->add('save', SubmitType::class, array('label' => 'Save', 'validation_groups' => ['create']));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em   = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('list_product');
        }

        return $this->render('@AppBundle/Product/create.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    /**
     * @Route("product/list", name="list_product")
     */
    public function listAction(Request $request) {
        $tag_filter = '';
        $form       = $this->createFormBuilder()
                ->add('tag_filter', TextType::class, array('required' => false,))
                ->add('search', SubmitType::class, array('label' => 'Search'))
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tag_filter = $form->get('tag_filter')->getData();
        }

        $repository = $this->getDoctrine()->getRepository('AppBundle:Products');
//        $products   = $repository->createQueryBuilder('p')
//                        ->innerJoin('p.tags', 't')
//                        ->where('t.tag like :tag')
//                        ->setParameter('tag', '%' . $tag_filter . '%')
//                        ->getQuery()->getResult();

        $products = $repository->getProductsByTag($tag_filter);

        return $this->render('@AppBundle/Product/list.html.twig', array(
                    'products' => $products,
                    'form'     => $form->createView(),
        ));
    }

    /**
     * @Route("product/{id}/edit", name="edit_product")
     */
    public function editAction(Request $request, $id) {
        $em      = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Products')->find($id);
        if (!$product) {
            return $this->redirectToRoute('list_product');
        }

        $form = $this->createForm(ProductsType::class, $product);
        $form->add('edit', SubmitType::class, array('label' => 'Edit'));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em   = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('list_product');
        }
        return $this->render('@AppBundle/Product/edit.html.twig', array(
                    'form'    => $form->createView(),
                    'product' => $product,
        ));
    }

}
