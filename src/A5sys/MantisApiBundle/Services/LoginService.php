<?php

namespace A5sys\MantisApiBundle\Services;

/**
 *
 * ref: mantis_api_bundle.service.project_version
 */
class LoginService extends AbstractService
{
    /**
     * Check if connection is OK
     * @param string $username
     * @param string $password
     * @return array isConnected
     */
    public function getLogin($username, $password)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_login';

        $params = [
            'username' => $username,
            'password' => $password
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }

    /**
     * Add version
     * @param int    $projectId
     * @param string $version   The version
     */
    public function addVersion($projectId, $version)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_project_version_add';

        $versionData = [
            'name' => $version,
            'project_id' => $projectId,
            'date_order' => null,
            'description' => '',
            'released' => false,
        ];

        $params = [
            'version' => $versionData,
        ];

        $client->callAuthenticatedWs($wsFunction, $params);
    }
}
