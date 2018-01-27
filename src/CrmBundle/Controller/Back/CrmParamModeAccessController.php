<?php

namespace CrmBundle\Controller\Back;

use CrmBundle\Entity\Back\CrmParamModeAccess;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Classes\Utils;

/**
 * Crmparamactivity controller.
 *
 * @Route("crm/parammodeaccess")
 */
class CrmParamModeAccessController extends Controller
{
    /**
     * Lists all crmParamModeAccess entities.
     *
     * @Route("/", name="crmparammodeaccess_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $crmParamModeAccess = $em->getRepository('CrmBundle:Back\CrmParamModeAccess')->findAll();

        return $this->render('CrmBundle:back/crmparammodeaccess:index.html.twig', array(
            'crmParamModeAccess' => $crmParamModeAccess,
        ));
    }

    /**
     * Creates a new crmParamModeAccess entity.
     *
     * @Route("/new", name="crmparammodeaccess_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $crmParamModeAccess = new CrmParamModeAccess();
        $form = $this->createForm('CrmBundle\Form\Back\CrmParamModeAccessType', $crmParamModeAccess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** for file image and logo **/
            $dir = $this->getParameter('upload_dir');
            $crmParamModeAccess->setImgcouleur(Utils::Upload_file($crmParamModeAccess->getImgcouleur(), $dir));
            $crmParamModeAccess->setLogo(Utils::Upload_file($crmParamModeAccess->getLogo(), $dir));

            $em = $this->getDoctrine()->getManager();
            $em->persist($crmParamModeAccess);
            $em->flush();

            return $this->redirectToRoute('crmparammodeaccess_index');
        }

        return $this->render('CrmBundle:back/crmparammodeaccess:new.html.twig', array(
            'crmParamModeAccess' => $crmParamModeAccess,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a crmParamModeAccess entity.
     *
     * @Route("/{id}", name="crmparammodeaccess_show")
     * @Method("GET")
     */
    public function showAction(CrmParamModeAccess $crmParamModeAccess)
    {
        $deleteForm = $this->createDeleteForm($crmParamModeAccess);

        return $this->render('CrmBundle:back/crmparammodeaccess:show.html.twig', array(
            'crmParamModeAccess' => $crmParamModeAccess,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing crmParamModeAccess entity.
     *
     * @Route("/{id}/edit", name="crmparammodeaccess_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CrmParamModeAccess $crmParamModeAccess)
    {
        $deleteForm = $this->createDeleteForm($crmParamModeAccess);
        $editForm = $this->createForm('CrmBundle\Form\Back\CrmParamModeAccessType', $crmParamModeAccess);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $dir = $this->getParameter('upload_dir');
            // imgcouleur
            if( ($imgcouleur_string = Utils::Upload_file($crmParamModeAccess->getImgcouleur(), $dir)) )
                $crmParamModeAccess->setImgcouleur($imgcouleur_string);
            else
                $crmParamModeAccess->setImgcouleur($request->get('img_couleur'));

            // logo
            if( ($logo = Utils::Upload_file($crmParamModeAccess->getLogo(), $dir)) )
                $crmParamModeAccess->setLogo($logo);
            else
                $crmParamModeAccess->setLogo($request->get('logo'));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('crmparammodeaccess_edit', array('id' => $crmParamModeAccess->getId()));
        }

        return $this->render('CrmBundle:back/crmparammodeaccess:edit.html.twig', array(
            'crmParamModeAccess' => $crmParamModeAccess,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a crmParamModeAccess entity.
     *
     * @Route("/{id}", name="crmparammodeaccess_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CrmParamModeAccess $crmParamModeAccess)
    {
        $form = $this->createDeleteForm($crmParamModeAccess);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($crmParamModeAccess);
            $em->flush();
        }

        return $this->redirectToRoute('crmparammodeaccess_index');
    }

    /**
     * Creates a form to delete a crmParamModeAccess entity.
     *
     * @param CrmParamModeAccess $crmParamModeAccess The crmParamModeAccess entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CrmParamModeAccess $crmParamModeAccess)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('crmparammodeaccess_delete', array('id' => $crmParamModeAccess->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
