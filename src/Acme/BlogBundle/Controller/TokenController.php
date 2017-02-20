<?php
/**
 * Created by PhpStorm.
 * User: R
 * Date: 2015-09-28
 * Time: 16:29
 */

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Form\TokenType;
use Acme\BlogBundle\Repository\TokenHandler;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Acme\BlogBundle\Entity\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TokenController extends FOSRestController
{

    /**
     * @Annotations\View( templateVar="tokens" )
     *
     * @return Token
     */
    public function getTokensAction()
    {
        /** @var TokenHandler $tokenHandler */
        $tokenHandler = $this->container->get('acme_blog.token.handler');

        /** @var array $tokens */
        $tokens = $tokenHandler->getAll();
        return $tokens;
    }

    /**
     * @Annotations\View(templateVar="token")
     *
     * @param $id
     * @return Token
     */
    public function getTokenAction($id)
    {
        /** @var TokenHandler $tokenHandler */
        $tokenHandler = $this->container->get('acme_blog.token.handler');

        /** @var Token $token */
        $token = $tokenHandler->get($id);

        return $token;
    }

    /**
     * @Annotations\View(templateVar="token")
     * @param int $id the token id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function editTokenAction($id)
    {
        /** @var TokenHandler $tokenHandler */
        $tokenHandler = $this->container->get('acme_blog.token.handler');

        /** @var Token $token */
        $token = $tokenHandler->get($id);

        $form = $this->createForm(new TokenType(), $token);

        $view = $this->view($form, 200)
            ->setTemplate('AcmeBlogBundle:Token:editToken.html.twig')
            ->setTemplateVar('form')
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @param int $id the token id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postTokenAction(Request $request, $id)
    {
        /** @var TokenHandler $tokenHandler */
        $tokenHandler = $this->container->get('acme_blog.token.handler');

        /** @var Token $token */
        $token = $tokenHandler->get($id);

        $form = $this->createForm(new TokenType(), $token);

        $form->submit($request);
        if ($form->isValid()) {
            $tokenHandler->save($token);
            $view = $this->routeRedirectView('api_get_token', ['id' => $token->getId()]);
        } else {
            $view = $this->view(['form' => $form], 400);
        }

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @param int $id the token id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putTokenAction(Request $request, $id)
    {
        /** @var TokenHandler $tokenHandler */
        $tokenHandler = $this->container->get('acme_blog.token.handler');

        /** @var Token $token */
        $token = $tokenHandler->get($id);

        $form = $this->createForm(new TokenType(), $token);

        $form->submit($request);
        if ($form->isValid()) {
            $tokenHandler->save($token);
            $view = $this->routeRedirectView('api_get_token', ['id' => $token->getId()]);
        } else {
            $view = $this->view(['form' => $form], 400);
        }

        return $this->handleView($view);
    }
}
