<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectVersion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Projectversion controller.
 *
 * @Route("projet/version")
 */
class ProjectVersionController extends Controller
{
    /**
     * Lists all projectVersion entities.
     *
     * @Route("/", name="projectversion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $projectVersions = $em->getRepository('ProjectBundle:Common\ProjectVersion')->findAll();

        return $this->render('ProjectBundle:common\projectversion:index.html.twig', array(
            'projectversions' => $projectVersions,
        ));
    }

    // for date
    public function setDate($projectVersion) 
    {
        // date debut
        $dd = $projectVersion->getDatedebut();
        $projectVersion->setDatedebut(new \DateTime(str_replace('-','/',$dd)));

        // date debut
        $df = $projectVersion->getDatefin();
        $projectVersion->setDatefin(new \DateTime(str_replace('-','/',$df)));
    }

    /**
     * Creates a new projectVersion entity.
     *
     * @Route("/new", name="projectversion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $projectVersion = new Projectversion();
        $projects = $this->getDoctrine()->getManager()
            ->getRepository('ProjectBundle:Common\Project')
            ->findBy(['idCreateur'=> \UsersBundle\Entity\Users::getCurrentUsers()]);

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectVersionType', $projectVersion, ['projects'=>$projects]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // for project
            foreach($projects as $projet)
                if( $projet->getId() == $projectVersion->getIdProjet() ) {
                    $projects = $projet;
                    break;
                }
            // for projet many to one
            $projectVersion->setProject($projects);

            // projet version
            $projectVersion->setDateCreation(new \Datetime('now'));
            $this->setDate($projectVersion); // for these date

            $em = $this->getDoctrine()->getManager();
            $em->persist($projectVersion);
            $em->flush();

            return $this->redirectToRoute('projectversion_index');
        }

        return $this->render('ProjectBundle:common\projectversion:new.html.twig', array(
            'projectversions' => $projectVersion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectVersion entity.
     *
     * @Route("/{id}", name="projectversion_show")
     * @Method("GET")
     */
    public function showAction(ProjectVersion $projectVersion)
    {
        $deleteForm = $this->createDeleteForm($projectVersion);

        return $this->render('ProjectBundle:common\projectversion:show.html.twig', array(
            'projectVersion' => $projectVersion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectVersion entity.
     *
     * @Route("/{id}/edit", name="projectversion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectVersion $projectVersion)
    {
        $deleteForm = $this->createDeleteForm($projectVersion);
        $projects = $this->getDoctrine()->getManager()
            ->getRepository('ProjectBundle:Common\Project')
            ->findBy(['idCreateur'=> \UsersBundle\Entity\Users::getCurrentUsers()]);

        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectVersionType', $projectVersion, ['projects'=>$projects]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->setDate($projectVersion); // for these date

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('projectversion_edit', array('id' => $projectVersion->getId()));
        }

        return $this->render('ProjectBundle:common\projectversion:edit.html.twig', array(
            'projectVersion' => $projectVersion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectVersion entity.
     *
     * @Route("/{id}", name="projectversion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectVersion $projectVersion)
    {
        $form = $this->createDeleteForm($projectVersion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectVersion);
            $em->flush();
        }

        return $this->redirectToRoute('projectversion_index');
    }

    /**
     * Creates a form to delete a projectVersion entity.
     *
     * @param ProjectVersion $projectVersion The projectVersion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectVersion $projectVersion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectversion_delete', array('id' => $projectVersion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
