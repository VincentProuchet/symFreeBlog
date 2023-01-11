<?php
namespace AppBundle\Service\impl;

use AppBundle\Service\AppParamService;
use AppBundle\Entity\AppParam;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 *
 * @author Vincent
 *        
 */
class AppParamServiceImpl implements AppParamService
{
    private $em;
    private $paramRepo;
    

    /**
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->paramRepo = $entityManager->getRepository(AppParam::class);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\AppParamService::getParam()
     */
    public function getParam($name)
    {
        $result = $this->paramRepo->findOneByName($name);
        if(is_null($result)){
            throw new EntityNotFoundException(" param not found with name ".$name);
        }
        return $result;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\AppParamService::create()
     */
    public function create(AppParam $param)
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\AppParamService::update()
     */
    public function update(AppParam $param)
    {}

    /**
     * (non-PHPdoc)
     *
     * @see \AppBundle\Service\AppParamService::delete()
     */
    public function delete(AppParam $param)
    {}
}

