<?php

namespace App\Repository;

use App\Entity\Operation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Operation>
 *
 * @method Operation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Operation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Operation[]    findAll()
 * @method Operation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operation::class);
    }

    public function add(Operation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Operation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOperationTerminee()
    {
        $terminee = $this->findBy(
            ['statut' => 'T']
        );
        return $terminee;
    }

    public function findOperationEncours()
    {
        $encours = $this->findBy(
            ['statut' => 'C']
        );
        return $encours;
    }

    public function findOneOperation(int $id)
    {
        $operation = $this->findBy(
            ['id' => $id ]
        );
        return $operation;
    }


    public function NombreOperationEncours()
    {
        $encours = $this->findBy(
            ['statut' => 'C']
        );
        return count($encours);
    }

}
