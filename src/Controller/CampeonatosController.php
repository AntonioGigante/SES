<?php

namespace App\Controller;

use App\Entity\Campeonato;
use App\Form\CampeonatoType;
use App\Repository\CampeonatoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/campeonatos")
 */
class CampeonatosController extends AbstractController
{
    /**
     * index
     * @param  mixed $campeonatoRepository
     * @return Response
     * 
     * @Route("/", name="campeonatos_index", methods={"GET"})
     */  
    /// un comentario
    public function index(CampeonatoRepository $campeonatoRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'campeonatos' => $campeonatoRepository->findAll(),
        ]);
    }

    /**
     * new
     * @param  mixed $request
     * @return Response
     *
     * este metodo crea un nuevo campeonato 
     * 
     * @Route("/new", name="campeonatos_new", methods={"GET","POST"})
     */    
    public function new(Request $request): Response
    {
        $campeonato = new Campeonato();
        $form = $this->createForm(CampeonatoType::class, $campeonato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($campeonato);
            $entityManager->flush();

            return $this->redirectToRoute('campeonatos_index');
        }

        return $this->render('campeonatos/new.html.twig', [
            'campeonato' => $campeonato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * show
     *
     * @param  mixed $campeonato
     * @return Response
     * 
     * @Route("/{id}", name="campeonatos_show", methods={"GET"})
     */    
    public function show(Campeonato $campeonato): Response
    {
        return $this->render('campeonatos/show.html.twig', [
            'campeonato' => $campeonato,
        ]);
    }

    /**
     * edit
     *
     * @param  mixed $request
     * @param  mixed $campeonato
     * @return Response
     * 
     * @Route("/{id}/edit", name="campeonatos_edit", methods={"GET","POST"})
     */  
    public function edit(Request $request, Campeonato $campeonato): Response
    {
        $form = $this->createForm(CampeonatoType::class, $campeonato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('campeonatos_index');
        }

        return $this->render('campeonatos/edit.html.twig', [
            'campeonato' => $campeonato,
            'form' => $form->createView(),
        ]);
    }

    /**
     * delete
     *
     * @param  mixed $request
     * @param  mixed $campeonato
     * @return Response
     * 
     * @Route("/{id}", name="campeonatos_delete", methods={"DELETE"})
     */ 
    public function delete(Request $request, Campeonato $campeonato): Response
    {
        if ($this->isCsrfTokenValid('delete'.$campeonato->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($campeonato);
            $entityManager->flush();
        }

        return $this->redirectToRoute('campeonatos_index');
    }
}
