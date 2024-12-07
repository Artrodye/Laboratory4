<?php

namespace app\repository;

use app\entity\TextEntity;
use Doctrine\ORM\EntityRepository;

/**
 * @method TextEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method TextEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method TextEntity[] findAll()
 * @method TextEntity[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */


class TextEntityRepository extends EntityRepository
{
}