<?php

namespace CoreBundle\Manager;
use Doctrine\ORM\EntityManager;
use CoreBundle\Manager\BaseManager;

class UserManager extends BaseManager
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function getRepository()
    {
        return $this->entityManager->getRepository('CoreBundle:User');
    }

}