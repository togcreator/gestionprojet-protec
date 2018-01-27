<?php

namespace ProjectBundle\Controller\Back;

use ProjectBundle\Entity\Back\Param;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * Param controller.
 *
 * @Route("backoffice")
 */
class ParamController extends Controller
{
    /**
     * Lists all param entities.
     *
     * @Route("/", name="back_param_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // for language
        $langages = $em->getRepository('AppBundle:Common\Langage')->findAll();
        // for param
        $params = $em->getRepository('ProjectBundle:Back\Param')->findAll();

        // setter the cookie
        $param = $em->getRepository('ProjectBundle:Back\Param')->findBy(['label' => 'cookie_lifetime']);
        $response = new Response();
        $response->headers->setCookie(new Cookie('cookie_lifetime', count($param)?$param[0]->getValue():3600));
        $response->send();

        return $this->render('ProjectBundle:back\param:index.html.twig', array(
            'params' => $params,
            'langages' => $langages,
        ));
    }

    /**
     * Creates a new param entity.
     *
     * @Route("/new", name="back_param_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $param = new Param();
        $form = $this->createForm('ProjectBundle\Form\Back\ParamType', $param);
        $form->handleRequest($request);

        $param->setDate(new \DateTime('now'));

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($param);
            $em->flush();

            return $this->redirectToRoute('back_param_index');
        }

        return $this->render('ProjectBundle:back\param:new.html.twig', array(
            'param' => $param,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a param entity.
     *
     * @Route("/{id}", name="back_param_show")
     * @Method("GET")
     */
    public function showAction(Param $param)
    {
        $deleteForm = $this->createDeleteForm($param);

        return $this->render('ProjectBundle:back\param/show.html.twig', array(
            'param' => $param,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing param entity.
     *
     * @Route("/{id}/edit", name="back_param_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Param $param)
    {
        $deleteForm = $this->createDeleteForm($param);
        $editForm = $this->createForm('ProjectBundle\Form\Back\ParamType', $param);
        $editForm->handleRequest($request);

        // $id = $param->getid()

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('back_param_index');
        }

        return $this->render('ProjectBundle:back\param:edit.html.twig', array(
            'param' => $param,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a param entity.
     *
     * @Route("/{id}", name="back_param_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Param $param)
    {
        $form = $this->createDeleteForm($param);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($param);
            $em->flush();
        }

        return $this->redirectToRoute('back_param_index');
    }

    /**
     * Creates a form to delete a param entity.
     *
     * @param Param $param The param entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Param $param)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('back_param_delete', array('id' => $param->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
