<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectDocs;
use ProjectBundle\Entity\Common\ProjectsDocsFilters;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Classes\Utils;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Crmdocsenvoye controller.
 *
 * @Route("projet/docs")
 */
class ProjectDocsController extends Controller
{
    /**
     * Filter result.
     *
     * @Route("/filter", name="projectdocs_filters")
     * @Method({"GET", "POST"})
     */
    public function filtersAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $projectDocsfilters = $em->getRepository('ProjectBundle:Common\ProjectsDocsFilters')->findOneBy(['idUser' => \UsersBundle\Entity\Users::getCurrentUsers('id')]);
        $projectDocsfilters = $projectDocsfilters ? $projectDocsfilters : new ProjectsDocsFilters();

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectDocsFiltersType', $projectDocsfilters, ['dataForm' => $this->dataForm()]);
        $form->handleRequest($request);

        if( !$form->isSubmitted() && !$request->isXMLHttpRequest() ) return $this->redirectToRoute('project_index');

        // form
        if( !$form->isSubmitted() && !$form->isValid() )
            return $this->render('ProjectBundle:common\projectdocs:filter.html.twig', ['form' => $form->createView()]);

        $data = $form->getData();
        $projectdocs = $this->searchDocs($data);

        // enregistrer dans la base de données
        $em->persist($projectDocsfilters);
        $em->flush();

        return $this->render('ProjectBundle:common/projectdocs:index.html.twig', array(
            'project' => [],
            'projectdocs' => $projectdocs,
            'sortBy' => $data->getTri()
        ));
    }

    /** pour le recherche des document des projet étape et/ou pération **/
    private function searchDocs ( $data ) 
    {   
        $Project = $Etape = $Operation = [];

        // pour le tri
        if( $data->getTri() == null || $data->getTri() == '' ) $data->setTri('idLeader');

        /** pur project **/
        if( ($responsible = $data->getResponsible()) )
            $Project['idLeader'] = $responsible;
        if( ($idWorkshop = $data->getIdWorkshop()) )
            $Project['idWorkshop'] = $idWorkshop;

        /** pour etape **/
        foreach( get_class_methods( $data ) as $function ) {
            if( strpos($function, 'set') !== FALSE ) continue;
            if( strpos($function, 'E') == (strlen($function) - 1) )
                if( ($value = $data->$function()) )
                    $Etape[str_replace('get', '', $function)] = $value;
        }
                    
        if( ($idStatut = $data->getIdStatut()) )
            $Etape['idStatut'] = $idStatut;
        if( ($idRole = $data->getIdRole()) )
            $Etape['idRole'] = $idRole;

        /** pour operation **/
        foreach( get_class_methods( $data ) as $function ) {
            if( strpos($function, 'set') !== FALSE ) continue;
            if( strpos($function, 'O') == (strlen($function) - 1) )
                if( ($value = $data->$function()) )
                    $Operation[str_replace('get', '', $function)] = $value;
        }

        if( ($idPriorite = $data->getIdPriorite()) )
            $Operation['idPriorite'] = $idPriorite;
        if( ($idJalon = $data->getIdJalon()) )
            $Operation['idJalon'] = $idJalon;

        // pour avec tri
        $docsTris = [];
        $tri = '';
        $em = $this->getDoctrine()->getManager();

        // obtenir le projet en lui même
        $projects = $em->getRepository('ProjectBundle:Common\Project')->findBy($Project);

        // ses etapes et opérations conséquent
        if( !count($projects) ) return $this->redirectToRoute('project_index');
        foreach( $projects as $project ) {

            // pour les tir de projet
            if( $data->getTri() == 'idWorkshop' )
                $tri = $project->getWorkshop()->getLabel();

            if( $data->getTri() == 'idLeader' )
                $tri = $project->getLeaders()->getRole()->getLabel();

            // document
            if( !isset($projectdocs[$tri][1]) ) $projectdocs[$tri][1] = ['etape' => [], 'operation' => []];
            if( !isset($projectdocs[$tri][2]) ) $projectdocs[$tri][2] = ['etape' => [], 'operation' => []];
            if( !isset($projectdocs[$tri][4]) ) $projectdocs[$tri][4] = ['etape' => [], 'operation' => []];
            if( !isset($projectdocs[$tri][6]) ) $projectdocs[$tri][6] = ['etape' => [], 'operation' => []];


            // ses étapes
            $etapes = $project->getEtape();
            if( count($etapes) ) 
            {
                foreach( $etapes as $etape ) 
                {
                    // statut
                    $statuts = [1,2,3];

                    /**  Filtre statut puisque c'est ici l'origine et on arrêt si c'est pas le cas **/
                    if( isset($Etape['idStatut']) && $etape->getIdStatut() != $Etape['idStatut'] )
                        continue;

                    // pour idRole de l'étape
                    if( isset($Etape['idRole']) ) {
                        // le schemas de relation des tables
                        // project_etape => project_etape_users => user
                        // on cherche ses users et puis on recherche ensuite leur roles
                        $etape_users = $em->getRepository('ProjectBundle:Common\ProjectEtapesUsers')->findBy(['idEtape' => $etape->getId()]);
                        if( count($etape_users) ) continue; // on arrête si c'est pas le cas
                        $etape_users = array_map(function($value){
                            if( is_object($value) ) return;
                            return $value->getId();
                        }, $etape_users);
                        // obtenir ses roles
                        $etape_users = $em->getRepository('UsersBundle:Users')->findBy(['id' => $etape_users, 'type' => [$Etape['idRole']]]);
                    }


                    /** les dates pour l'instant **/
                    // date prevue
                    if( isset($Etape['datedebutPrevueE']) ) {
                        $diff = intval(date_diff(new \DateTime($Etape['datedebutPrevueE']), $etape->getDatedebutprevue())->format('%R%a'));
                        if( $diff < 0 ) continue;
                    }

                    if( isset($Etape['datefinPrevueE']) ) {
                        $diff = intval(date_diff(new \DateTime($Etape['datefinPrevueE']), $etape->getDatefinprevue())->format('%R%a'));
                        if( $diff < 0 ) continue;
                    }

                    // date reelle
                    if( isset($Etape['datedebutReelE']) ) {
                        $diff = intval(date_diff(new \DateTime($Etape['datedebutReelE']), $etape->getDatedebutreelle())->format('%R%a'));
                        if( $diff < 0 ) continue;
                    }

                    if( isset($Etape['datefinReelE']) ) {
                        $diff = intval(date_diff(new \DateTime($Etape['datefinReelE']), $etape->getDatefinreelle())->format('%R%a'));
                        if( $diff < 0 ) continue;
                    }

                    // les diférences
                    // débutant dans x jrs
                    if( isset($Etape['dateDebutE']) ) {
                        $date_x = $Etape['dateDebutE'];
                        $date_create = date_create('now');
                        date_add($date_create, date_interval_create_from_date_string("{$date_x} days"));
                        // la difference devrait être 0
                        $diff = intval(date_diff($date_create, $etape->getDatedebutreelle())->format('%R%a') );
                        if(  $diff != 0 ) continue;
                    }

                    if( isset($Etape['dateTermineE']) ) {
                        $date_x = $Etape['dateTermineE'];
                        $date_create = date_create('now');
                        date_add($date_create, date_interval_create_from_date_string("{$date_x} days"));
                        // la difference devrait être 0
                        $diff = intval(date_diff($date_create, $etape->getDatefinreelle())->format('%R%a') );
                        if(  $diff != 0 ) continue;
                    }

                    // la date en avance ou en retard
                    if( isset($Etape['dateAvanceE']) ) {
                        $date_x = $Etape['dateTermineE'];
                        $diff = intval( date_diff($etape->getDatedebutprevue(), $etape->getDatedebutreelle())->format('%R%a') );
                        if(  $diff != $date_x ) continue;
                    }

                    if( isset($Etape['dateRetardE']) ) {
                        $date_x = $Etape['dateRetardE'];
                        $diff = intval( date_diff($etape->getDatefinprevue(), $etape->getDatefinreelle())->format('%R%a') );
                        if(  $diff != $date_x ) continue;
                    }

                    foreach( $statuts as $statut ) 
                    {
                        if( $etape->getIdStatut() == $statut )
                            $projectdocs[$tri][$statut == 3 ? 6 : $statut]['etape'][$etape->getId()] = $etape; 

                        // pour review
                        if( $etape->getIdStatut() > 6 )
                            $projectdocs[$tri][4]['etape'][$etape->getId()] = $etape; 

                        /** pour opérations **/
                        if( ($operations = $etape->getOperations()) && count($operations) ) 
                        {
                            foreach( $operations as $operation ) { /** pour operation **/

                                /**  Filtre statut puisque c'est ici l'origine et on arrêt si c'est pas le cas **/
                                if( isset($Operation['idStatut']) && $operation->getIdStatut() != $Operation['idStatut'] )
                                    continue;

                                // pour idRole de l'operation
                                if( isset($Operation['idRole']) ) {
                                    // le schemas de relation des tables
                                    // project_etape_operation => project_etape_opration_users => user
                                    // on cherche ses users et puis on recherche ensuite leur roles
                                    $operation_users = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findBy(['idOperation' => $etape->getId()]);
                                    if( count($operation_users) ) continue; // on arrête si c'est pas le cas
                                    $operation_users = array_map(function($value){
                                        if( is_object($value) ) return;
                                        return $value->getId();
                                    }, $operation_users);
                                    // obtenir ses roles
                                    $operation_users = $em->getRepository('UsersBundle:Users')->findBy(['id' => $operation_users, 'type' => [$Etape['idRole']]]);
                                }

                                /** les dates pour l'instant **/
                                // date prevue
                                if( isset($Operation['datedebutPrevue0']) ) {
                                    $diff = intval(date_diff(new \DateTime($Operation['datedebutPrevueE']), $operation->getDatedebutprevue())->format('%R%a'));
                                    if( $diff < 0 ) continue;
                                }

                                if( isset($Operation['datefinPrevueO']) ) {
                                    $diff = intval(date_diff(new \DateTime($Operation['datefinPrevueE']), $operation->getDatefinprevue())->format('%R%a'));
                                    if( $diff < 0 ) continue;
                                }

                                // date reelle
                                if( isset($Operation['datedebutReelO']) ) {
                                    $diff = intval(date_diff(new \DateTime($Etape['datedebutReelE']), $operation->getDatedebutreelle())->format('%R%a'));
                                    if( $diff < 0 ) continue;
                                }

                                if( isset($Operation['datefinReelO']) ) {
                                    $diff = intval(date_diff(new \DateTime($Etape['datefinReelE']), $operation->getDatefinreelle())->format('%R%a'));
                                    if( $diff < 0 ) continue;
                                }

                                // les diférences
                                // débutant dans x jrs
                                if( isset($Operation['dateDebutO']) ) {
                                    $date_x = $Operation['dateDebutO'];
                                    $date_create = date_create('now');
                                    date_add($date_create, date_interval_create_from_date_string("{$date_x} days"));
                                    // la difference devrait être 0
                                    $diff = intval(date_diff($date_create, $operation->getDatedebutreelle())->format('%R%a') );
                                    if(  $diff != 0 ) continue;
                                }

                                if( isset($Operation['dateTermineO']) ) {
                                    $date_x = $Operation['dateTermineO'];
                                    $date_create = date_create('now');
                                    date_add($date_create, date_interval_create_from_date_string("{$date_x} days"));
                                    // la difference devrait être 0
                                    $diff = intval(date_diff($date_create, $operation->getDatefinreelle())->format('%R%a') );
                                    if(  $diff != 0 ) continue;
                                }

                                // la date en avance ou en retard
                                if( isset($Operation['dateAvanceO']) ) {
                                    $date_x = $Operation['dateTermineO'];
                                    $diff = intval( date_diff($etape->getDatedebutprevue(), $operation->getDatedebutreelle())->format('%R%a') );
                                    if(  $diff != $date_x ) continue;
                                }

                                if( isset($Operation['dateRetardO']) ) {
                                    $date_x = $Operation['dateRetardO'];
                                    $diff = intval( date_diff($etape->getDatefinprevue(), $Operation->getDatefinreelle())->format('%R%a') );
                                    if(  $diff != $date_x ) continue;
                                }

                                /** pour not started, in_progress, et done **/
                                foreach( $statuts as $s )
                                    if( $operation->getIdStatut() == $s )
                                        $projectdocs[$tri][$s == 3 ? 6 : $s]['operation'][$operation->getId()] = $operation; 

                                // pour review
                                if( $operation->getIdStatut() > 6 )
                                    $projectdocs[$tri][4]['operation'][$operation->getId()] = $operation; 

                            }
                        }
                    }
                }
            }
        }

        return $projectdocs;
    }

    /**
     * Pour les attachements et autre
     *
     * @Route("/attach", name="projectdocs_attach")
     * @Method("GET")
     */
    public function attachAction(Request $request)
    {
        $id = $request->get('id');
        $attach = $request->get('attach');
        $type = $request->get('type');

        // retourne un message si vide
        if( !$id && !$attach && !$type ) return $this->render('ProjectBundle:common/projectdocs:attach.html.twig');

        // retourne
        $return = [];
        $em = $this->getDoctrine()->getManager();

        // pour étape
        if( strtolower($type) == 'etape' ) {
            // pour image
            if( strtolower($attach) == 'image' )
                $return['image'] = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['id' => $id]);

            // pour document
            if( strtolower($attach) == 'attach' ) {
                $etapes = $em->getRepository('ProjectBundle:Common\ProjectDocs')->findBy(['idEtape' => $id]);
                foreach( $etapes  as &$etape ) {
                    $fichier = $this->getParameter('upload_dir') . DIRECTORY_SEPARATOR . $etape->getNomdoc();
                    $etape->setOrigine( mime_content_type($fichier) ); /* ecrase sa valeur */

                    /* pour la designation */
                    $Etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $etape->getIdEtape()]);
                    $etape->setDesignation($Etapes->getObject());
                }
                // retourne la valeur
                $return['attach'] = $etapes;
            }

            // pour operation
            if( strtolower($attach) == 'operation' ) {
                $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $id]);
                $return['operation'] = $etapes->getOperations();
            }
        }

        return $this->render('ProjectBundle:common/projectdocs:attach.html.twig', ['return' => $return]);
    }

    /**
     * Lists ajax data
     *
     * @Route("/ajax", name="projectdocs_ajax_get")
     * @Method({"GET", "POST"})
     */
    public function ajaxAction(Request $request)
    {
        if(($id = $request->get('id'))) {
            $em = $this->getDoctrine()->getManager();
            $project_doc = $em->getRepository('ProjectBundle:Common\ProjectDocs')->findOneBy(['id' => $id]);
            if( !$project_doc ) 
                return new Response('');

            $fichier = $this->getParameter('upload_dir') . DIRECTORY_SEPARATOR . $project_doc->getNomdoc();
            $project_doc->setOrigine(mime_content_type($fichier)); /* ecrase sa valeur */

            /* pour translator */
            $trans = $this->container->get('translator');
            
            ob_start();
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><?php echo $project_doc->getDesignation() ?></h5>
            </div>

            <div class="modal-body">
                <table class="table datatable-basic">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $trans->trans('global.title') ?></th>
                            <th><?php echo $trans->trans('global.type_doc') ?></th>
                            <th><?php echo $trans->trans('global.download') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $project_doc->getId() ?></td>
                            <td><?php echo $project_doc->getDesignation() ?></td>
                            <td>
                                <?php 
                                    $type = $project_doc->getOrigine();
                                    echo preg_match('/\//', $type) ? $type : $trans->trans('global.no_data');
                                ?>
                            </td>
                            <td>
                                <?php if( $project_doc->getNomdoc() ): ?>
                                <a href="/uploads/<?php echo $project_doc->getNomdoc()?>" target="_blank"><?php echo $trans->trans('global.link') ?></a>
                                <?php else: ?>
                                --
                                <?php endif ?>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                </table>
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
     * Lists all projectDocs entities.
     *
     * @Route("/list", name="projectdocs_list")
     * @Method("GET")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $project_docs = $em->getRepository('ProjectBundle:Common\ProjectDocs')->findAll();
        if( $project_docs )
            foreach( $project_docs as &$docs ) {
                $docs->setProjet($em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $docs->getIdProjet()]));
                $docs->setEtape($em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $docs->getIdEtape()]));
                $docs->setOperation($em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findOneBy(['id' => $docs->getIdOperation()]));
            }

        return $this->render('ProjectBundle:common/projectdocs:list.html.twig', array(
            'projectDocs' => $project_docs,
        ));
    }

    /**
     * Lists all projectDocs entities.
     *
     * @Route("/", name="projectdocs_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // critère
        $criteria = [];
        if( ($idProject = $request->get('idProject')) ) $criteria = ['id' => $idProject];

        // pour le order by
        $sortBy = ($sortby = $request->get('sortBy')) ? $sortby : 'idLeader';

        // pour les tris
        $tri = '';
        // liste maintenant
        $projects = $em->getRepository('ProjectBundle:Common\Project')->findBy($criteria);
        
        if( !count($projects) ) return $this->redirectToRoute('project_index');

        // via statut
        $projectdocs = [];
        foreach( $projects as $project ) {

            if( $sortBy == 'idWorkshop' )
                $tri = $project->getWorkshop()->getLabel();
            if( $sortBy == 'idLeader' )
                $tri = 'Leader';

            // doc
            $etapes = $project->getEtape();
            if( count($etapes) )
                foreach( $etapes as $etape ) {
                    // statut
                    $statuts = [1, 2, 3];

                    // document
                    if( !isset($projectdocs[$tri]) ) $projectdocs[$tri] = ['etape' => [], 'operation' => []];
                    if( !isset($projectdocs[$tri]) ) $projectdocs[$tri] = ['etape' => [], 'operation' => []];
                    if( !isset($projectdocs[$tri]) ) $projectdocs[$tri] = ['etape' => [], 'operation' => []];
                    if( !isset($projectdocs[$tri]) ) $projectdocs[$tri] = ['etape' => [], 'operation' => []];

                    foreach( $statuts as $statut ) {

                        // pour review
                        if( $etape->getIdStatut() > 6 )
                            $projectdocs[$tri]['etape'][4][$etape->getId()] = $etape; 

                        if( $etape->getIdStatut() == $statut )
                            $projectdocs[$tri]['etape'][$statut == 3 ? 6 : $statut][$etape->getId()] = $etape;


                        // pour operation
                        // if( ($operations = $etape->getOperations()) && count($operations) ) {

                        //     foreach( $operations as $operation ) { /** pour operation **/
                        //         /** pour not started, in_progress, et done **/
                        //         foreach( $statuts as $s )
                        //             if( $operation->getIdStatut() == $s )
                        //                 $projectdocs[$tri][$s == 3 ? 6 : $s]['operation'][$operation->getId()] = $operation; 

                        //         // pour review
                        //         if( $operation->getIdStatut() > 6 )
                        //             $projectdocs[$tri][4]['operation'][$operation->getId()] = $operation; 

                        //     }
                        // }
                    }
                }

        }

        // retourne
        return $this->render('ProjectBundle:common/projectdocs:index.html.twig', array(
            'project' => $idProject ? $project : [],
            'projectdocs' => $projectdocs,
            'sortBy' => $sortby
        ));
    }

    /**
     * Creates a new projectDocs entity.
     *
     * @Route("/new", name="projectdocs_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $projectDocs = new ProjectDocs();
        $dataForm = $this->dataForm();
        $idProject = 0;

        /* pour opération */
        if(($idOperation = $request->get('idOperation'))) {
            if(($project = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findOneBy(['id' => $idOperation]))){
                /* pour setter idProjectVersion */
                $projectDocs->setIdOperation($idOperation);

                $project = $em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $project->getIdProjectVersion()]);
                $idProject = $project->getId();
            } else
            /* si id non valide */
                return $this->redirectToRoute('projectdocs_new');
        }

        /* pour projet */
        if( $idProject || ($idProject = $request->get('idProject')) ) {
            /* pour setter idProjectVersion */
            $projectDocs->setIdProjet($idProject);
            /* pour etape zéro */
            $projectDocs->setIdEtape(0);

            /* pour l'étape du projet e question */
            $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $idProject]);
            $dataForm['etapes'] = $etapes;

            /* pour l'étape du projet e question */
            $operations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idProjectVersion' => $idProject]);
            $dataForm['operations'] = $operations;

            /* pour l'étape du projet e question */
            $issues = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findBy(['idProjectVersion' => $idProject]);
            $dataForm['issues'] = $issues;
        }
        /* end of */

        // l'idprojet
        if( ($projet_id = $request->get('idProjet')) ) 
            $projectDocs->setIdProjet($projet_id);

        if( ($idEtape = $request->get('idEtape')) ) {
            /* pour etape zéro */
            $projectDocs->setIdEtape($idEtape);

            /* pour l'étape du projet e question */
            $idProject = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $idEtape]);
            if( $idProject ) 
            {
                $idProject = $idProject->getIdProjetVersion();
                /* pour setter idProjectVersion */
                $projectDocs->setIdProjet($idProject);

                /* pour l'étape du projet e question */
                $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $idProject]);
                $dataForm['etapes'] = $etapes;

                /* pour l'opération du projet e question */
                $operations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idEtape' => $idEtape]);
                $dataForm['operations'] = $operations;

                /* pour l'opération issue du projet e question */
                $issues = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findBy(['idProjectVersion' => $idProject]);
                $dataForm['issues'] = $issues;
            }
        }

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectDocsType', $projectDocs, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // le fichier document à télécharger
            $dir = $this->getParameter('upload_dir');
            $projectDocs->setNomdoc(Utils::Upload_file($projectDocs->getNomdoc(), $dir));

            // pour projet
            $this->setProjet($projectDocs);

            // pour user
            $this->setUser($projectDocs);

            // pour code
            \AppBundle\Entity\Classes\Utils::setCode($projectDocs);

            // =============================================
            $this->setNotif($projectDocs);

            // flush maintenant
            $em->persist($projectDocs);
            $em->flush();

            // redirect vers projet
            if( $request->get('idProject') || $request->get('idEtape') )
                return $this->redirectToRoute('project_edit', ['id' => $projectDocs->getIdProjet(), '_fragment' => 'docs']);

            // redirect vers opération
            if( $request->get('idOperation') )
                return $this->redirectToRoute('projectetapesoperations_edit', ['id' => $projectDocs->getIdOperation(), '_fragment' => 'docs']);

            return $this->redirectToRoute('projectdocs_edit', ['id' => $projectDocs->getId()]);
        }

        return $this->render('ProjectBundle:common/projectdocs:new.html.twig', array(
            'projectDocs' => $projectDocs,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectDocs entity.
     *
     * @Route("/{id}", name="projectdocs_show")
     * @Method("GET")
     */
    public function showAction(ProjectDocs $projectDocs)
    {
        $deleteForm = $this->createDeleteForm($projectDocs);

        return $this->render('ProjectBundle:common/projectdocs:show.html.twig', array(
            'projectDocs' => $projectDocs,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectDocs entity.
     *
     * @Route("/{id}/edit", name="projectdocs_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectDocs $projectDocs)
    {
        $deleteForm = $this->createDeleteForm($projectDocs);
        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectDocsType', $projectDocs, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) 
        {
            // file field
            $dir = $this->getParameter('upload_dir');
            $projectDocs->setNomdoc(Utils::Upload_file($projectDocs->getNomdoc(), $dir));

            $this->getDoctrine()->getManager()->flush();

            // redirect vers project
            if( $request->get('idProject') )
                return $this->redirectToRoute('project_edit', ['id' => $projectDocs->getIdProjet(), '_fragment' => 'docs']);

            // redirect vers project
            if( $request->get('idOperation') )
                return $this->redirectToRoute('projectetapesoperations_edit', ['id' => $projectDocs->getIdOperation(), '_fragment' => 'docs']);

            return $this->redirectToRoute('projectdocs_edit', array('id' => $projectDocs->getId()));
        }

        // nom du document
        $filetype = '';
        if( ($nomdoc = $projectDocs->getNomdoc()) )
        {
            $fichier = $this->getParameter('upload_dir') . DIRECTORY_SEPARATOR . $nomdoc;
            $filetype = mime_content_type($fichier);

            // pour office
            if( preg_match('/office|excel|word|ms|ppt/', $filetype, $matches) )
                $filetype = 'office';
            // pour pdf
            if( preg_match('/pdf/', $filetype) )
                $filetype = 'pdf';
            // pour text
            if( preg_match('/plain/', $filetype) )
                $filetype = 'text';
            // pour text
            if( preg_match('/html/', $filetype) )
                $filetype = 'html';
            // pour image
            if( preg_match('/image/', $filetype) )
                $filetype = 'image';

            if( preg_match('/zip/', $filetype) )
                $filetype = 'zip';
        }

        return $this->render('ProjectBundle:common/projectdocs:edit.html.twig', array(
            'projectDocs' => $projectDocs,
            'filetype' => $filetype,
            'filename' => $projectDocs->getNomdoc(),
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectDocs entity.
     *
     * @Route("/{id}", name="projectdocs_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectDocs $projectDocs)
    {
        $form = $this->createDeleteForm($projectDocs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectDocs);
            $em->flush();
        }

        $referer = $request->headers->get('referer');
        if( preg_match('/edit/', $referer) )
            $referer = $referer . '#docs';

        return $this->redirect($referer);
    }

    /**
     * Creates a form to delete a projectDocs entity.
     *
     * @param ProjectDocs $projectDocs The projectDocs entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectDocs $projectDocs)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectdocs_delete', array('id' => $projectDocs->getId())))
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
            'issues' => $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsIssues')->findAll(),
            'jalons' => $em->getRepository('ProjectBundle:Common\ProjectEtapesJalons')->findAll(),
            'users'  => $em->getRepository('UsersBundle:Users')->findAll(),
            'statuts' => $em->getRepository('ProjectBundle:Back\Statut')->findAll(),
            'workshops' => $em->getRepository('ProjectBundle:Back\Workshop')->findAll(),
            'priorites' => $em->getRepository('ProjectBundle:Back\Priorites')->findAll(),
            'roles' => $em->getRepository('ProjectBundle:Back\Roles')->findAll(),
        ];
    }

    /* pour projet */
    private function setProjet ($projectDocs) 
    {
        $em = $this->getDoctrine()->getManager();
        $projet = $em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $projectDocs->getIdProjet()]);
        $projectDocs->setProjet($projet);
    }

    /* pour etape */
    private function setEtape ($projectDocs) {
        $em = $this->getDoctrine()->getManager();
        $etape = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $projectDocs->getIdEtape()]);
        $projectDocs->setEtape($etape);
    }

    /* pour etape */
    private function setUser ($projectDocs) {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $projectDocs->getIdUser()]);
        $projectDocs->setUser($user);
    }

    /**
    * Setting Notif to mail to user project
    *
    * @return null
    */
    private function setNotif ($projectDocs) {
        $cm = $this->container->get('codemail');
        $codemail = $cm->getCode();

        $recip = [];
        $users = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectVersionUser')->findBy(['idProjetVersion' => $projectDocs->getIdProjet()]);
        foreach($users as $user) {
            $recip[] = $user->getUser()->getId() . '_' . $user->getUser()->getEmail();
        }

        $recipient = $this->get('envoimail_handler');
        $recipient->mailNotif('Création d\'un document', "Un document est crée qui s'intitule \"{$projectDocs->getNomdoc()}\"", $codemail, $recip);
    }
}
