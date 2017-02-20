
<?php

namespace Acme\BlogBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Opensoft\Tfs\Rest\Client;

class MantisController extends FOSRestController
{

 /**
     * appel API REST TFS 
     * 
     * @param string $method    : GET, POST, PUT, PATCH
     * @param string $url : url du web service
     * 
     * @return boolean
     */

    function callAPI($method, $url)
    {
        $data = array();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);



        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;

            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;

            case "PATCH": 

                $headers = array('Content-Type: application/json-patch+json');

                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');   
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);     
                                      
                break;

            default:
                if ($this->_data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));

        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $this->getLogin().":".$this->getPassword());

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);


        return $result;   
    }


    /**
     * Connexion au Bug Tracker TFS 
     * 
     * @param string $bt_login    : login bug tracker de l'utilisateur
     * @param string $bt_password : mot de passe bug tracker de l'utilisateur
     * 
     * @return boolean
     */
    function connection($login, $password)
    {   
        $this->setLogin($login);
        $this->setPassword($password);

        $connection = $this->callAPI('GET', 'https://modistfs.visualstudio.com/DefaultCollection/_apis/profile/profiles/me?api-version=1.0');
        
        if($this->isJson($connection)) {
            $connection = json_decode($connection);
            if(!empty($connection->emailAddress)) {
                return  $connection;

            } else {
                return 'error';
            }

        }  else {
            return 'error';
        } 

    } 


    function testAction() {


        $client = new Client(
            // your tfs/vso
            'https://modistfs.visualstudio.com',
            // your collection
            'DefaultCollection',
            // (optional) raw options to pass to guzzle (ntlm example here)
            [                                      
                'curl' => [
                    CURLOPT_HTTPAUTH => CURLAUTH_NTLM, 
                    CURLOPT_USERPWD => 'quentinbogoss58@hotmail.fr:MC724exp'
                ]
            ]
        );

        // retrieve a work item by its ID
        $response = $client->workItemTracking()->getWorkItem(131);

        // get the result as an array
        print_r($response->asArray());

        // follow hypermedia links
        //$response = $response->follow('workItemHistory');

        //print_r($response->asArray());
    }



}
