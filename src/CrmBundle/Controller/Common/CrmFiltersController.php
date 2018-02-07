<?php

namespace CrmBundle\Controller\Common;

use CrmBundle\Entity\Common\CrmFilters;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Crmfilter controller.
 *
 * @Route("crm/filter")
 */
class CrmFiltersController extends Controller
{
    /**
     * Lists all crmFilter entities.
     *
     * @Route("/contact", name="crmfilters_contact")
     * @Method({"GET", "POST"})
     */
    public function contactAction(Request $request)
    {
        if( !($idContact = $request->get('idContact')))  return;
        $em = $this->getDoctrine()->getManager();

        $r_bu = [];
        $r_el = [];

        if( $idContact == 0 ) 
        {
            $rbu = $em->getRepository('UsersBundle:BusinessUnit')->findAll();
            if(count($rbu))
                foreach($rbu as $bu)
                    $r_bu[] = ["id" => $bu->getId(), "text" => $bu->getNomBusinessUnit()];

            $rel = $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findAll();
                if( count($rel) ) 
                    foreach($rel as $r)
                        $r_el[$r->getId()] = ['id' => $r->getId(), 'text' => $r->getLabel()];
        }
        else {

            $rbu = $em->getRepository('UsersBundle:BusinessUnit')->findByUser($idContact); // business unit
            if(count($rbu)) 
                foreach($rbu as $bu)  {
                    $r_bu[] = ["id" => $bu->getId(), "text" => $bu->getNomBusinessUnit()];
                    $rel = $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findByUser($idContact, $bu->getId());
                    if( count($rel) ) 
                        foreach($rel as $r)
                            $r_el[] = ['id' => $r->getId(), 'text' => $r->getLabel()];

                }
        }
        
        return new JsonResponse([
            'iDBusinessUnit' => $r_bu,
            'idRelationProfessionnelles' => $r_el
        ]); 
    }

    /**
     * Lists all crmFilter entities.
     *
     * @Route("/", name="crmfilters_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = 0;

        /* pour le sauvegarde */
        if( $request->get('action') == 'validate' && ($label = $request->get('label')) && $request->isXMLHttpRequest() ) {
            /* on devrait modifie ça plutard mais ... */
            $lib_lang = ['fr' => 'lib0', 'en' => 'lib1', 'nl' => 'lib2', 'de' => 'lib3', 'es' => 'lib4', 'it' => 'lib5'];
            $locale = $request->getLocale(); /* langue courant */
            $crmfilters = $em->getRepository('CrmBundle:Common\CrmFilters')->findBy([$lib_lang[$locale] => strtolower($label)]);

            if( count($crmfilters) )
                return new JsonResponse(['return' => true]);
            /* json response */
            return new JsonResponse(['return' => false]);
        }

        /* le choix de l'enregistrement de filtre */
        if( ($id = $request->get('id')) ) {
            $crmFilters = $em->getRepository('CrmBundle:Common\CrmFilters')->findOneBy(['idUser' => $this->getUser(), 'id' => $id]);
            $crmFilters = $crmFilters ? $crmFilters : new CrmFilters();
            $crmFilters->setTitle($id);
        }
        else
            $crmFilters = new CrmFilters();

        /* on supprime */
        if( ($action = $request->get('action')) && $action == 'trash' )
            if( is_object($crmFilters) ) {
                $em->remove($crmFilters);
                $em->flush();
                /* et on renvoye un vide */
                $crmFilters = new CrmFilters();
            }

        $form = $this->createForm('CrmBundle\Form\Common\CrmFiltersType', $crmFilters, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        // redirect to crm
       // if( !$form->isSubmitted() && !$request->isXMLHttpRequest() ) return $this->redirectToRoute('crmdossier_index');

        // form
        if( !$form->isSubmitted() && !$form->isValid() )
            return $this->render('CrmBundle:common\crmfilters:index.html.twig', ['form' => $form->createView()]);

        /* pour resultat du filtre */
        $crm = $crms = [];
        if( $crmFilters->getMode() )
        {
            $search = $this->search($crmFilters, $request->getLocale());
            $crms = $search['crm'];
            $orderby = ($orderby = $crmFilters->getTri()) ? $orderby : 'Statut';
            foreach($crms as $key => $cr) 
            {
                $clefs = null;

                if( strpos(strtolower($orderby), 'date') !== false )
                    $clefs = $cr->getDatefinPrevue();

                if( strpos(strtolower($orderby), 'statut') !== false ) {
                    $clefs = $em->getRepository('CrmBundle:Back\CrmParamStatut')->findOneBy(['id' => $cr->getStatut()]);
                    if(!is_object($clefs)) continue;
                    $clefs = $clefs->getLabel();
                }

                // continue if null
                if( $clefs == null ) continue;

                if( $clefs instanceof \DateTime ) {
                    $date_format = ['fr' => 'd-m-Y', 'en' => 'm-d-Y'];
                    $clefs = $clefs->format($date_format[$request->getLocale()]);
                    $clefs = str_replace('--', '-', $clefs);
                }

                if( !isset($crm[$clefs]) ) $crm[$clefs] = [];

                 //=============== entite J ==============
                $entite = $em->getRepository('ClientBundle:Client')->findOneBy(['id' => $cr->getIdEntiteJ()]);
                $cr->setEntite($entite);
                //=============== Cycle ================
                $cycle = $em->getRepository('CrmBundle:Back\CrmParamCycles')->findOneBy(['id' => $cr->getIdCycle()]);
                $cr->setCycle($cycle);

                $crm[$clefs][] = $cr;
            }
        } 

        /* rendre en bas de casse le label */
        $crmFilters->setLabel( strtolower($crmFilters->getLabel()) );

        /* flusher */
        // $em->persist($crmFilters);
        // $em->flush();

        // render
        return $this->render('CrmBundle:common\crmdossier:index.html.twig', array(
            'crmDossiers' => $crm,
            'filtre' => true,
            'statuts' => $em->getRepository('CrmBundle:Back\CrmParamStatut'),
            'mode' => $crmFilters->getMode()
        ));
    }

    /**
     * Finds and displays a crmFilter entity.
     *
     * @Route("/{id}", name="crmfilters_show")
     * @Method("GET")
     */
    public function showAction(CrmFilters $crmFilter, $lang)
    {
        return $this->render('CrmBundle:common/crm:show.html.twig', array(
            'crmFilter' => $crmFilter,
        ));
    }

    // search 
    private function search ($crmFilters, $lang) 
    {
        // var
        $crm = $etape = $operation = $date = [];

        // for crm
        // $crm['idWorkshop'] = $crmFilters->getIdWorkshop();
        $crm['idEntiteJ'] = $crmFilters->getIdEntiteJ();
        $crm['statut'] = $crmFilters->getStatut();
        $crm['modeAcces'] = $crmFilters->getModeAcces();
        $crm['idLeader'] = $crmFilters->getIdLeader();
        $crm['tri'] = $crmFilters->getTri();
        $crm['contact'] = $crmFilters->getIdContact();
        $crm['idBusinessUnit'] = $crmFilters->getIdBusinessUnit();
        $crm['idRelationProfessionnelles'] = $crmFilters->getIdRelationProfessionnelles();
        

        // for etape
        $etape['idResultat'] = $crmFilters->getIdResultat();
        $etape['idStatut'] = $crmFilters->getIdStatut();
        $etape['datedebutPrevue'] = $crmFilters->getDatedebutPrevueE();
        $etape['datefinPrevue'] = $crmFilters->getDatefinPrevueE();

        // for operation
        $operation['idStatut'] = $crmFilters->getIdStatutO();
        $operation['idResultat'] = $crmFilters->getIdResultatO(); 
        $operation['idPriorite'] = $crmFilters->getIdPriorite(); 
        $operation['idAlerte'] = $crmFilters->getIdAlerte();
        $operation['idJalonPrevu'] = $crmFilters->getIdJalon();
        $operation['idJalonActuel'] = $crmFilters->getIdJalon();
        $operation['datedebutPrevue'] = $crmFilters->getDatedebutPrevueO();
        $operation['datefinPrevue'] = $crmFilters->getDatefinPrevueO();

        $lib = ['fr' => 'lib0', 'en' => 'lib1', 'nl' => 'lib2', 'de' => 'lib3', 'es' => 'lib4', 'it' => 'lib5'];

        // request
        $crm = $this->getDoctrine()->getManager()
            ->getRepository('CrmBundle:Common\CrmDossier')
            ->findBySearch($crm, $etape, $operation, $date, $lib[$lang]);

        // return value
        return ['crm' => $crm];
    }

    // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'entityJs'  => $em->getRepository('ClientBundle:Client')->findAll(),
            'statuts'   => $em->getRepository('CrmBundle:Back\CrmParamStatut')->findAll(),
            'resultats' => $em->getRepository('CrmBundle:Back\CrmParamResultat')->findAll(),
            'priorites' => $em->getRepository('CrmBundle:Back\CrmParamPriorites')->findAll(),
            'alerts'    => $em->getRepository('CrmBundle:Back\CrmParamAlert')->findAll(),
            'modeacces' => $em->getRepository('CrmBundle:Back\CrmParamModeAccess')->findAll(),
            'crmFilters' => $em->getRepository('CrmBundle:Common\CrmFilters')->findAll(),
            'contacts' => $em->getRepository('UsersBundle:UserClient')->findContact(),
            'businessUnits' => $em->getRepository('UsersBundle:BusinessUnit')->findAll(),
            'relationProfessionnelles' => $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findAll()
        ];
    }
}