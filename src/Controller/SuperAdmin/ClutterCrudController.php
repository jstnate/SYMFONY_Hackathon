<?php

namespace App\Controller\SuperAdmin;

use App\Entity\Clutter;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClutterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Clutter::class;
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
