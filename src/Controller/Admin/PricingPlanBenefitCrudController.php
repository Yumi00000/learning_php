<?php

namespace App\Controller\Admin;

use App\Entity\PricingPlanBenefit;
use App\Form\PricingPlanType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
            IdField::new('id')->hideOnForm(),
            CollectionField::new('pricingPlan')
                ->setEntryType(PricingPlanType::class)
                ->onlyOnForms(),
            TextEditorField::new('name'),

        ];
    }

}
