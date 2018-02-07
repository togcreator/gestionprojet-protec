<?php

namespace UsersBundle\Controller\Back;

use UsersBundle\Entity\Back\ParamServices;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Paramservice controller.
 *
 * @Route("paramservices")
 */
class ParamServicesController extends Controller
{
    /**
     * Lists all paramService entities.
     *
     * @Route("/", name="paramservices_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paramServices = $em->getRepository('UsersBundle:Back\ParamServices')->findAll();

        return $this->render('UsersBundle:back/paramservices:index.html.twig', array(
            'paramServices' => $paramServices,
        ));
    }

    /**
     * Creates a new paramService entity.
     *
     * @Route("/new", name="paramservices_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $paramService = new ParamServices();
        $form = $this->createForm('UsersBundle\Form\Back\ParamServicesType', $paramService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* code */
            \AppBundle\Entity\Classes\Utils::setCode($paramService);
            /* image */
            $this->setImage($paramService);

            $em = $this->getDoctrine()->getManager();
            $em->persist($paramService);
            $em->flush();

            return $this->redirectToRoute('paramservices_index');
        }

        return $this->render('UsersBundle:back/paramservices:new.html.twig', array(
            'paramService' => $paramService,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paramService entity.
     *
     * @Route("/{id}", name="paramservices_show")
     * @Method("GET")
     */
    public function showAction(ParamServices $paramService)
    {
        $deleteForm = $this->createDeleteForm($paramService);

        return $this->render('UsersBundle:back/paramservices:show.html.twig', array(
            'paramService' => $paramService,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paramService entity.
     *
     * @Route("/{id}/edit", name="paramservices_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ParamServices $paramService)
    {
        $deleteForm = $this->createDeleteForm($paramService);
        $editForm = $this->createForm('UsersBundle\Form\Back\ParamServicesType', $paramService);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            /* image */
            $this->setImage($paramService);

            $em = $this->getDoctrine()->getManager();
            $em->persist($paramService);
            $em->flush();

            return $this->redirectToRoute('paramservices_edit', array('id' => $paramService->getId()));
        }

        return $this->render('UsersBundle:back/paramservices:edit.html.twig', array(
            'filetype' => 'image',
            'paramService' => $paramService,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paramService entity.
     *
     * @Route("/{id}", name="paramservices_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ParamServices $paramService)
    {
        $form = $this->createDeleteForm($paramService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paramService);
            $em->flush();
        }

        return $this->redirectToRoute('paramservices_index');
    }

    /**
     * Creates a form to delete a paramService entity.
     *
     * @param ParamServices $paramService The paramService entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ParamServices $paramService)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paramservices_delete', array('id' => $paramService->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * pour image
     */
    private function setImage ($paramservices)
    {
        $img = \AppBundle\Entity\Classes\Utils::Upload_file($paramservices->getImg(), $this->getParameter('upload_dir'));
        if( $img )
            $paramservices->setImg($img);
    }
}
