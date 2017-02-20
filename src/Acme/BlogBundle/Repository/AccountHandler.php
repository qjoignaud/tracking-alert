<?php

namespace Acme\BlogBundle\Repository;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountHandler
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
        $account = $this->repository->find($id);

        if(!$account) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        } else {
            return $param;
        }
    }

    public function getAll()
    {
        $accounts = $this->repository->findAll();

        if(!$accounts) {
            throw new NotFoundHttpException(sprintf('The resources were not found.'));
        } else {
            return $accounts;
        }
    }

    public function save($account)
    {
        $this->em->persist($account);
        $this->em->flush();
    }

}
