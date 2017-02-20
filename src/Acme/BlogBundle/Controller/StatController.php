<?php
/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:29
 */

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Form\StatType;
use Acme\BlogBundle\Repository\StatHandler;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Acme\BlogBundle\Entity\Stat;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StatController extends FOSRestController
{

    /**
     * @Annotations\View( templateVar="stats" )
     *
     * @return Stat
     */
    public function getStatsAction()
    {
        /** @var StatHandler $statHandler */
        $statHandler = $this->container->get('acme_blog.stat.handler');

        /** @var array $stats */
        $stats = $statHandler->getAll();
        return $stats;
    }

    /**
     * @Annotations\View(templateVar="stat")
     *
     * @param $id
     * @return Stat
     */
    public function getStatAction($id)
    {
        /** @var StatHandler $statHandler */
        $statHandler = $this->container->get('acme_blog.stat.handler');

        /** @var Stat $stat */
        $stat = $statHandler->get($id);

        return $stat;
    }

    /**
     * @Annotations\View(templateVar="stat")
     * @param int $id the stat id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function editStatAction($id)
    {
        /** @var StatHandler $statHandler */
        $statHandler = $this->container->get('acme_blog.stat.handler');

        /** @var Stat $stat */
        $stat = $statHandler->get($id);

        $form = $this->createForm(new StatType(), $stat);

        $view = $this->view($form, 200)
            ->setTemplate('AcmeBlogBundle:Stat:editStat.html.twig')
            ->setTemplateVar('form')
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @param int $id the stat id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postStatAction(Request $request, $id)
    {
        /** @var StatHandler $statHandler */
        $statHandler = $this->container->get('acme_blog.stat.handler');

        /** @var Stat $stat */
        $stat = $statHandler->get($id);

        $form = $this->createForm(new StatType(), $stat);

        $form->submit($request);
        if ($form->isValid()) {
            $statHandler->save($stat);
            $view = $this->routeRedirectView('api_get_stat', ['id' => $stat->getId()]);
        } else {
            $view = $this->view(['form' => $form], 400);
        }

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @param int $id the stat id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putStatAction(Request $request, $id)
    {
        /** @var StatHandler $statHandler */
        $statHandler = $this->container->get('acme_blog.stat.handler');

        /** @var Stat $stat */
        $stat = $statHandler->get($id);

        $form = $this->createForm(new StatType(), $stat);

        $form->submit($request);
        if ($form->isValid()) {
            $statHandler->save($stat);
            $view = $this->routeRedirectView('api_get_stat', ['id' => $stat->getId()]);
        } else {
            $view = $this->view(['form' => $form], 400);
        }

        return $this->handleView($view);
    }
}
