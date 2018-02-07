<?php

namespace UsersBundle\Controller;

use UsersBundle\Entity\UserDocs;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Userdoc controller.
 *
 * @Route("userdocs")
 */
class UserDocsController extends Controller
{
    /**
     * Lists all userDoc entities.
     *
     * @Route("/", name="userdocs_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userDocs = $em->getRepository('UsersBundle:UserDocs')->findAll();

        return $this->render('UsersBundle:userdocs:index.html.twig', array(
            'userDocs' => $userDocs,
        ));
    }

    /**
     * Creates a new userDoc entity.
     *
     * @Route("/new", name="userdocs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userDoc = new UserDocs();

        if( ($user_id = $request->get('idUser')) )
            $userDoc->setIdUser4origine((int)$user_id);

        $form = $this->createForm('UsersBundle\Form\UserDocsType', $userDoc, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userDoc->setDateCreation(new \DateTime('now'));
            // pour code
            \AppBundle\Entity\Classes\Utils::setCode($userDoc);
            // document
            $this->setDocument($userDoc);

            $em = $this->getDoctrine()->getManager();
            $em->persist($userDoc);
            $em->flush();

            if( ($user_id = $request->get('idUser')) )
                return $this->redirectToRoute('user_edit', ['id' => $user_id]);
            return $this->redirectToRoute('userdocs_index');
        }

        return $this->render('UsersBundle:userdocs:new.html.twig', array(
            'userDoc' => $userDoc,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userDoc entity.
     *
     * @Route("/{id}", name="userdocs_show")
     * @Method("GET")
     */
    public function showAction(UserDocs $userDoc)
    {
        $deleteForm = $this->createDeleteForm($userDoc);

        return $this->render('UsersBundle:userdocs:show.html.twig', array(
            'userDoc' => $userDoc,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userDoc entity.
     *
     * @Route("/{id}/edit", name="userdocs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserDocs $userDoc)
    {
        $deleteForm = $this->createDeleteForm($userDoc);
        $editForm = $this->createForm('UsersBundle\Form\UserDocsType', $userDoc, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            // document
            $this->setDocument($userDoc);

            $em = $this->getDoctrine()->getManager();
            $em->persist($userDoc);
            $em->flush();

            if( ($user_id = $request->get('idUser')) )
                return $this->redirectToRoute('user_edit', ['id' => $user_id]);     

            return $this->redirectToRoute('userdocs_edit', array('id' => $userDoc->getId()));
        }

        return $this->render('UsersBundle:userdocs:edit.html.twig', array(
            'userDoc' => $userDoc,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userDoc entity.
     *
     * @Route("/{id}", name="userdocs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserDocs $userDoc)
    {
        $form = $this->createDeleteForm($userDoc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userDoc);
            $em->flush();
        }

        return $this->redirectToRoute('userdocs_index');
    }

    /**
     * Creates a form to delete a userDoc entity.
     *
     * @param UserDocs $userDoc The userDoc entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserDocs $userDoc)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userdocs_delete', array('id' => $userDoc->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // for icone
    private function setDocument ($doc)
    {
        $dir = $this->getParameter('upload_dir') . DIRECTORY_SEPARATOR . 'document';
        if(!is_dir($dir))
            if(!mkdir($dir))
                return;

        $docs = \AppBundle\Entity\Classes\Utils::Upload_file($doc->getNomdoc(), $dir);
        if( $docs )
            $doc->setNomdoc($docs);
    }

    private function dataForm() {
        $em = $this->getDoctrine();
        return [
            'user' => $em->getRepository('UsersBundle:UserClient')->findBy([])
        ];
    }
}
