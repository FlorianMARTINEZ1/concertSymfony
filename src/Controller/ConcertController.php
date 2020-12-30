<?php

namespace App\Controller;

use App\Entity\Band;
use App\Entity\Member;
use App\Entity\ShowList;
use App\Entity\User;
use App\Form\BandType;
use App\Form\MemberType;
use App\Form\ShowListType;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ConcertController extends AbstractController
{
    /**
     * Affichage de la liste des concerts à venir
     *
     * @Route("/", name="concert")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(ShowList::class);
        return $this->render('concert/index.html.twig', [
                'concerts' => $repository->findAll()
            ]
        );
    }

    /**
     * Affiche une liste de tous les concerts
     *
     * @Route("/concert", name="list")
     */
    public function list(): Response
    {
        $repository = $this->getDoctrine()->getRepository(ShowList::class);
        return $this->render('concert/concert.html.twig', [
                'name' => "list",
                'concerts' => $repository->findAll()
            ]
        );
    }

    /**
     * Affiche une liste de groupes
     *
     * @return Response
     *
     * @Route("/group", name="group")
     */
    public function group(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Band::class);
        return $this->render('concert/group.html.twig', [
                'groups' => $repository->findAll()
            ]
        );
    }


    /**
     * Créer un nouveau groupe
     *
     * @Route("/group/create", name="groupe_create")
     * @param Request $request
     * @isGranted("ROLE_ADMIN")
     * @return Response
     */
    public function createGroupe(Request $request): Response
    {
        $groupe = new Band();

        $form = $this->createForm(BandType::class, $groupe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getDate() holds the submitted values
            // but, the original `$task` varibale has also been updated
            $groupe = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if task is a doctrine entity, save it !
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($groupe);
            $entityManager->flush();
            return $this->redirectToRoute('concert');
        }
        return $this->render('concert/newGroupe.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Update un groupe
     *
     * @Route("/group/edit/{id}", name="groupe_edit")
     * @param Request $request
     * @param Band $groupe
     * @isGranted("ROLE_ADMIN")
     * @return Response
     */

    public function editGroupe(Request $request, Band $groupe): Response
    {
        $form = $this->createForm(BandType::class, $groupe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $groupe = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($groupe);
            $entityManager->flush();

            $this->addFlash('success', 'Concert update! Music is power!');
            return $this->redirectToRoute('list');
        }

        return $this->render('concert/newGroupe.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Affiche le detail d'un groupe
     *
     * @param Band $groupe
     * @return Response
     *
     * @Route("/group/{id}", name="group_detail")
     */
    public function group_detail(Band $groupe): Response
    {
        return $this->render('concert/detail.html.twig', [
                'groups' => $groupe
            ]
        );
    }

    /**
     * Créer un nouveau membre
     *
     * @Route("group/membre/create", name="groupe_create")
     * @param Request $request
     * @isGranted("ROLE_ADMIN")
     * @return Response
     */
    public function createMembre(Request $request): Response
    {
        $membre = new Member();

        $form = $this->createForm(MemberType::class, $membre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getDate() holds the submitted values
            // but, the original `$task` varibale has also been updated
            $membre = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if task is a doctrine entity, save it !
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($membre);
            $entityManager->flush();
            return $this->redirectToRoute('concert');
        }
        return $this->render('concert/newMembre.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Update un membre
     *
     * @Route("/group/membre/edit/{id}", name="membre_edit")
     * @param Request $request
     * @param Member $membre
     * @isGranted("ROLE_ADMIN")
     * @return Response
     */

    public function editMembre(Request $request, Member $membre): Response
    {
        $form = $this->createForm(MemberType::class, $membre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $membre = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($membre);
            $entityManager->flush();

            $this->addFlash('success', 'Membre update');
            return $this->redirectToRoute('group');
        }

        return $this->render('concert/newMembre.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Supprime un membre
     *
     * @Route("/group/membre/delete/{id}", name="delete_membre")
     * @isGranted("ROLE_ADMIN")
     * @param Request $request
     * @param Member $membre
     * @return Response
     */
    public function deleteMembre(Request $request, Member $membre): Response
    {
        if (!$membre) {
            throw $this->createNotFoundException('No membre found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($membre);
        $em->flush();
        return $this->redirectToRoute('concert');
    }

    /**
     * Supprime un groupe
     *
     * @Route("/group/delete/{id}", name="delete_groupe")
     * @isGranted("ROLE_ADMIN")
     * @param Request $request
     * @param Band $band
     * @return Response
     */
    public function deleteGroupe(Request $request, Band $band): Response
    {
        if (!$band) {
            throw $this->createNotFoundException('No group found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($band);
        $em->flush();
        return $this->redirectToRoute('concert');
    }

    /**
     * Créer un nouveau concert
     *
     * @Route("/concert/create", name="concert_create")
     * @param Request $request
     * @isGranted("ROLE_ADMIN")
     * @return Response
     */
    public function createConcert(Request $request): Response
    {
        $show = new ShowList();

        $form = $this->createForm(ShowListType::class, $show);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getDate() holds the submitted values
            // but, the original `$task` varibale has also been updated
            $show = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if task is a doctrine entity, save it !
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($show);
            $entityManager->flush();
            return $this->redirectToRoute('concert');
        }
        return $this->render('concert/new.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Update un concert
     *
     * @Route("/concert/edit/{id}", name="concert_edit")
     * @param Request $request
     * @param ShowList $concert
     * @isGranted("ROLE_ADMIN")
     * @return Response
     */

    public function editConcert(Request $request, ShowList $concert): Response
    {
        $form = $this->createForm(ShowListType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            $this->addFlash('success', 'Concert update! Music is power!');
            return $this->redirectToRoute('list');
        }

        return $this->render('concert/new.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * Affiche le detail d'un concert
     *
     * @Route("/concert/{id}", name="concert_detail")
     * @param ShowList $concert
     * @return Response
     * @isGranted("ROLE_ADMIN")
     *
     */
    public function concertDetail(ShowList $concert): Response
    {
        return $this->render('concert/detailConcert.html.twig', [
                'concert' => $concert
            ]
        );
    }

    /**
     * Supprime un concert
     *
     * @Route("/concert/delete/{id}", name="delete_concert")
     * @isGranted("ROLE_ADMIN")
     */
    public function deleteConcert(Request $request, ShowList $concert): Response
    {
        if (!$concert) {
            throw $this->createNotFoundException('No concert found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($concert);
        $em->flush();
        return $this->redirectToRoute('concert');
    }

}

