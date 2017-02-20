<?php

namespace A5sys\MantisApiBundle\Services;

/**
 *
 * ref: mantis_api_bundle.service.project_version
 */
class ProjectService extends AbstractService
{
    /**
     * Get the projects
     * @param string $username
     * @param string $password
     * @return array The projects
     */
    public function getProjects($username, $password)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_project_get_user_accessible';

        $params = [
            'username' => $username,
            'password' => $password
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }


    /**
     * Get the projects
     * @param int $projectId
     * @return string The project name
     */
    public function getProjectById($projectId)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_get_project_name_by_id';

        $params = [
            'project_id' => $projectId
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }


    /**
     * Get the priorities
     * @param string $username
     * @param string $password
     * @return array The priorities
     */
    public function getPriorities($username, $password)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_enum_priorities';

        $params = [
            'username' => $username,
            'password' => $password
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }


    /**
     * Get the categories
     * @param string $username
     * @param string $password
     * @param int $projectId
     * @return array The categories
     */
    public function getCategories($username, $password, $projectId)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_project_get_categories';

        $params = [
            'username' => $username,
            'password' => $password,
            'project_id' => $projectId
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }

    /**
     * Get the severities
     * @param string $username
     * @param string $password
     * @return array The severities
     */
    public function getSeverities($username, $password)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_enum_severities';

        $params = [
            'username' => $username,
            'password' => $password
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }


    /**
     * Get the statuses
     * @param string $username
     * @param string $password
     * @return array The statuses
     */
    public function getStatuses($username, $password)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_enum_status';

        $params = [
            'username' => $username,
            'password' => $password
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }

    /** Get the resolutions
     * @param string $username
     * @param string $password
     * @return array The resolutions
     */
    public function getResolutions($username, $password)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_enum_resolutions';

        $params = [
            'username' => $username,
            'password' => $password
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }


    /**
     * Get the statuses
     * @param int $projectId
     * @return array The statuses
     */
    public function getWorkflow($projectId)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_issue_get_status_enum_workflow';

        $params = [
            'project_id' => $projectId
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }







}
