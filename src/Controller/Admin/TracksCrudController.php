<?php

namespace App\Controller\Admin;

use App\Entity\Tracks;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TracksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tracks::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
}
