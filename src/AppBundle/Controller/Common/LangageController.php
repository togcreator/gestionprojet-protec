<?php

namespace AppBundle\Controller\Common;

use AppBundle\Entity\Common\Langage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Langage controller.
 *
 * @Route("langage")
 */
class LangageController extends Controller
{
    /**
     * Lists all langage entities.
     *
     * @Route("/", name="langage_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        // getting the language data
        $language = $request->get('lang');

        if($language != null)
        {
            // On enregistre la langue en session
            $this->get('session')->set('_locale', $language);
        }
     
        // on tente de rediriger vers la page d'origine
        $url = $request->headers->get('referer');
        if(empty($url))
        {
            $url = $this->get('router')->generate('homepage');
        }
     
        return $this->redirect($url);
    }

    /**
     * Creates a new langage entity.
     *
     * @Route("/new", name="langage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $langage = new Langage();
        $form = $this->createForm('AppBundle\Form\Common\LangageType', $langage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($langage);
            $em->flush();

            return $this->redirectToRoute('langage_index');
        }

        return $this->render('common/langage/new.html.twig', array(
            'langage' => $langage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a langage entity.
     *
     * @Route("/{id}", name="langage_show")
     * @Method("GET")
     */
    public function showAction(Langage $langage)
    {
        $deleteForm = $this->createDeleteForm($langage);

        return $this->render('common/langage/show.html.twig', array(
            'langage' => $langage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing langage entity.
     *
     * @Route("/{id}/edit", name="langage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Langage $langage)
    {
        $deleteForm = $this->createDeleteForm($langage);
        $editForm = $this->createForm('AppBundle\Form\Common\LangageType', $langage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('langage_edit', array('id' => $langage->getId()));
        }

        return $this->render('common/langage/edit.html.twig', array(
            'langage' => $langage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a langage entity.
     *
     * @Route("/{id}", name="langage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Langage $langage)
    {
        $form = $this->createDeleteForm($langage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($langage);
            $em->flush();
        }

        return $this->redirectToRoute('langage_index');
    }

    /**
     * Creates a form to delete a langage entity.
     *
     * @param Langage $langage The langage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Langage $langage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('langage_delete', array('id' => $langage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
