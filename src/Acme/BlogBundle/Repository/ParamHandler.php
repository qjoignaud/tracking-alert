<?php

namespace Acme\BlogBundle\Repository;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ParamHandler
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
        $param = $this->repository->find($id);

        if(!$param) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        } else {
            return $param;
        }
    }

    public function getAll()
    {
        $params = $this->repository->findAll();

        if(!$params) {
            throw new NotFoundHttpException(sprintf('The resources were not found.'));
        } else {
            return $params;
        }
    }

    public function save($param)
    {
        $this->em->persist($param);
        $this->em->flush();
    }

}
