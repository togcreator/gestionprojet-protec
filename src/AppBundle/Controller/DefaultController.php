<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UsersBundle\Entity\Users;
use AppBundle\Entity\Front\Compaign;
use AppBundle\Entity\Common\Langage;


class DefaultController extends Controller
{
    // layout
    public function layout($layout) 
    {
        if( !count($layout) ) return;

        $dir = 'layout_'. $layout['layout'] . '/' . strtoupper($layout['orientation']). '/' .  $layout['mode'] ;
        return $this->render('default/' . $dir . '/index.html', []);
    }

    // _layout
    public function _layout ($request) 
    {
        $layout = [];
        if( $request->get('layout') )
            $layout['layout'] = $request->get('layout');

        if( $request->get('orientation') )
            $layout['orientation'] = $request->get('orientation');
        else
            $layout['orientation'] = 'ltr';

        if( $request->get('mode') )
            $layout['mode'] = $request->get('mode');
        else
            $layout['mode'] = 'default';

        // layout render
        return $this->layout($layout);
    }  

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // _layout
        if( $request->get('layout') && ($layout = $this->_layout($request)) )
            return $layout;

        // these compaign
        $compaign = new Compaign();
        $compaigns = $compaign->getCompaigns($this->getDoctrine(), 'now');
        $compaigns['months'] = $compaign->getCompaignMonths();
        $old_compaigns = $compaign->getCompaigns($this->getDoctrine(), (new \DateTime())->modify('-1 days'));

        // date par dsemaine ity
        $compaign_totals = array();
        $count = 0;
        if( $compaigns )
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
        // for yesterday
        $active_compaign = 0;
        if( $old_compaigns )
            foreach( $old_compaigns['compaign'] as $compaign )
                if( $compaign->getStatus() == 'active' )
                    $active_compaign ++;
        // for today
        if( $compaigns )
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

        // replace this example code with whatever you need
        return $this->render('page/page.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'compaigns' => $compaigns,
            'old_compaigns' => $old_compaigns,
            'compaign_total' => $compaign_totals
        ]);
    }
}
