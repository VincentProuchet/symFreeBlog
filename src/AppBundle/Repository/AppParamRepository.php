<?php
namespace src\AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 *
 * @author Vincent
 *        
 */
class AppParamRepository extends EntityRepository
{

    /**
     *
     * @param EntityManager $em
     *            The EntityManager to use.
     * @param ClassMetadata $class
     *            The class descriptor.
     */
    public function __construct($em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }

    public function findByName($name = "")
    {
        $result = $this->getEntityManager()
            ->createQuery('SELECT p from AppBundle\ENtity\AppParam p WHERE p.name = :name ')
            ->setParameter([
            "name" => $name
        ])
            ->getResult();
        return $result;
    }
}

