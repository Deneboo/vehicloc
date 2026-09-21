<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CarController extends AbstractController
{
    #[Route('/accueil', name: 'app_car')]
    public function index(CarRepository $carRepository): Response
    {
        $cars = $carRepository->findAll();

        return $this->render('car/index.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $cars,
        ]);
    }

    #[Route('/car/{id}', name: 'app_car_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(?Car $car): Response
    {
        return $this->render('car/show.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/car/{id}/remove', name: 'app_car_remove', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function remove(CarRepository $carRepository, EntityManagerInterface $manager, ?int $id): Response
    {
       $car = $carRepository->find($id);

        if (!$car) {
            return $this->redirectToRoute('app_car');
        }

        $manager->remove($car);
        $manager->flush();

        return $this->redirectToRoute('app_car');
    }

    #[Route('/car/new', name: 'app_car_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($car);
            $manager->flush();
            return $this->redirectToRoute('app_car', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('car/new.html.twig', [
            'form' => $form,
        ]);
    }
}
