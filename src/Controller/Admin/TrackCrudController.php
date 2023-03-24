<?php

namespace App\Controller\Admin;

use App\Entity\Track;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use Symfony\Bundle\SecurityBundle\Security;

class TrackCrudController extends AbstractCrudController
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
        return Track::class;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $userId = $this->security->getUser()->getId();
        $user = $this->entityManager->getRepository(User::class)->find($userId);
        $stationId = $user->getStation();

        return $this->entityManager->createQueryBuilder()
            ->select('t')
            ->from(Track::class, 't')
            ->where('t.station = :stationId')
            ->setParameter('stationId', $stationId);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TimeField::new('opening'),
            TimeField::new('closing'),
            BooleanField::new('forced_closure'),
            TextField::new('message'),
            AssociationField::new('station'),
            AssociationField::new('difficulty'),
            AssociationField::new('level')->hideOnIndex(),
            AssociationField::new('material')->hideOnIndex(),
            AssociationField::new('clutter')
        ];
    }
}
