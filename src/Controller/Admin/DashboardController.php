<?php

namespace App\Controller\Admin;

use App\Entity\PricingPlan;
use App\Entity\PricingPlanBenefit;
use App\Entity\PricingPlanFeature;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(PricingPlanCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin Panel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('PricingPlan', 'fas fa-list', PricingPlan::class);
        yield MenuItem::linkToCrud('PricingPlanFeature', 'fas fa-list', PricingPlanFeature::class);
        yield MenuItem::linkToCrud('PricingPlanBenefit', 'fas fa-list', PricingPlanBenefit::class);
    }
}
