<?php


namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Form\AccountType;
use Acme\BlogBundle\Repository\AccountHandler;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Acme\BlogBundle\Entity\Account;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountController extends FOSRestController
{

    /**
     * @Annotations\View( templateVar="accounts" )
     *
     * @return Account
     */
    public function getAccountsAction()
    {
        /** @var AccountHandler $accountHandler */
        $accountHandler = $this->container->get('acme_blog.account.handler');

        /** @var array $accounts */
        $accounts = $accountHandler->getAll();
        return $accounts;
    }

    /**
     * @Annotations\View(templateVar="account")
     *
     * @param $id
     * @return Account
     */
    public function getAccountAction($id)
    {
        /** @var AccountHandler $accountHandler */
        $accountHandler = $this->container->get('acme_blog.account.handler');

        /** @var Account $account */
        $account = $accountHandler->get($id);

        return $account;
    }

    /**
     * @Annotations\View(templateVar="account")
     * @param int $id the account id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function editAccountAction($id)
    {
        /** @var AccountHandler $accountHandler */
        $accountHandler = $this->container->get('acme_blog.account.handler');

        /** @var Account $account */
        $account = $accountHandler->get($id);

        $form = $this->createForm(new AccountType(), $account);

        $view = $this->view($form, 200)
            ->setTemplate('AcmeBlogBundle:Account:editAccount.html.twig')
            ->setTemplateVar('form')
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @param int $id the account id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postAccountAction(Request $request, $id)
    {
        /** @var AccountHandler $accountHandler */
        $accountHandler = $this->container->get('acme_blog.account.handler');

        /** @var Account $account */
        $account = $accountHandler->get($id);

        $form = $this->createForm(new AccountType(), $account);

        $form->submit($request);
        if ($form->isValid()) {
            $accountHandler->save($account);
            $view = $this->routeRedirectView('api_get_account', ['id' => $account->getId()]);
        } else {
            $view = $this->view(['form' => $form], 400);
        }

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @param int $id the account id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putAccountAction(Request $request, $id)
    {
        /** @var AccountHandler $accountHandler */
        $accountHandler = $this->container->get('acme_blog.account.handler');

        /** @var Account $account */
        $account = $accountHandler->get($id);

        $form = $this->createForm(new AccountType(), $account);

        $form->submit($request);
        if ($form->isValid()) {
            $accountHandler->save($account);
            $view = $this->routeRedirectView('api_get_account', ['id' => $account->getId()]);
        } else {
            $view = $this->view(['form' => $form], 400);
        }

        return $this->handleView($view);
    }
}
