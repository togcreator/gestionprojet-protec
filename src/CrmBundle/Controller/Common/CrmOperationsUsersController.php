<?php

namespace CrmBundle\Controller\Common;

use CrmBundle\Entity\Common\CrmOperationsUsers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Crmoperationsuser controller.
 *
 * @Route("crm/operationsusers")
 */
class CrmOperationsUsersController extends Controller
{
    /**
     * Override method getUser parent
     *
     * @return UserClient
     */
    protected function getUser() {

        $auth_checker = $this->get('security.authorization_checker');
        if( $auth_checker->isGranted('ROLE_ADMIN') ) 
            return true;
        return $this->getDoctrine()->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $this->container->get('session')->get('log')]);
    }

    /**
     * Lists all crmOperationsUser entities.
     *
     * @Route("/", name="crmoperationsusers_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user_id = is_object($this->getUser()) ? $this->getUser()->getId() : null;
        $bu_id = $this->container->get('session')->get('BU');

        $crmOperationsUsers = $em->getRepository('CrmBundle:Common\CrmOperationsUsers')->findAllBy($user_id, $bu_id);
        if( $crmOperationsUsers )
            foreach( $crmOperationsUsers as &$operationuser ) {
                $crm = $em->getRepository('CrmBundle:Common\CrmDossier')->findOneBy(['id' => $operationuser->getIdCRM()]);
                $operationuser->setCrm($crm);
                $operationuser->setOperation($em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findOneBy(['id' => $operationuser->getIdoperation()]));
                $operationuser->setCycle($em->getRepository('CrmBundle:Back\CrmParamCycles')->findOneBy(['id' => $crm->getIdCycle()]));
            }

        return $this->render('CrmBundle:common/crmoperationsusers:index.html.twig', array(
            'crmOperationsUsers' => $crmOperationsUsers,
            ));
    }

    /**
     * Creates a new crmOperationsUser entity.
     *
     * @Route("/new", name="crmoperationsusers_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmOperationsUser = new CrmOperationsUsers();
        $form = $this->createForm('CrmBundle\Form\Common\CrmOperationsUsersType', $crmOperationsUser, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // for user
            $this->setUser($crmOperationsUser);

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmOperationsUser);
            $em->flush();

            return $this->redirectToRoute('crmoperationsusers_index');
        }

        return $this->render('CrmBundle:common/crmoperationsusers:new.html.twig', array(
            'crmOperationsUser' => $crmOperationsUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmOperationsUser entity.
     *
     * @Route("/{id}", name="crmoperationsusers_show")
     * @Method("GET")
     */
    public function showAction(CrmOperationsUsers $crmOperationsUser)
    {
        $deleteForm = $this->createDeleteForm($crmOperationsUser);

        return $this->render('CrmBundle:common/crmoperationsusers:show.html.twig', array(
            'crmOperationsUser' => $crmOperationsUser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmOperationsUser entity.
     *
     * @Route("/{id}/edit", name="crmoperationsusers_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmOperationsUsers $crmOperationsUser)
    {
        $deleteForm = $this->createDeleteForm($crmOperationsUser);
        $editForm = $this->createForm('CrmBundle\Form\Common\CrmOperationsUsersType', $crmOperationsUser, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crmoperationsusers_edit', array('id' => $crmOperationsUser->getId()));
        }

        return $this->render('CrmBundle:common/crmoperationsusers:edit.html.twig', array(
            'crmOperationsUser' => $crmOperationsUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmOperationsUser entity.
     *
     * @Route("/{id}", name="crmoperationsusers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmOperationsUsers $crmOperationsUser)
    {
        $form = $this->createDeleteForm($crmOperationsUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmOperationsUser);
            $em->flush();
        }

        return $this->redirectToRoute('crmoperationsusers_index');
    }

    /**
     * Creates a form to delete a crmOperationsUser entity.
     *
     * @param CrmOperationsUsers $crmOperationsUser The crmOperationsUser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmOperationsUsers $crmOperationsUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmoperationsusers_delete', array('id' => $crmOperationsUser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'crms' => $em->getRepository('CrmBundle:Common\CrmDossier')->findAll(),
            'etapes' => $em->getRepository('CrmBundle:Common\CrmEtapes')->findAll(),
            'operations' => $em->getRepository('CrmBundle:Common\CrmEtapesOperations')->findAll(),
            'roles_users' => $em->getRepository('ProjectBundle:Back\Roles')->findAll(), // à modifier
        ];
    }

    // for user or user
    private function setUser ($crmOperationsUser)
    {
        $user = $this->getDoctrine()->getManager()->getRepository('UsersBundle:UserClient')->findOneBy(['id'=>$crmOperationsUser->getIdUser()]);
        $crmOperationsUser->setUser($user);
    }

}
