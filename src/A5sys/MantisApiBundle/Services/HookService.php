<?php

namespace A5sys\MantisApiBundle\Services;

/**
 *
 * ref: mantis_api_bundle.service.version
 */
class HookService extends AbstractService
{
    /**
     * Get the version
     *
     * @return string The version
     */
    public function getHook()
    {

        return  array(
            "handler_id" => "Assigné à",
            "priority" => "Priorité",
            "category" => "Catégorie",
            "status" => "Statut",
            "severity" => "Impact",
            "resolution" => "Résolution",
            "summary" => "Résumé",
            "note" => "Note"
        );


    }
}
