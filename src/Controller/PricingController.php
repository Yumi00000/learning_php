<?php

namespace App\Controller;

use App\Entity\PricingPlan;
use App\Entity\PricingPlanFeature;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PricingController extends AbstractController
{
    #[Route('/pricing', name: 'app_pricing')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $pricingPlans = $entityManager
            ->getRepository(PricingPlan::class)
            ->findAll();
        $features = $entityManager
            ->getRepository(PricingPlanFeature::class)
            ->findAll();
        return $this->render('pricing/index.html.twig', [
            'pricing_plans' => $pricingPlans,
            'features' => $features,
        ]);
    }
}
