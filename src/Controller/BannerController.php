<?php

namespace App\Controller;

use App\Entity\Banner;
use App\Form\BannerType;
use App\Repository\BannerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/banner')]
class BannerController extends AbstractController
{
    #[Route('/', name: 'banner_index', methods: ['GET'])]
    public function index(BannerRepository $bannerRepository): Response
    {
        return $this->render('banner/index.html.twig', [
            'banners' => $bannerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'banner_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $banner = new Banner();
        $form = $this->createForm(BannerType::class, $banner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($banner);
            $entityManager->flush();

            return $this->redirectToRoute('banner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('banner/new.html.twig', [
            'banner' => $banner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'banner_show', methods: ['GET'])]
    public function show(Banner $banner): Response
    {
        return $this->render('banner/show.html.twig', [
            'banner' => $banner,
        ]);
    }

    #[Route('/{id}/edit', name: 'banner_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Banner $banner, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BannerType::class, $banner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('banner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('banner/edit.html.twig', [
            'banner' => $banner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'banner_delete', methods: ['POST'])]
    public function delete(Request $request, Banner $banner, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$banner->getId(), $request->request->get('_token'))) {
            $entityManager->remove($banner);
            $entityManager->flush();
        }

        return $this->redirectToRoute('banner_index', [], Response::HTTP_SEE_OTHER);
    }
}
