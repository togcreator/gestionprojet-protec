<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Project controller.
 *
 * @Route("project")
 */
class ProjectController extends Controller
{   
    /**
    * Override method getUser parent
    *
    * @return UserClient
    */
    protected function getUser() {
        //==============================================
        // $user = parent::getUser();
        $session_id = $this->container->get('session')->get('log');
        $bu_id = $this->container->get('session')->get('BU');
        $manager = $this->getDoctrine()->getManager();
        $login = $manager->getRepository('UsersBundle:Users')->findOneBy(['id' => $session_id]);
        $return = $manager->getRepository('UsersBundle:UserClient')->findBBU($login->getUsername(), $bu_id, true);

       return $return;
    }

    /**
     * Lists all project entities.
     *
     * @Route("/contact", name="project_contact")
     * @Method("GET")
     */
    public function contactAction(Request $request)
    {
        if( empty($request->get('q')) ) return;

        $em = $this->getDoctrine()->getManager();
        $q = $request->get('q');

        // contact
        $data = $this->contact($q);
        return new JsonResponse($data);
    }

    

    /**
     * Lists all project entities.
     *
     * @Route("/", name="project_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $orderby = ($orderby = $request->get('orderby')) ? $orderby : 'idLeader';
        $orderby = $this->getOrderProject($orderby);

        $projects = $em->getRepository('ProjectBundle:Common\Project')->findClient($this->getUser()->getId(), $orderby);

        // return
        $projet = $projets = [];
        foreach($projects as $key => $project) 
        {
            $clefs = null;

            // par tri
            if( strpos(strtolower($orderby), 'leader') !== false || $orderby == "" )
                $clefs = $project->getLeaders()->getFirstname();

            if( strpos(strtolower($orderby), 'date') !== false )
                $clefs = $project->getDatefinPrevue();

            if( strpos(strtolower($orderby), 'statut') !== false )
                $clefs = $project->getStatuts()->getlabel();

            if( strpos(strtolower($orderby), 'workshop') !== false )
                $clefs = $project->getWorkshop()->getLabel();

            if( strpos(strtolower($orderby), 'contact') !== false ) {
                // getting user_client et ProjectVersionUser
                $contact = $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findContact(['idProjetVersion' => $project->getId()]);
                if( !count($contact) ) continue; // pas de contact
                $clefs = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $contact[0]->getIdUser()]);
                if( !is_object($clefs) ) continue; // faux contact
                $clefs = $clefs->getFirstname();
            }

            /* clef null on continue */
            if( $clefs == null ) continue;

            if( $clefs instanceof \DateTime ) {
                $date_format = ['fr' => 'd-m-Y', 'en' => 'm-d-Y'];
                $locale = $request->getLocale();
                $format = array_key_exists($locale, $date_format) ? $date_format[$locale] : $date_format['en'];
                $clefs = $clefs->format($format );
                $clefs = str_replace('--', '-', $clefs);
            }

            $clefs = str_replace(' ', '-', $clefs);

            /* attribution des opérations a l'étape */
            foreach( $project->getEtape() as &$etape ) {
                $operations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idEtape' => $etape->getId()]);
                $operations = $operations ? $operations : [];
                $etape->setOperations($operations);
            }

            if( !isset($projets[$clefs]) ) $projets[$clefs] = [];
            $projets[$clefs][] = $project;
        }

        // return
        return $this->render('ProjectBundle:common\project:index.html.twig', array(
            'projects' => $projets,
            'statuts' => $em->getRepository('ProjectBundle:Back\Statut')->findAll(),
            'piorites' => $em->getRepository('ProjectBundle:Back\Priorites')->findAll(),
            'workshops' => $em->getRepository('ProjectBundle:Back\Workshop')->findAll(),
        ));
    }

    /**
     * Creates a new project entity.
     *
     * @Route("/new", name="project_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $project = new Project();

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectType', $project, ['dataForm' => $this->dataForm([])]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // for createur
            $this->setUser($project);

            // for statut
            $this->setStatut($project);

            // pour code
            \AppBundle\Entity\Classes\Utils::setCode($project);

            /* workshop */
            $this->setWorkshop($project);

            // date creation
            $project->setDateCreation(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            // getting to setting type to user
            $this->setTypeToUser($project);

            // =============================================
            $this->setNotif($project);

            // next form
            return $this->redirectToRoute('project_edit', ['id' => $project->getId()]);            
        }

        return $this->render('ProjectBundle:common\project:new.html.twig', array(
            'project' => $project,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a project entity.
     *
     * @Route("/{id}", name="project_show")
     * @Method("GET")
     */
    public function showAction(Project $project)
    {
        $deleteForm = $this->createDeleteForm($project);

        return $this->render('ProjectBundle:common\project:show.html.twig', array(
            'project' => $project,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing project entity.
     *
     * @Route("/{id}/edit", name="project_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Project $project)
    {
        $em = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($project);

        //======================== Utilisateur(s) ==========================
        $users = $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findEmploye(['idProjetVersion' => $project->getId()]);
        $user_ids = [];
        foreach($users as $key => $user)
            $user_ids[] = (string)$user->getIdRelation();
        $project->setUser($user_ids); // setter user
        dump($user_ids);

        $contact = [];
        $user = $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findContact(['idProjetVersion' => $project->getId()]);
        if(count($user)) {
            $user_id = $user[0]->getIdUser();

            $relation = $user[0]->getIdRelation();
            $relations = explode('-', $relation);
            $project->setContact($relation);

            $user_contact = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $user_id]);
            $rbu = $em->getRepository('UsersBundle:BusinessUnit')->findByUser($user_id); // business unit
            if(count($rbu) && count($relations)) {
                foreach( $rbu as $r ) {
                    if( $r->getId() == (int)$relations[1] )
                        $key = $user_contact->getFirstname() . ' ' . $user_contact->getLastname() . ' - ' . $r->getNomBusinessUnit();
                }
            }
            else $key = $user_contact->getFirstname() . ' ' . $user_contact->getLastname();

            $id = "{$user_contact->getId()}-{$rbu[0]->getId()}";
            $contact = [$key => $id];
        }
        $dataForm = $this->dataForm($contact);
        //==================================================================

        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectType', $project, ['dataForm' => $dataForm]);
        $editForm->handleRequest($request);

        //============= contact ===========================================
        // $query = $request->get('projectBundle_common_project');
        // if(isset($query['contact'])) $project->setContact((int)$query['contact']);
        //=================================================================

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            /* type de user setter/getter */
            $this->setTypeToUser($project);

            /* transaction dans la base de donnée */
            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('project_edit', array('id' => $project->getId()));
        }

        // on affiche les note et documents du projet en cours
        $projectNotes = $em->getRepository('ProjectBundle:Common\ProjectNotes')->findBy(['idProjetVersion' => $project->getId()]);
        if( $projectNotes ) {
            foreach($projectNotes as &$notes)
            {
                // pour etape
                if( ($id_etape = $notes->getIdEtape()) )
                    $notes->setEtape($em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $id_etape]));
                // pour operation
                if( ($id_operation = $notes->getIdOperation()) )
                    $notes->setOperation($em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findOneBy(['id' => $id_operation]));
            }
        }

        // pour documents
        $projectDocs = $em->getRepository('ProjectBundle:Common\ProjectDocs')->findBy(['idProjet' => $project->getId()]);
        if( $projectDocs ) {
            foreach($projectDocs as &$docs)
            {
                // pour etape
                if( ($id_etape = $docs->getIdEtape()) )
                    $docs->setEtape($em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $id_etape]));
                // pour operation
                if( ($id_operation = $docs->getIdOperation()) )
                    $docs->setOperation($em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findOneBy(['id' => $id_operation]));
            }
        }

        // pour etape jalons
        $projectEtapesJalons = $em->getRepository('ProjectBundle:Common\ProjectEtapesJalons')->findBy(['idProjectVersion' => $project->getId()]);
        if( $projectEtapesJalons ) {
            foreach($projectEtapesJalons as &$jalons)
                if( ($id_resultat = $jalons->getIdResultat()) )
                    $jalons->setResultat($em->getRepository('ProjectBundle:Back\Resultat')->findOneBy(['id' => $id_resultat]));
        }
        // pour operations
        $projectEtapesOperations = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperations')->findBy(['idProjectVersion' => $project->getId()]);

        // les intervenants
        $projectVersionUsers = $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findEmploye(['idProjetVersion' => $project->getId()]);
        if(count($projectVersionUsers)) {
            foreach ($projectVersionUsers as &$pU) 
                if( ($id_role = $pU->getIdRole()) )
                    $pU->setRole($em->getRepository('ProjectBundle:Back\Roles')->findOneBy(['id' => $id_role]));
        }
        $projectEtapesOperationsUsers = $em->getRepository('ProjectBundle:Common\ProjectEtapesOperationsUsers')->findBy(['idProjetversion' => $project->getId()]);
        if($projectEtapesOperationsUsers) {
            foreach ($projectEtapesOperationsUsers as &$pOu) 
                if( ($id_role = $pOu->getIdRole()) )
                    $pOu->setRole($em->getRepository('ProjectBundle:Back\Roles')->findOneBy(['id' => $id_role]));
        }

        return $this->render('ProjectBundle:common\project:edit.html.twig', array(
            'project' => $project,
            'projectNotes' => $projectNotes,
            'projectDocs' => $projectDocs,
            'projectEtapesJalons' => $projectEtapesJalons,
            'projectEtapesOperations' => $projectEtapesOperations,
            'projectVersionUsers' => $projectVersionUsers,
            'ProjectEtapesOperationsUsers' => $projectEtapesOperationsUsers,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a project entity.
     *
     * @Route("/{id}", name="project_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Project $project)
    {
        $form = $this->createDeleteForm($project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($project);
            $em->flush();
        }

        return $this->redirectToRoute('project_index');
    }

    /**
     * Creates a form to delete a project entity.
     *
     * @param Project $project The project entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Project $project)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('project_delete', array('id' => $project->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

     // getting project
    private function getOrderProject( $orderby ) 
    {
        // for statut
        if( $orderby == 'idContact' )
            $orderby = 'contact';

        // for statut
        if( $orderby == 'idStatut' )
            $orderby = 'statut';

        // for workshop
        if( $orderby == 'idWorkshop' )
            $orderby = 'idWorkshop';

        // for idLeader
        if( $orderby == 'idLeader' )
            $orderby = 'idLeader';

        // for date fin prevue
        if( $orderby == 'datefinprevue' )
            $orderby = 'datefinPrevue';

        return $orderby;
    }

    // private 
    // $em->getRepository('UsersBundle:UserClient')->findEmploye()

    //============ client ============
    private function client () 
    {   
        $em = $this->getDoctrine()->getManager();
        $data = [
            'total_count' => 0,
            'incomplete_results' => true,
            'items' => []
        ];

        $users = $em->getRepository('UsersBundle:UserClient')->findEmploye();
        if( count($users) ) {
            $data['total_count'] = count($users);
            foreach( $users as $user ) {
                $user_id = $user->getId();
                $rbu = $em->getRepository('UsersBundle:BusinessUnit')->findByUser($user_id); // business unit
                if( count($rbu)) {
                    foreach($rbu as $bu) {
                        $text = $user->getFirstname() . ' ' .$user->getLastname() . ' - ' . $bu->getNomBusinessUnit();
                        $data['items'][] = [
                            'id' => "{$user_id}-{$bu->getId()}",
                            'text' => $text
                        ];
                    }
                }else {
                    $text = $user->getFirstname() . ' ' .$user->getLastname();
                    $data['items'][] = [
                        'id' => $user_id,
                        'text' => $text
                    ];
                }
            }
            $data['incomplete_results'] = false;
        }
        return $data;
    }
    //=================================

    //============ contact ============
    private function contact ($q) 
    {   
        $em = $this->getDoctrine()->getManager();
        $data = [
            'total_count' => 0,
            'incomplete_results' => true,
            'items' => []
        ];

        $users = $em->getRepository('UsersBundle:UserClient')->findContactBy(['firstname' => $q, 'lastname' => $q], 'or');
        if( count($users) ) {
            $data['total_count'] = count($users);
            foreach( $users as $user ) {
                $user_id = $user->getId();
                $rbu = $em->getRepository('UsersBundle:BusinessUnit')->findByUser($user_id); // business unit
                if( count($rbu)) {
                    foreach($rbu as $bu) {
                        $text = $user->getFirstname() . ' ' .$user->getLastname() . ' - ' . $bu->getNomBusinessUnit();
                        $data['items'][] = [
                            'id' => "{$user_id}-{$bu->getId()}",
                            'text' => $text
                        ];
                    }
                }else {
                    $text = $user->getFirstname() . ' ' .$user->getLastname();
                    $data['items'][] = [
                        'id' => $user_id,
                        'text' => $text
                    ];
                }
            }
            $data['incomplete_results'] = false;
        }

        return $data;
    }
    //=================================

    // data form
    private function dataForm ($contact)
    {
        $em = $this->getDoctrine()->getManager();
        return [
            'entityJs' => $em->getRepository('ProjectBundle:Back\EntityJ')->findAll(),
            'workshops' => $em->getRepository('ProjectBundle:Back\Workshop')->findAll(),
            'statuts' => $em->getRepository('ProjectBundle:Back\Statut')->findAll(),
            'modeacces' => $em->getRepository('ProjectBundle:Back\ModeAcces')->findAll(),
            'users' => $em->getRepository('UsersBundle:UserClient')->findEmploye(),
            'clients' => $this->client(),
            'contact' => $contact
        ];
    }

    // for user or createur
    private function setUser ($project)
    {
        $em = $this->getDoctrine()->getManager();
        $createur = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id'=>$project->getIdCreateur()]);
        $project->setCreateur($createur);
        $leader = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id'=>$project->getIdLeader()]);
        $project->setLeaders($leader);
    }

    // for statut
    private function setStatut ($project) 
    {
        $statut = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Back\Statut')->findOneBy(['id'=>$project->getStatut()]);
        // dump($statut);
        $project->setStatuts($statut);
    }

     /* pour wokshop */
    private function setWorkshop ($project) 
    {
        $em = $this->getDoctrine()->getManager();
        $workshop = $em->getRepository('ProjectBundle:Back\Workshop')->findOneBy(['id' => $project->getIdWorkshop()]);
        $project->setWorkshop($workshop);
    }

    // type to user
    private function setTypeToUser ($project)
    {
        if( !is_object($project) ) return;
        $em = $this->getDoctrine()->getManager();
        $project_id = $project->getId();

        $user_s = $project->getUser();
        $users = [];
        foreach($user_s as $key => $user) {
            $u = explode('-', $user);
            $users[$key] = (int)$u[0];
        }
        if( !count($users) ) return;

        //================
        // contact
        //================
        $contact = $project->getContact();
        $contacts = explode('-', $contact);
        $users['contact'] = (int)$contacts[0];

        // erase for exist data
        $projects = $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findBy(['idProjetVersion' => $project_id]);
        if( count($projects) )
            foreach( $projects as $project )
                if( !in_array($project->getIdUser(), $users) ) { /* if not inside change to 0 */
                    $em->remove($project);
                    $em->flush(); // update it
                }

        // adding and/or updating
        foreach ($users as $key => $id)
        {
            if( $id == 0 ) continue;
            $idRelation = $key === 'contact' ? $contact : $user_s[$key];
            $user = $em->getRepository('ProjectBundle:Common\ProjectVersionUser')->findOneBy(['idUser' => $id, 'idRelation' => $idRelation]);
            $user = $user ? $user : new \ProjectBundle\Entity\Common\ProjectVersionUser;
            /* pour users */
            $uu = $em->getRepository('UsersBundle:UserClient')->findOneBy(['id' => $id]);
            $user->setUser($uu); // setting user id

            /* pour project */
            $user->setIdProjetVersion($project_id); // setting user id
            if( $key === 'contact') { 
                $user->setIdRelation($contact);
            }else {
                $s = (string)$user_s[$key];
                $user->setIdRelation($s);
            }

            /* persist user */
            $em->persist($user);
            $em->flush(); /* maj */
        }
    }

    /**
    * Setting Notif to mail to user project
    */
    private function setNotif ($project) {
        $cm = $this->container->get('codemail');
        $codemail = $cm->getCode();

        $recip = [];
        $users = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectVersionUser')->findBy(['idProjetVersion' => $project->getId()]);
        foreach($users as $user) {
            $recip[] = $user->getUser()->getId() . '_' . $user->getUser()->getEmail();
        }

        $recipient = $this->get('envoimail_handler');
        $recipient->mailNotif('Création d\'un projet', "Un projet est crée et s'intitule \"{$project->getLabel()}\"", $codemail, $recip);
    }
}