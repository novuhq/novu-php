<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Blueprint;

trait ManagesBlueprints
{
    /**
     * Fetch list of blueprints [ Come back to this for pagination---->]
     *
     * @return Blueprint
     */
    public function getBlueprintsGroupByCategory(): Blueprint
    {
        $blueprints = $this->get("blueprints/group-by-category");
        return new Blueprint($blueprints, $this);
    }

    /**
     * Fetch blueprints by templateId
     *
     * @param string $templateId
     * @return Blueprint
     */
    public function getBlueprints(string $templateId): Blueprint
    {
        $blueprint = $this->get("blueprints/{$templateId}")['data'];
        return new Blueprint($blueprint, $this);
    }

}
