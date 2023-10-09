<?php

namespace Novu\SDK\Resources;

class Workflow extends Resource
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var boolean
     */
    public $active;

    /**
     * @var boolean
     */
    public $draft;

    /**
     * @var boolean
     */
    public $critical;

    /**
     * @var boolean
     */
    public $isBlueprint;

    /**
     * @var string
     */
    public $notificationGroupId;

    /**
     * @var array
     */
    public $tags;


    /**
     * @var array
     */
    public $triggers;


    /**
     * @var array
     */
    public $steps;


    /**
     * @var object
     */
    public $preferenceSettings;


    /**
     * @var string
     */
    public $environmentId;


    /**
     * @var string
     */
    public $organizationId;


    /**
     * @var string
     */
    public $creatorId;


    /**
     * @var bool
     */
    public $deleted;


    /**
     * @var string
     */
    public $createdAt;


    /**
     * @var string
     */
    public $updatedAt;


    /**
     * @var string
     */
    public $v;


    /**
     * @var array
     */
    public $notificationGroup;


    /**
     * @var array
     */
    public $workflowIntegrationStatus;


    public function toArray(): array
    {
        $publicProperties = get_object_vars($this);

        unset($publicProperties['attributes']);
        unset($publicProperties['novu']);

        return array_filter($publicProperties, function ($value) {
            return null !== $value;
        });
    }
}
