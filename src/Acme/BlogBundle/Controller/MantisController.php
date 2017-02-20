<?php

namespace Acme\BlogBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use A5sys\MantisApiBundle\MantisApiBundle;

class MantisController extends FOSRestController
{


    public function getLoginAction($username, $password) {

        $client = $this->container->get('mantis_api_bundle.service.login');
         //$functions = $client->__getFunctions ();
        //var_dump ($functions);
        
        return $client->getLogin($username, $password);

    }

    public function updateIssueAction($issueId, $issueData) {

        $client = $this->container->get('mantis_api_bundle.service.issue');
        return $client->updateIssue($issueId, $issueData);
    }


    public function getIssueAction($issueId) {

        $client = $this->container->get('mantis_api_bundle.service.issue');
        return $client->getIssue($issueId);
    }

    public function getProjectsAction($issueId) {

        $client = $this->container->get('mantis_api_bundle.service.project');
        return $client->getIssue($issueId);
    }


    /**
     * Get the priorities
     * @param string $username
     * @param string $password
     * @return array The priorities
     */
    public function getPrioritiesAction($username, $password) {

        $client = $this->container->get('mantis_api_bundle.service.project');
        return $client->getPriorities($username, $password);
    }



    /**
     * Get the categories
     * @param string $username
     * @param string $password
     * @param int $projectId
     * @return array The categories
     */
    public function getCategoriesAction($username, $password, $projectId) {

        $client = $this->container->get('mantis_api_bundle.service.project');
        return $client->getCategories($username, $password, $projectId);
    }


    /**
     * Get the severities
     * @param string $username
     * @param string $password
     * @return array The severities
     */
    public function getSeveritiesAction($username, $password) {

        $client = $this->container->get('mantis_api_bundle.service.project');
        return $client->getSeverities($username, $password);
    }


    /**
     * Get the statuses
     * @param string $username
     * @param string $password
     * @return array The statuses
     */
    public function getStatusesAction($username, $password) {

        $client = $this->container->get('mantis_api_bundle.service.project');
        return $client->getStatuses($username, $password);
    }


    /**
     * Get the resolutions
     * @param string $username
     * @param string $password
     * @return array The resolutions
     */
    public function getResolutionsAction($username, $password) {

        $client = $this->container->get('mantis_api_bundle.service.project');
        return $client->getResolutions($username, $password);
    }


    /**
     * Get the workflow of statuses
     * @param int $projectId
     * @return array The workflow of statuses
     */
    public function getWorkflowAction($projectId) {

        $client = $this->container->get('mantis_api_bundle.service.project');
        return $client->getWorkflow($projectId);
    }


    /**
     * Get the workflow of statuses
     * @param int $userId
     * @param int $projectId
     * @return array The workflow of statuses
     */
    public function getAccessLevelAction($userId, $projectId) {

        $client = $this->container->get('mantis_api_bundle.service.user');
        return $client->getAccessLevel($userId, $projectId);
    }



    /**
     * Get issue
     *
     * @param int $issueId
     * @return array the issue data
     */
    public function getIssueAction($issueId)
    {
        $client = $this->container->get('mantis_api_bundle.service.issue');
        return $client->getIssue($issueId);
    }


    /**
     * Update issue
     *
     * @param int $issueId
     * @param []  $issueData
     * @return array the issue data
     */
    public function updateIssueAction($issueId, $issueData)
    {
        $client = $this->container->get('mantis_api_bundle.service.issue');
        return $client->updateIssue($issueId, $issueData);
    }

}
