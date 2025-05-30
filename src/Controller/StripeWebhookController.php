<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Webhook;
use Stripe\Stripe;
use App\Repository\UserRepository;

class StripeWebhookController extends AbstractController
{
    #[Route('/webhook/stripe', name: 'stripe_webhook', methods: ['POST'])]
    public function index(
        Request $request, 
        UserRepository $userRepository, 
        FormationRepository $FormationRepository, 
        EntityManagerInterface $entityManager
    ): JsonResponse {
        $endpoint_secret = 'sk_test_51Q2uEVCybVMxBZRKcLqfHUFnQvjOueAwU2yWdvq14b5MXbdDXem9DIQdbc8sZQLIx7Oo79oJvuoyzN3siUTYzJnE000UFP1lK7'; 

        $payload = $request->getContent();
        $sig_header = $request->headers->get('stripe-signature');

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);

            if ($event->type === 'checkout.session.completed') {
                $session = $event->data->object;
                $email = $session->customer_email; 
                $formationId = $session->metadata->formation_id ?? null; 

                $customerEmail = $session->customer_details->email;

                $user = $userRepository->findOneBy(['email' => $email]);

                if ($user && $formationId) {
                    $formation = $FormationRepository->find($formationId);

                    if ($formation) {
                        $user->setRoles(array_merge($user->getRoles(), [$formation->getRole()])); 
                        $entityManager->persist($user);
                        $entityManager->flush();
                    }
                }
            }

            return new JsonResponse(['status' => 'success']);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}
