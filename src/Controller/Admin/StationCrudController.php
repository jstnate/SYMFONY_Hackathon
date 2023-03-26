<?php

namespace App\Controller\Admin;

use App\Entity\Station;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bundle\SecurityBundle\Security;

class StationCrudController extends AbstractCrudController
{


    private Security $security;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager,Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }
    public static function getEntityFqcn(): string
    {
        return Station::class;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): \Doctrine\ORM\QueryBuilder
    {
        $userId = $this->security->getUser()->getId();
        $user = $this->entityManager->getRepository(User::class)->find($userId);
        $stationId = $user->getStation();


        return $this->entityManager->createQueryBuilder()
            ->select('s')
            ->from(Station::class, 's')
            ->where('s.id = :stationId')
            ->setParameter('stationId', $stationId);
    }



    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            ImageField::new('logo')
                ->setBasePath('uploads/stations')
                ->setUploadDir('public/uploads/stations')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/*'
                    ]
                ]),
            ImageField::new('image')
                ->setBasePath('uploads/stations')
                ->setUploadDir('public/uploads/stations')
                ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/*'
                    ]
                ]),
        ];
    }
}
