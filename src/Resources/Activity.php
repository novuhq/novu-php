<?php

namespace Novu\SDK\Resources;

class Activity extends Resource
{

    public function __construct(

        /**
         * The internal id Novu generated for the activity graph stats.
         *
         * @var string
         */
        private readonly string $id,
    
        /**
         * The number of stats
         *
         * @var int
         */
        private readonly int $count
        )
    {}

    /**
     * Gets the internal id Novu generated for the activity graph stats
     * 
     * @var string
     */
    public function getId(): string {
        return $this->id;
    }

    
    /**
     * Gets number of stats
     * 
     * @var string
     */
    public function getCount(): int {
        return $this->count;
    }

    /**
     * Return the array form of Activity object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "count" => $this->count
        ];
    }
}