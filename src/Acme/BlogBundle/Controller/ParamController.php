<?php

namespace Acme\BlogBundle\Controller;

use Acme\BlogBundle\Form\ParamType;
use Acme\BlogBundle\Repository\ParamHandler;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Acme\BlogBundle\Entity\Param;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use A5sys\MantisApiBundle\MantisApiBundle;

use Opensoft\Tfs\Rest\Client;

class ParamController extends FOSRestController
{

    public function indexAction() {


       
        $client = new Client(
            // your tfs/vso
            'https://modistfs.visualstudio.com',
            // your collection
            '',
            // (optional) raw options to pass to guzzle (ntlm example here)
            [                                      
                'curl' => [
                    CURLOPT_HTTPAUTH => CURLAUTH_BASIC, 
                    CURLOPT_USERPWD => 'quentinbogoss58@hotmail.fr:MC724exp'
                ]
            ]
        );

        // retrieve a work item by its ID
        $response = $client->workItemTracking()->getWorkItemTypeCategory('ae6e65cb-31c0-4faa-9cb6-055065123742');

         
      

        // follow hypermedia links
        //$response = $response->follow('workItemHistory');

        print_r($response);
 
         return $this->render('AcmeBlogBundle::layout.html.twig');

        // $param = $this->container->get('mantis_api_bundle.service.mantis_client');
       // $param->callAuthenticatedWs('getIssue', array('issueId' => 1));
       //  print_r($param);
         //
   
    }

    /**
     * @Annotations\View( templateVar="params" )
     *
     * @return Param
     */
    public function getParamsAction()
    {
        /** @var ParamHandler $paramHandler */
        $paramHandler = $this->container->get('acme_blog.param.handler');

        /** @var array $params */
        $params = $paramHandler->getAll();
        return $params;
    }

    /**
     * @Annotations\View(templateVar="param")
     *
     * @param $id
     * @return Param
     */
    public function getParamAction($id)
    {
        /** @var ParamHandler $paramHandler */
        $paramHandler = $this->container->get('acme_blog.param.handler');

        /** @var Param $param */
        $param = $paramHandler->get($id);

        return $param;
    }

    /**
     * @Annotations\View(templateVar="param")
     * @param int $id the param id
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function editParamAction($id)
    {
        /** @var ParamHandler $paramHandler */
        $paramHandler = $this->container->get('acme_blog.param.handler');

        /** @var Param $param */
        $param = $paramHandler->get($id);

        $form = $this->createForm(new ParamType(), $param);

        $view = $this->view($form, 200)
            ->setTemplate('AcmeBlogBundle:Param:editParam.html.twig')
            ->setTemplateVar('form')
        ;

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @param int $id the param id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postParamAction(Request $request, $id)
    {
        /** @var ParamHandler $paramHandler */
        $paramHandler = $this->container->get('acme_blog.param.handler');

        /** @var Param $param */
        $param = $paramHandler->get($id);

        $form = $this->createForm(new ParamType(), $param);

        $form->submit($request);
        if ($form->isValid()) {
            $paramHandler->save($param);
            $view = $this->routeRedirectView('api_get_param', ['id' => $param->getId()]);
        } else {
            $view = $this->view(['form' => $form], 400);
        }

        return $this->handleView($view);
    }

    /**
     * @param Request $request
     * @param int $id the param id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putParamAction(Request $request, $id)
    {
        /** @var ParamHandler $paramHandler */
        $paramHandler = $this->container->get('acme_blog.param.handler');

        /** @var Param $param */
        $param = $paramHandler->get($id);

        $form = $this->createForm(new ParamType(), $param);

        $form->submit($request);
        if ($form->isValid()) {
            $paramHandler->save($param);
            $view = $this->routeRedirectView('api_get_param', ['id' => $param->getId()]);
        } else {
            $view = $this->view(['form' => $form], 400);
        }

        return $this->handleView($view);
    }
}
