<?php

namespace App\Controller\SuperAdmin;

use App\Entity\Domain;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DomainCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Domain::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('Id')
            ->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            ImageField::new('Logo')
                ->setUploadDir('public/uploads/domains')
                ->setBasePath('uploads/domains')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/*'
                    ]
                ]),
        ];
    }

}
