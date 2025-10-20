<?php

namespace App\Controller;

use App\Entity\Relay;
use App\Repository\RelayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/relay')]
class RelayController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function index(RelayRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);

        $relay = new Relay();
        $relay->setDeviceId($payload['deviceId']);
        $relay->setStatus($payload['status']);
        $relay->setLastUpdated(new \DateTime());

        $em->persist($relay);
        $em->flush();

        return $this->json($relay, 201);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(Relay $relay): JsonResponse
    {
        return $this->json($relay);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Request $request, Relay $relay, EntityManagerInterface $em): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);

        $relay->setStatus($payload['status']);
        $relay->setLastUpdated(new \DateTime());

        $em->flush();

        return $this->json($relay);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Relay $relay, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($relay);
        $em->flush();

        return $this->json(['status' => 'deleted']);
    }
}
