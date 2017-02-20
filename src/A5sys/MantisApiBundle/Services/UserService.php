<?php

namespace A5sys\MantisApiBundle\Services;

/**
 *
 * ref: mantis_api_bundle.service.project_version
 */
class UserService extends AbstractService
{


    /**
     * Get the users of projects
     * @param int $projectId
     * @return array The users
     */
    public function getUsers($projectId)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_project_get_user_accessible';

        $params = [
            'project_id' => $projectId
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }

    /**
     * Get the username
     * @param int $userId
     * @return string The username
     */
    public function getUsername($userId)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_get_user_name_by_id';

        $params = [
            'user_id' => $userId,
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }

    /**
     * Get the user id
     * @param int $username
     * @return string The user id
     */
    public function getUserId($username)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_get_id_by_user_name';

        $params = [
            'username' => $username,
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }


    /**
     * Get the access level of user
     * @param int $userId
     * @param int $projectId
     * @return int The access level
     */
    public function getAccessLevel($userId, $projectId)
    {
        $client = $this->getClientService();
        $wsFunction = 'mc_get_access_level_by_id';

        $params = [
            'user_id' => $userId,
            'project_id' => $projectId
        ];

        return $client->callAuthenticatedWs($wsFunction, $params);
    }




   


}
