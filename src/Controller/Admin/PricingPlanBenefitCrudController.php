<?php

namespace App\Controller\Admin;

use App\Entity\PricingPlanBenefit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PricingPlanBenefitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PricingPlanBenefit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('pricingPlan')->setLabel('Pricing Plan ID'),
            TextEditorField::new('name'),

        ];
    }

}
