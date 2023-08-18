<?php

namespace App\Controller\Admin;

use App\Entity\Gains;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GainsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gains::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
