<?php

namespace AppBundle\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Front\Compaign;
use UsersBundle\Entity\Users;

/**
 * Compaign controller.
 *
 * @Route("compaign")
 */
class CompaignController extends Controller
{   
    protected $conpaigns = array();
    public function __construct () 
    {
        $this->compaigns['months'] = (new Compaign())->getCompaignMonths();
    }

    /**
     * Lists all compaign entities.
     *
     * @Route("/", name="compaign_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        // checking user_login
        if(!Users::is_logged_in($request))
            return $this->redirectToRoute('users_index');

        // request
        $request = $request->get('month');
        if( $request )
        {
            $date = (new \DateTime())->format(sprintf('Y-%s-1', $request));
            $old_date = date(sprintf('Y-%s-1', $request));
            // print_r( $old_date );
            // $old_date = (new \DateTime($old_date))->modify('-1 days')->format('Y-m-d');
            $old_date = null;
        }
        else 
        {
            $date = 'now';
            $old_date = (new \DateTime())->modify('-1 days'); // object
        }

        // compaigns
        $compaign = new Compaign();
        $compaigns = $compaign->getCompaigns($this->getDoctrine(), $date); // string
        $compaigns['months'] = $compaign->getCompaignMonths();

        // for old data
        $old_compaigns = $old_date != null ? $compaign->getCompaigns($this->getDoctrine(), $old_date) : null; // object

        // date
        $compaign_totals = array();
        $count = 0;
        foreach( $compaigns['compaign'] as $compaign )
            $count += $compaign->getBudget();
        $compaign_totals['now'] = $count;

        // for old
        $count = 0;
        if( $old_compaigns )
            foreach( $old_compaigns['compaign'] as $compaign )
                $count += $compaign->getBudget();
        $compaign_totals['old'] = $count;


        /** calcul de nombre d'active */
        $active_compaign = 0;
        // for yesterday
        if( $old_compaigns )
            foreach( $old_compaigns['compaign'] as $compaign )
                if( $compaign->getStatus() == 'active' )
                    $active_compaign ++;
        // for today
        foreach( $compaigns['compaign'] as $compaign )
            if( $compaign->getStatus() == 'active' )
                $active_compaign ++;
        // assign now
        $compaigns['active_compaign'] = $active_compaign;


        // inflation par conpaign
        if( $compaigns['compaign'] && $old_compaigns['compaign'] )
        {
            foreach( $compaigns['compaign'] as &$comp )
                foreach( $old_compaigns['compaign'] as &$old )
                    if( ($cb=$comp->getBudget()) && ($ob=$old->getBudget()) && ($comp->getIdType() == $old->getIdType()) )
                        if( $cb>0 && $ob>0 )
                        {
                            $old->setInflation( round(($ob*100)/$cb, 2) );
                            $comp->setInflation( round(($cb*100)/$ob, 2) );
                        }
        } 
// 
        // print_r( $compaigns['compaign'] );
        // print_r( $old_compaigns['compaign'] );

        /** return value now */
        return $this->render('page/page.html.twig', array(
            'compaigns' => $compaigns,
            'old_compaigns' => $old_compaigns,
            'compaign_total' => $compaign_totals
        ));
    }

    /**
     * Creates a new compaign entity.
     *
     * @Route("/new", name="compaign_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $compaign = new Compaign();
        $form = $this->createForm('AppBundle\Form\CompaignType', $compaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($compaign);
            $em->flush();

            return $this->redirectToRoute('compaign_show', array('id' => $compaign->getId()));
        }

        return $this->render('compaign/new.html.twig', array(
            'compaign' => $compaign,
            'form' => $form->createView(),
            'compaigns' => $this->compaigns,
        ));
    }

    /**
     * Finds and displays a compaign entity.
     *
     * @Route("/{id}", name="compaign_show")
     * @Method("GET")
     */
    public function showAction(Compaign $compaign)
    {
        $deleteForm = $this->createDeleteForm($compaign);

        return $this->render('page/page.html.twig', array(
            'compaign' => $compaign,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing compaign entity.
     *
     * @Route("/{id}/edit", name="compaign_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Compaign $compaign)
    {
        $deleteForm = $this->createDeleteForm($compaign);
        $editForm = $this->createForm('AppBundle\Form\CompaignType', $compaign);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compaign_edit', array('id' => $compaign->getId()));
        }

        return $this->render('compaign/edit.html.twig', array(
            'compaign' => $compaign,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a compaign entity.
     *
     * @Route("/{id}", name="compaign_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Compaign $compaign)
    {
        $form = $this->createDeleteForm($compaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($compaign);
            $em->flush();
        }

        return $this->redirectToRoute('compaign_index');
    }

    /**
     * Creates a form to delete a compaign entity.
     *
     * @param Compaign $compaign The compaign entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Compaign $compaign)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('compaign_delete', array('id' => $compaign->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
