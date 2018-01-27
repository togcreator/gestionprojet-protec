<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectsFilters;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Projectsfilter controller.
 *
 * @Route("project/filter")
 */
class ProjectsFiltersController extends Controller
{
    /**
     * Lists all projectsFilter entities.
     *
     * @Route("/contact", name="projectsfilters_contact")
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
     * Lists all projectsFilter entities.
     *
     * @Route("/", name="projectsfilters_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = 0;

        /* pour le sauvegarde */
        if( $request->get('action') == 'validate' && ($label = $request->get('label')) /*&& $request->isXMLHttpRequest()*/ ) {
            /* on devrait modifie ça plutard mais ... */
            $lib_lang = ['fr' => 'lib0', 'en' => 'lib1', 'nl' => 'lib2', 'de' => 'lib3', 'es' => 'lib4', 'it' => 'lib5'];
            $locale = $request->getLocale(); /* langue courant */
            $projectfilters = $em->getRepository('ProjectBundle:Common\ProjectsFilters')->findBy([$lib_lang[$locale] => strtolower($label)]);

            if( count($projectfilters) )
                return new JsonResponse(['return' => true]);
            /* json response */
            return new JsonResponse(['return' => false]);
        }

        /* le choix de l'enregistrement de filtre */
        if( ($id = $request->get('id')) ) {
            $projectFilters = $em->getRepository('ProjectBundle:Common\ProjectsFilters')->findOneBy(['idUser' => $this->getUser(), 'id' => $id]);
            $projectFilters = $projectFilters ? $projectFilters : new ProjectsFilters();
            $projectFilters->setTitle($id);
        }
        else
            $projectFilters = new ProjectsFilters();

        /* on supprime */
        if( ($action = $request->get('action')) && $action == 'trash' )
            if( is_object($projectFilters) ) {
                $em->remove($projectFilters);
                $em->flush();
                /* et on renvoye un vide */
                $projectFilters = new ProjectsFilters();
                // $projectfilters->setMode(0);
            }

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectFiltersType', $projectFilters, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        // redirect to project
        if( !$form->isSubmitted() && !$request->isXMLHttpRequest() ) return $this->redirectToRoute('project_index');

        // form
        if( !$form->isSubmitted() && !$form->isValid() )
            return $this->render('ProjectBundle:common\project:filter.html.twig', ['form' => $form->createView()]);

        /* pour resultat du filtre */
        $projet = $projets = [];
        if( $projectFilters->getMode() )
        {
            $search = $this->search($projectFilters, $request->getLocale());
            $projects = $search['project'];
            $orderby = ($orderby = $projectFilters->getTri()) ? $orderby : 'idLeader';
            foreach($projects as $key => $project) 
            {
                $clefs = null;

                // par tir
                if( strpos(strtolower($orderby), 'leader') !== false || $orderby == "" )
                    $clefs = $project->getLeaders()->getFirstname();

                if( strpos(strtolower($orderby), 'date') !== false )
                    $clefs = $project->getDatefinPrevue();

                if( strpos(strtolower($orderby), 'statut') !== false )
                    $clefs = $project->getStatuts()->getLabel();

                if( strpos(strtolower($orderby), 'workshop') !== false )
                    $clefs = $project->getWorkshop()->getLabel();

                // continue if null
                if( $clefs == null ) continue;

                if( $clefs instanceof \DateTime ) {
                    $date_format = ['fr' => 'd-m-Y', 'en' => 'm-d-Y'];
                    $clefs = $clefs->format($date_format[$request->getLocale()]);
                    $clefs = str_replace('--', '-', $clefs);
                }


                if( !isset($projets[$clefs]) ) $projets[$clefs] = [];
                $projets[$clefs][] = $project;
            }
        } 

        /* rendre en bas de casse le label */
        $projectFilters->setLabel( strtolower($projectFilters->getLabel()) );

        /* flusher */
        $em->persist($projectFilters);
        $em->flush();

        // render
        return $this->render('ProjectBundle:common\project:index.html.twig', array(
            'projects' => $projets,
            'statuts' => $em->getRepository('ProjectBundle:Back\Statut'),
            'mode' => $projectFilters->getMode()
        ));
    }

    /**
     * Finds and displays a projectsFilter entity.
     *
     * @Route("/{id}", name="projectsfilters_show")
     * @Method("GET")
     */
    public function showAction(ProjectsFilters $projectsFilter, $lang)
    {
        return $this->render('ProjectBundle:common/project:show.html.twig', array(
            'projectsFilter' => $projectsFilter,
        ));
    }

    // search 
    private function search ($projectFilters, $lang) 
    {
        // var
        $projet = $etape = $operation = $date = [];

        // for project
        $projet['idWorkshop'] = $projectFilters->getIdWorkshop();
        $projet['idEntiteJ'] = $projectFilters->getIdEntiteJ();
        $projet['statut'] = $projectFilters->getStatut();
        $projet['modeAcces'] = $projectFilters->getModeAcces();
        $projet['idLeader'] = $projectFilters->getIdLeader();
        $projet['tri'] = $projectFilters->getTri();
        $projet['contact'] = $projectFilters->getIdContact();
        $projet['idBusinessUnit'] = $projectFilters->getIdBusinessUnit();
        $projet['idRelationProfessionnelles'] = $projectFilters->getIdRelationProfessionnelles();
        

        // for etape
        $etape['idResultat'] = $projectFilters->getIdResultat();
        $etape['idStatut'] = $projectFilters->getIdStatut();
        $etape['datedebutPrevue'] = $projectFilters->getDatedebutPrevueE();
        $etape['datefinPrevue'] = $projectFilters->getDatefinPrevueE();

        // for operation
        $operation['idStatut'] = $projectFilters->getIdStatutO();
        $operation['idResultat'] = $projectFilters->getIdResultatO(); 
        $operation['idPriorite'] = $projectFilters->getIdPriorite(); 
        $operation['idAlerte'] = $projectFilters->getIdAlerte();
        $operation['idJalonPrevu'] = $projectFilters->getIdJalon();
        $operation['idJalonActuel'] = $projectFilters->getIdJalon();
        $operation['datedebutPrevue'] = $projectFilters->getDatedebutPrevueO();
        $operation['datefinPrevue'] = $projectFilters->getDatefinPrevueO();

        $lib = ['fr' => 'lib0', 'en' => 'lib1', 'nl' => 'lib2', 'de' => 'lib3', 'es' => 'lib4', 'it' => 'lib5'];

        dump($projet);

        // request
        $project = $this->getDoctrine()->getManager()
            ->getRepository('ProjectBundle:Common\Project')
            ->findBySearch($projet, $etape, $operation, $date, $lib[$lang]);

        // return value
        return ['project' => $project];
    }

    // dataForm
    private function dataForm ()
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'entityJs'  => $em->getRepository('ProjectBundle:Back\EntityJ')->findAll(),
            'workshops' => $em->getRepository('ProjectBundle:Back\Workshop')->findAll(),
            'statuts'   => $em->getRepository('ProjectBundle:Back\Statut')->findAll(),
            'resultats' => $em->getRepository('ProjectBundle:Back\Resultat')->findAll(),
            'priorites' => $em->getRepository('ProjectBundle:Back\Priorites')->findAll(),
            'alerts'    => $em->getRepository('ProjectBundle:Back\ProjectAlert')->findAll(),
            'users_roles' => $em->getRepository('ProjectBundle:Back\Roles')->findAll(),
            'resultats' => $em->getRepository('ProjectBundle:Back\Resultat')->findAll(),
            'jalons'    => $em->getRepository('ProjectBundle:Common\ProjectEtapesJalons')->findAll(),
            'modeacces' => $em->getRepository('ProjectBundle:Back\ModeAcces')->findAll(),
            'projectFilters' => $em->getRepository('ProjectBundle:Common\ProjectsFilters')->findAll(),
            'contacts' => $em->getRepository('UsersBundle:UserClient')->findContact(),
            'businessUnits' => $em->getRepository('UsersBundle:BusinessUnit')->findAll(),
            'relationProfessionnelles' => $em->getRepository('UsersBundle:Back\UsersParamRelationsProfessionnelles')->findAll()
        ];
    }
}