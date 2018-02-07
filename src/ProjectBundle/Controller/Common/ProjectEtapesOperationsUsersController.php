<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectEtapesOperationsUsers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Projectoperationsuser controller.
 *
 * @Route("projet/operationsusers")
 */
class ProjectEtapesOperationsUsersController extends Controller
{
    /**
     * Lists ajax data
     *
     * @Route("/ajax", name="operationsusers_ajax_get")
     * @Method({"GET", "POST"})
     */
    public function ajaxAction(Request $request)
    {
        if(($id = $request->get('id'))) {
            $em = $this->getDoctrine()->getManager();

            /* pour etapes jalons */
            $operations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findOneBy(['idUser' => $id]);
            if( !$operations ) 
                return new Response('');
            /* pour translator */
            $trans = $this->container->get('translator');

            /* pour agenda*/
            ob_start();
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><?php echo $operations->getUser()->getUsername() ?> <?php echo $operations->getUser()->getLastname() ?></h5>
            </div>

            <div class="modal-body">
                <!-- <table class="datatables">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $trans->trans('global.title') ?></th>
                            <th><?php echo $trans->trans('global.description') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($operations as $operation): ?>
                        <tr>
                            <th><?php echo $operation->getId() ?></th>
                            <th><?php echo $operation->getObject() ?></th>
                            <th><?php echo $operation->getDescription() ?></th>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table> -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->container->get('translator')->trans('global.close_button') ?></button>
            <?php
            $html = ob_get_contents();
            ob_end_clean();

            return new Response($html);
       }

    }

    /**
     * Lists all ProjectEtapesOperationsUser entities.
     *
     * @Route("/", name="operationsusers_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ProjectEtapesOperationsUsers = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findAll();


        /* itération pour agenda */
        foreach($ProjectEtapesOperationsUsers as &$operations ) {
            $agenda = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findOneBy(['idProjetOperation' => $operations->getIdOperation()]);
            $operations->setAgenda($agenda);

            /* projet */
            $operations->setProjet($em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $operations->getIdProjetversion()]));
            $operations->setEtape($em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $operations->getIdEtape()]));
        }

        return $this->render('ProjectBundle:common/projectetapesoperationsusers:index.html.twig', array(
            'ProjectEtapesOperationsUsers' => $ProjectEtapesOperationsUsers,
            ));
    }

    /**
     * Creates a new ProjectEtapesOperationsUser entity.
     *
     * @Route("/new", name="operationsusers_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ProjectEtapesOperationsUser = new ProjectEtapesOperationsUsers();
        $dataForm = $this->dataForm();
        $em = $this->getDoctrine()->getManager();
        $idProject = 0;

        /* pour opération */
        if(($idOperation = $request->get('idOperation'))) {
            if(($project = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findOneBy(['id' => $idOperation]))){
                /* pour setter idProjectVersion */
                $ProjectEtapesOperationsUser->setIdOperation($idOperation);

                $project = $em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $project->getIdProjectVersion()]);
                $idProject = $project->getId();
            } else
            /* si id non valide */
                return $this->redirectToRoute('operationsusers_new');

            if( isset($dataForm['users']) )
                foreach( $dataForm['users'] as $key => $user )
                    if( $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findBy(['idUser' => $user->getId()]) ) {
                        unset($dataForm['users'][$key]);
                    }
        }

        /* pour projet */
        if( $idProject || ($idProject = $request->get('idProject')) || ($idProject = $request->get('idProjet')) ) {
            /* pour setter idProjectVersion */
            $ProjectEtapesOperationsUser->setIdProjetversion($idProject);
            /* pour etape zéro */
            $ProjectEtapesOperationsUser->setIdEtape(0);

            /* pour l'étape du projet e question */
            $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $idProject]);
            $dataForm['etapes'] = $etapes;

            /* pour l'étape du projet e question */
            $operations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idProjectVersion' => $idProject]);
            $dataForm['operations'] = $operations;
        }
        /* end of */

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsUsersType', $ProjectEtapesOperationsUser, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // for user
            $this->setUser($ProjectEtapesOperationsUser);

            // pour operation
            $operation = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findOneBy(['id' => $ProjectEtapesOperationsUser->getIdOperation()]);
            $ProjectEtapesOperationsUser->setOperation($operation);
            
            $em->persist($ProjectEtapesOperationsUser);
            $em->flush();

            // redirect vers project
            if( $request->get('idProjet') )
                return $this->redirectToRoute('project_edit', ['id' => $ProjectEtapesOperationsUser->getIdProjetversion(), '_fragment' => 'user']);

            // redirect vers project
            if( $request->get('idOperation') )
                return $this->redirectToRoute('projectetapesoperations_edit', ['id' => $ProjectEtapesOperationsUser->getIdOperation(), '_fragment' => 'users']);

            return $this->redirectToRoute('operationsusers_index');
        }

        return $this->render('ProjectBundle:common/projectetapesoperationsusers:new.html.twig', array(
            'ProjectEtapesOperationsUser' => $ProjectEtapesOperationsUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProjectEtapesOperationsUser entity.
     *
     * @Route("/{id}", name="operationsusers_show")
     * @Method("GET")
     */
    public function showAction(ProjectEtapesOperationsUsers $ProjectEtapesOperationsUser)
    {
        $deleteForm = $this->createDeleteForm($ProjectEtapesOperationsUser);

        return $this->render('ProjectBundle:common/projectetapesoperationsusers:show.html.twig', array(
            'ProjectEtapesOperationsUser' => $ProjectEtapesOperationsUser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProjectEtapesOperationsUser entity.
     *
     * @Route("/{id}/edit", name="operationsusers_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectEtapesOperationsUsers $ProjectEtapesOperationsUser)
    {
        $deleteForm = $this->createDeleteForm($ProjectEtapesOperationsUser);
        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesOperationsUsersType', $ProjectEtapesOperationsUser, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            // redirect vers project
            if( $request->get('idProjet') )
                return $this->redirectToRoute('project_edit', ['id' => $ProjectEtapesOperationsUser->getIdProjetversion(), '_fragment' => 'user']);

            // redirect vers project
            if( $request->get('idOperation') )
                return $this->redirectToRoute('projectetapesoperations_edit', ['id' => $ProjectEtapesOperationsUser->getIdOperation(), '_fragment' => 'user']);

            return $this->redirectToRoute('operationsusers_edit', array('id' => $ProjectEtapesOperationsUser->getId()));
        }

        return $this->render('ProjectBundle:common/projectetapesoperationsusers:edit.html.twig', array(
            'ProjectEtapesOperationsUser' => $ProjectEtapesOperationsUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ProjectEtapesOperationsUser entity.
     *
     * @Route("/{id}", name="operationsusers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectEtapesOperationsUsers $ProjectEtapesOperationsUser)
    {
        $form = $this->createDeleteForm($ProjectEtapesOperationsUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ProjectEtapesOperationsUser);
            $em->flush();
        }

        $referer = $request->headers->get('referer');
        if( preg_match('/edit/', $referer) )
            $referer = $referer . '#docs';

        return $this->redirect($referer);
    }

    /**
     * Creates a form to delete a ProjectEtapesOperationsUser entity.
     *
     * @param ProjectEtapesOperationsUsers $ProjectEtapesOperationsUser The ProjectEtapesOperationsUser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectEtapesOperationsUsers $ProjectEtapesOperationsUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('operationsusers_delete', array('id' => $ProjectEtapesOperationsUser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'projects' => $em->getRepository('ProjectBundle:Common\Project')->findAll(),
            'etapes' => $em->getRepository('ProjectBundle:Common\ProjectEtape')->findAll(),
            'operations' => $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findAll(),
            'roles' => $em->getRepository('ProjectBundle:Back\Roles')->findBy(['ouvert' => 1]), // à modifier
            // 'users' => $em->getRepository('ProjectBundle:Common\ProjectOperationsUser')->findAll(), // à modifier
            'users' => $em->getRepository('UsersBundle:UserClient')->findAll()
        ];
    }

    // for user or user
    private function setUser ($ProjectEtapesOperationsUser)
    {
        $user = $this->getDoctrine()->getManager()->getRepository('UsersBundle:UserClient')->findOneBy(['id'=>$ProjectEtapesOperationsUser->getIdUser()]);
        $ProjectEtapesOperationsUser->setUser($user);
    }
}
