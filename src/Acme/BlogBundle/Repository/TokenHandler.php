<?php

namespace Acme\BlogBundle\Repository;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TokenHandler
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
        $token = $this->repository->find($id);

        if(!$token) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.', $id));
        } else {
            return $token;
        }
    }

    public function getAll()
    {
        $tokens = $this->repository->findAll();

        if(!$tokens) {
            throw new NotFoundHttpException(sprintf('The resources were not found.'));
        } else {
            return $tokens;
        }
    }

    public function save($token)
    {
        $this->em->persist($token);
        $this->em->flush();
    }

}
