<?php

namespace App\Controller;

use App\Entity\SensorData;
use App\Repository\SensorDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/sensor')]
class SensorDataController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function index(SensorDataRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);

        $sensor = new SensorData();
        $sensor->setTemperature($payload['temperature']);
        $sensor->setHumidity($payload['humidity']);
        $sensor->setPressure($payload['pressure']);
        $sensor->setGas($payload['gas']);
        $sensor->setLight($payload['light']);
        $sensor->setPresence($payload['presence']);
        $sensor->setTimestamp(new \DateTime($payload['timestamp']));

        $em->persist($sensor);
        $em->flush();

        return $this->json($sensor, 201);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(SensorData $sensor): JsonResponse
    {
        return $this->json($sensor);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Request $request, SensorData $sensor, EntityManagerInterface $em): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);

        $sensor->setTemperature($payload['temperature']);
        $sensor->setHumidity($payload['humidity']);
        $sensor->setPressure($payload['pressure']);
        $sensor->setGas($payload['gas']);
        $sensor->setLight($payload['light']);
        $sensor->setPresence($payload['presence']);
        $sensor->setTimestamp(new \DateTime($payload['timestamp']));

        $em->flush();

        return $this->json($sensor);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(SensorData $sensor, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($sensor);
        $em->flush();

        return $this->json(['status' => 'deleted']);
    }
}
