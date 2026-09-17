<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CarRepository;

final class CarController extends AbstractController
{
    #[Route('/car', name: 'app_car')]
    public function index(CarRepository $carRepository): Response
    {
        $cars = $carRepository->findAll();

        return $this->render('car/home.html.twig', [
            'controller_name' => 'CarController',
            'cars' => $cars,
        ]);
    }
}
