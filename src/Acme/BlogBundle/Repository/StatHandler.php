<?php

namespace Acme\BlogBundle\Repository;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StatHandler
{
    private $repository;
    /**
     * @var $em EntityManager
     */
    private $em;

    public function __construct(EntityManager $em, $entityClass)
    {
        $this->repository = $em->getRepository($entityClass);
        $this->em = $em;
    }

    public function get($id)
    {
        $stat = $this->repository->find($id);

        if(!$stat) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        } else {
            return $stat;
        }
    }

    public function getAll()
    {
        $stats = $this->repository->findAll();

        if(!$stats) {
            throw new NotFoundHttpException(sprintf('The resources were not found.'));
        } else {
            return $stats;
        }
    }

    public function save($stat)
    {
        $this->em->persist($stat);
        $this->em->flush();
    }

}
