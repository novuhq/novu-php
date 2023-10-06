<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Layout;

trait ManagesLayout
{
    /**
     * Filter Layouts
     *
     * @param array $queryParams
     * @return mixed
     */
    public function filterLayouts(array $queryParams = [])
    {
        $layouts = $this->get("layouts", $queryParams);
        $layouts['data'] = array_map(fn($value) => new Layout($value, $this), $layouts['data']);

        return $layouts;
    }

    /**
     * Create a Layout
     * 
     * @param array $bodyParams
     * @return \Novu\SDK\Resources\Layout
     */
    public function createLayout(array $bodyParams)
    {
        $layout = $this->post("layouts", $bodyParams)['data'];
        
        return new Layout($layout, $this);
    }

    /**
     * Get a Layout by its ID
     * 
     * @param string $layoutId
     * @return \Novu\SDK\Resources\Layout
     */
    public function getLayout(string $layoutId)
    {
        $layout = $this->get("layouts/$layoutId");
        
        return new Layout($layout, $this);
    }

    /**
     * Soft delete a layout by its ID.
     * 
     * @param string $layoutId
     * @return bool|string
     */
    public function deleteLayout(string $layoutId)
    {
        return $this->delete("layouts/$layoutId");
    }

    /**
     * Update a layout
     * Update the name, content, description, identifier and variables of a layout. 
     * 
     * @param string $layoutId
     * @param array $bodyParams
     * @return \Novu\SDK\Resources\Layout
     */
    public function updateLayout(string $layoutId, array $bodyParams)
    {
        $layout = $this->patch("layouts/$layoutId", $bodyParams)['data'];
        
        return new Layout($layout, $this);
    }

    /**
     * Set Layout as default
     * Sets the default layout for the environment and updates to non default to the existing default layout (if any)
     * 
     * @param string $layoutId
     * @return bool|string
     */
    public function setLayoutAsDefault(string $layoutId)
    {
        return $this->post("layouts/$layoutId");;
    }
}