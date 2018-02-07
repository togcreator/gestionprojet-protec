<?php

namespace ProjectBundle\Controller\Common;

use ProjectBundle\Entity\Common\ProjectEtapesJalons;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Projectetapesjalon controller.
 *
 * @Route("projet/etapesjalons")
 */
class ProjectEtapesJalonsController extends Controller
{
    /**
     * Lists all projectEtapesJalon entities.
     *
     * @Route("/", name="projectetapesjalons_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projectEtapesJalons = $em->getRepository('ProjectBundle:Common\ProjectEtapesJalons')->findAll();
        if( count($projectEtapesJalons) )
            foreach($projectEtapesJalons as &$jalons) {
                $currentUser = \UsersBundle\Entity\Users::getCurrentUsers('id'); // current user 
                $projet = $em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $jalons->getIdProjectVersion()]);
                $jalons->setProjet($projet);

                if( $projet && $jalons->getProjet()->getIdCreateur() != $currentUser && $currentUser != 1 ) {
                    unset($jalons);
                    continue;
                }

                $jalons->setEtape($em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $jalons->getIdEtape()]));
            }

        return $this->render('ProjectBundle:common/projectetapesjalons:index.html.twig', array(
            'projectEtapesJalons' => $projectEtapesJalons,
        ));
    }

    /**
     * Lists ajax data
     *
     * @Route("/ajax", name="projectetapesjalons_ajax_get")
     * @Method({"GET", "POST"})
     */
    public function ajaxAction(Request $request)
    {
        // getting etape by idProjectVersion
       if( ($idProjectVersion = $request->get('idProjectVersion')) && $request->get('request') == 'etapes')
       {
            $etapes = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion'=>$idProjectVersion]);
            if( !$etapes ) return new JsonResponse(array('result'=>false));

            // json return
            $json = ['result'=>true, 'data'=>[]];
            foreach($etapes as $etape)
                $json['data'][$etape->getId()] = $etape->getObject();
            return new JsonResponse($json);
       }

       // getting agenda by idEtape
       if( ($idProjetEtape = $request->get('idEtape')) && $request->get('request') == 'agenda')
       {
            $agendas = $this->getDoctrine()->getManager()->getRepository('ProjectBundle:Agenda\AgendaWorker')->findBy(['idProjetEtape'=>$idProjetEtape]);
            if( !$agendas ) return new JsonResponse(array('result'=>false));
            // json return
            $json = ['result'=>true, 'data'=>[]];
            foreach($agendas as $agenda)
                $json['data'][$agenda->getId()] = $agenda->getTitre();
            return new JsonResponse($json);
        }

        if(($id = $request->get('id'))) 
        {
            $em = $this->getDoctrine()->getManager();

            /* pour etapes jalons */
            $etapesjalons = $em->getRepository('ProjectBundle:Common\ProjectEtapesJalons')->findOneBy(['id' => $id]);
            if( !$etapesjalons ) 
                return new JsonResponse(['resultat' => false]);

            /* pour agenda*/
            $agenda = $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findOneBy(['idProjetJalon' => $id]);
            
            ob_start();
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title"><?php echo $etapesjalons->getObject() ?></h5>
            </div>

            <div class="modal-body">
                <div class="fullcalendar-event-colors"></div>
                <script type="text/javascript">
                    // var eventColors = 
                    //     {
                    //         title: '{{ 'projectetape.title'|trans({}, 'projectetape') }} - {{ etape.object|raw }}',
                    //         start: '{{ etape.datedebutprevue|date('Y-m-d') }}',
                    //         end: '{{ etape.datefinprevue|date('Y-m-d') }}',
                    //         color: '#EF5350',
                    //         url: '{{ path('projectetape_edit', {'id': etape.id }) }}'
                    //     },
                    //     {
                    //         title: '{{ 'projectetape.title'|trans({}, 'projectetape') }} - {{ etape.object|raw }}',
                    //         start: '{{ etape.datedebutreelle|date('Y-m-d') }}',
                    //         end: '{{ etape.datefinreelle|date('Y-m-d') }}',
                    //         color: '#26A69A',
                    //         url: '{{ path('projectetape_edit', {'id': etape.id }) }}'
                    //     },
                </script>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $this->container->get('translator')->trans('global.close_button') ?></button>
            <?php
            $html = ob_get_contents();
            ob_end_clean();

            return new Response($html);
       }

       return new JsonResponse(array('result'=>false));
    }



    /**
     * Creates a new projectEtapesJalon entity.
     *
     * @Route("/new", name="projectetapesjalons_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $projectEtapesJalon = new ProjectEtapesJalons();
        $dataForm = $this->dataForm();

        /* pour projet */
        if( ($idProject = $request->get('idProject')) || ($idProject = $request->get('idProjet')) ) {
            /* pour setter idProjectVersion */
            $projectEtapesJalon->setIdProjectVersion($idProject);
            /* pour etape zéro */
            $projectEtapesJalon->setIdEtape(0);

            /* pour l'étape du projet e question */
            $etapes = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findBy(['idProjetVersion' => $idProject]);
            $dataForm['etapes'] = $etapes;
        }
        /* end of */

        $form = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesJalonsType', $projectEtapesJalon, ['dataForm' => $dataForm]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // for idAgenda
            $projectEtapesJalon->setIdAgenda(0);

            /**
             * Pour project
             */
            $project = $em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $projectEtapesJalon->getIdProjectVersion()]);
            $projectEtapesJalon->setProject($project);

            /**
             * Pour etape
             */
            $etape = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $projectEtapesJalon->getIdEtape()]);
            $projectEtapesJalon->setEtape($etape);

            /**
             * Pour resultat
             */
            $resultat = $em->getRepository('ProjectBundle:Back\Resultat')->findOneBy(['id' => $projectEtapesJalon->getIdResultat()]);
            $projectEtapesJalon->setResultat($resultat);


            /* etape pour etape jalon */
            $this->setType($projectEtapesJalon);

            // flush etape jalon
            $em->persist($projectEtapesJalon);
            $em->flush();

            // for agenda
            $this->setAgenda($projectEtapesJalon);

            // redirect ot project
            if( $request->get('submit') )
                return $this->redirectToRoute('project_edit', ['id' => $projectEtapesJalon->getIdProjectVersion(), '_fragment' => 'jalon']);

            return $this->redirectToRoute('projectetapesjalons_index');
        }

        return $this->render('ProjectBundle:common/projectetapesjalons:new.html.twig', array(
            'projectEtapesJalon' => $projectEtapesJalon,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projectEtapesJalon entity.
     *
     * @Route("/{id}", name="projectetapesjalons_show")
     * @Method("GET")
     */
    public function showAction(ProjectEtapesJalons $projectEtapesJalon)
    {
        $deleteForm = $this->createDeleteForm($projectEtapesJalon);

        return $this->render('ProjectBundle:common/projectetapesjalons:show.html.twig', array(
            'projectEtapesJalon' => $projectEtapesJalon,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projectEtapesJalon entity.
     *
     * @Route("/{id}/edit", name="projectetapesjalons_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProjectEtapesJalons $projectEtapesJalon)
    {
        $em = $this->getDoctrine()->getmanager();
        $deleteForm = $this->createDeleteForm($projectEtapesJalon);
        $editForm = $this->createForm('ProjectBundle\Form\Common\ProjectEtapesJalonsType', $projectEtapesJalon, ['dataForm' => $this->dataForm()]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            /**
             * Pour project
             */
            $project = $em->getRepository('ProjectBundle:Common\Project')->findOneBy(['id' => $projectEtapesJalon->getIdProjectVersion()]);
            $projectEtapesJalon->setProjet($project);

            /**
             * Pour etape
             */
            $etape = $em->getRepository('ProjectBundle:Common\ProjectEtape')->findOneBy(['id' => $projectEtapesJalon->getIdEtape()]);
            $projectEtapesJalon->setEtape($etape);

            /**
             * Pour resultat
             */
            $resultat = $em->getRepository('ProjectBundle:Back\Resultat')->findOneBy(['id' => $projectEtapesJalon->getIdResultat()]);
            $projectEtapesJalon->setResultat($resultat);

            $em->persist($projectEtapesJalon);
            $em->flush();

            /**
             * retour
             */
            if( $request->get('idProjet') )
                return $this->redirectToRoute('project_edit', ['id' => $projectEtapesJalon->getIdProjectVersion(), '_fragment' => 'jalon']);

            return $this->redirectToRoute('projectetapesjalons_edit', array('id' => $projectEtapesJalon->getId()));
        }

        return $this->render('ProjectBundle:common/projectetapesjalons:edit.html.twig', array(
            'projectEtapesJalon' => $projectEtapesJalon,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projectEtapesJalon entity.
     *
     * @Route("/{id}", name="projectetapesjalons_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProjectEtapesJalons $projectEtapesJalon)
    {
        $form = $this->createDeleteForm($projectEtapesJalon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projectEtapesJalon);
            $em->flush();
        }

        $referer = $request->headers->get('referer');
        if( preg_match('/edit/', $referer) )
            $referer = $referer . '#jalon';

        return $this->redirect($referer);
    }

    /**
     * Creates a form to delete a projectEtapesJalon entity.
     *
     * @param ProjectEtapesJalons $projectEtapesJalon The projectEtapesJalon entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProjectEtapesJalons $projectEtapesJalon)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projectetapesjalons_delete', array('id' => $projectEtapesJalon->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    // date for etape
    private function setDate($projectEtapesJalon) 
    {
        // ddp
        $dp = $projectEtapesJalon->getDateprevue();
        $projectEtapesJalon->setDateprevue(new \DateTime(str_replace('-','/',$dp)));
        // ddp
        $dr = $projectEtapesJalon->getDatereelle();
        $projectEtapesJalon->setDatereelle(new \DateTime(str_replace('-','/',$dr)));
    }

    // data form
    private function dataForm () 
    {
        $em = $this->getDoctrine()->getManager();
        $bu_id = $this->container->get('session')->get('BU');

        return [
            'projects'   => $em->getRepository('ProjectBundle:Common\Project')->findByBU(null, $bu_id),
            'etapes'     => $em->getRepository('ProjectBundle:Common\ProjectEtape')->findAll(),
            'agendas'    => $em->getRepository('ProjectBundle:Agenda\AgendaWorker')->findAll(),
            'resultats'  => $em->getRepository('ProjectBundle:Back\Resultat')->findAll(),
            'jalons'     => $em->getRepository('ProjectBundle:Back\Jalon')->findAll(),
        ];
    }

    // for agenda
    private function setAgenda ($projectEtapesJalon) 
    {
        // for angenda
        $agenda = \ProjectBundle\Entity\Agenda\AgendaWorker::MinAgenda([
            'idProjetJalon' => $projectEtapesJalon->getId(),
            'dateDebPrevue' => $projectEtapesJalon->getDateprevue(),
            'dateDebReelle' => $projectEtapesJalon->getDatereelle(),
        ]);

        $em = $this->getDoctrine()->getManager();
        $em->persist($agenda);
        $em->flush();
    }

    // for project et etape
    private function setType ($projectEtapesJalon) 
    {
        $em = $this->getDoctrine()->getManager();
        
        // popur type de jalon
        $typejapon = $em->getRepository('ProjectBundle:Back\Jalon')->findOneBy(['id' => $projectEtapesJalon->getIdTypeJalon()]);
        $projectEtapesJalon->setTypejalon($typejapon);
    }
}
