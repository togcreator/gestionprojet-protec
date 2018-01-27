<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectVersionUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Projectversionuser controller.
 *
 * @Route("projet/version_user")
 */
class ProjectVersionUserController extends Controller
{
    /**
     * Lists all projectVersionUser entities.
     *
     * @Route("/", name="projectversionuser_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projectVersionUsers = $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findAll();

        return $this->render('ProjectBundle:common\projectversionuser:index.html.twig', array(
            'projectVersionUsers' => $projectVersionUsers,
        ));
    }

    /**
     * Creates a new projectVersionUser entity.
     *
     * @Route("/new", name="projectversionuser_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $projectVersionUser = new ProjectVersionUser();
        $dataForm = $this->dataForm();

        // l'idprojet
        if( ($projet_id = $request->get('idProject')) ) {
            $projectVersionUser->setIdProjetVersion($projet_id);
            // pour user, on enleve si l'user est dejà attribuer
            if( isset($dataForm['users']) )
                foreach( $dataForm['users'] as $key => $user )
                    if( $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findEmploye(['idUser' => $user->getId()]) ) {
                        unset($dataForm['users'][$key]);
                    }
        }

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectVersionUserType', $projectVersionUser, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            

            // date format
            $datedebut = $projectVersionUser->getDatedebut();
            $projectVersionUser->setDatedebut( new \DateTime($datedebut) );
            $datefin = $projectVersionUser->getDatefin();
            $projectVersionUser->setDatefin( new \DateTime($datefin));

            // pour user
            $user = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $projectVersionUser->getIdUser()]);
            $projectVersionUser->setUser($user);

            // flush the data
            $em->persist($projectVersionUser);
            $em->flush();

            // redirect ot project
            if( $request->get('idProjet') )
                return $this->redirectToRoute('project_edit', ['id' => $projectVersionUser->getIdProjetVersion(), '_fragment' => 'user']);

            return $this->redirectToRoute('projectversionuser_index');
        }

        return $this->render('ProjectBundle:common\projectversionuser:new.html.twig', array(
            'projectVersionUser' => $projectVersionUser,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectVersionUser entity.
     *
     * @Route("/{id}", name="projectversionuser_show")
     * @Method("GET")
     */
    public function showAction(ProjectVersionUser $projectVersionUser)
    {
        $deleteForm = $this->createDeleteForm($projectVersionUser);

        return $this->render('ProjectBundle:common\projectversionuser:show.html.twig', array(
            'projectVersionUser' => $projectVersionUser,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectVersionUser entity.
     *
     * @Route("/{id}/edit", name="projectversionuser_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectVersionUser $projectVersionUser)
    {
        $deleteForm = $this->createDeleteForm($projectVersionUser);
        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectVersionUserType', $projectVersionUser, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            // date format
            $datedebut = $projectVersionUser->getDatedebut();
            $projectVersionUser->setDatedebut( new \DateTime($datedebut) );
            $datefin = $projectVersionUser->getDatefin();
            $projectVersionUser->setDatefin( new \DateTime($datefin) );

            $this->getDoctrine()->getManager()->flush();

            // redirect ot project
            if( $request->get('idProjet') )
                return $this->redirectToRoute('project_edit', ['id' => $projectVersionUser->getIdProjetVersion(), '_fragment' => 'user']);

            return $this->redirectToRoute('projectversionuser_edit', array('id' => $projectVersionUser->getId()));
        }

        return $this->render('ProjectBundle:common\projectversionuser:edit.html.twig', array(
            'projectVersionUser' => $projectVersionUser,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectVersionUser entity.
     *
     * @Route("/{id}", name="projectversionuser_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectVersionUser $projectVersionUser)
    {
        $form = $this->createDeleteForm($projectVersionUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectVersionUser);
            $em->flush();
        }

        return $this->redirectToRoute('projectversionuser_index');
    }

    /**
     * Creates a form to delete a projectVersionUser entity.
     *
     * @param ProjectVersionUser $projectVersionUser The projectVersionUser entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectVersionUser $projectVersionUser)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectversionuser_delete', array('id' => $projectVersionUser->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // data for form
    private function dataForm() {
        $em = $this->getDoctrine()->getManager();
        return [
            'projects'  => $em->getRepository('ProjectBundle:Common\Project')->findAll(),
            'roles'  => $em->getRepository('ProjectBundle:Back\Roles')->findAll(),
            'users'  => $em->getRepository('UsersBundle:UserClient')->findAll()
        ];
    }
}
