<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamResultat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Crmparamactivity controller.
 *
 * @Route("crm/paramresultat")
 */
class CrmParamResultatController extends Controller
{
    /**
     * Lists all crmParamResultat entities.
     *
     * @Route("/", name="crmparamresultat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamResultat = $em->getRepository('CrmBundle:Back\CrmParamResultat')->findAll();

        return $this->render('CrmBundle:back/crmparamresultat:index.html.twig', array(
            'crmParamResultat' => $crmParamResultat,
        ));
    }

    /**
     * Creates a new crmParamResultat entity.
     *
     * @Route("/new", name="crmparamresultat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamResultat = new CrmParamResultat();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamResultatType', $crmParamResultat, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* updload for img et logo */
            $dir = $this->getParameter('upload_dir');            
            $crmParamResultat->setImgcouleur(Utils::Upload_file($crmParamResultat->getImgcouleur(), $dir));
            $crmParamResultat->setLogo(Utils::Upload_file($crmParamResultat->getLogo(), $dir));

            /*version*/
            $crmParamResultat->setVersion(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamResultat);
            $em->flush();

            return $this->redirectToRoute('crmparamresultat_index');
        }

        return $this->render('CrmBundle:back/crmparamresultat:new.html.twig', array(
            'crmParamResultat' => $crmParamResultat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamResultat entity.
     *
     * @Route("/{id}", name="crmparamresultat_show")
     * @Method("GET")
     */
    public function showAction(CrmParamResultat $crmParamResultat)
    {
        $deleteForm = $this->createDeleteForm($crmParamResultat);

        return $this->render('CrmBundle:back/crmparamresultat:show.html.twig', array(
            'crmParamResultat' => $crmParamResultat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamResultat entity.
     *
     * @Route("/{id}/edit", name="crmparamresultat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamResultat $crmParamResultat)
    {
        $deleteForm = $this->createDeleteForm($crmParamResultat);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamResultatType', $crmParamResultat, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            /* update upload logo and img */
            $dir = $this->getParameter('upload_dir');
            if( ($imgcouleur_string = Utils::Upload_file($crmParamResultat->getImgcouleur(), $dir)) ) $crmParamResultat->setImgcouleur($imgcouleur_string);
            else $crmParamResultat->setImgcouleur($request->get('img_couleur'));

            if( ($logo = Utils::Upload_file($crmParamResultat->getLogo(), $dir)) ) $crmParamResultat->setLogo($logo);
            else $crmParamResultat->setLogo($request->get('logo'));

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('crmparamresultat_edit', array('id' => $crmParamResultat->getId()));
        }

        return $this->render('CrmBundle:back/crmparamresultat:edit.html.twig', array(
            'crmParamResultat' => $crmParamResultat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamResultat entity.
     *
     * @Route("/{id}", name="crmparamresultat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamResultat $crmParamResultat)
    {
        $form = $this->createDeleteForm($crmParamResultat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamResultat);
            $em->flush();
        }

        return $this->redirectToRoute('crmparamresultat_index');
    }

    /**
     * Creates a form to delete a crmParamResultat entity.
     *
     * @param CrmParamResultat $crmParamResultat The crmParamResultat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamResultat $crmParamResultat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparamresultat_delete', array('id' => $crmParamResultat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'typeresultats' => $em->getRepository('CrmBundle:Back\CrmParamTypeResultat')->findBy(['ouvert' => 1]),
        ];
    }
}
