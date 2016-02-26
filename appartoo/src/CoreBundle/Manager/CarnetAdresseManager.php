<?php
/**
 * Created by PhpStorm.
 * User: liu
 * Date: 25/02/16
 * Time: 21:23
 */

namespace CoreBundle\Manager;
use Doctrine\ORM\EntityManager;

class CarnetAdresseManager extends BaseManager
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function remove($id)
    {
        $tweet = $this->getRepository()->find($id);
        $this->entityManager->remove($tweet);
        $this->entityManager->flush();
    }

    public function getRepository()
    {
        return $this->entityManager->getRepository('CoreBundle:CarnetAdresse');
    }
}