<?php

namespace Novu\SDK\Resources;

class Blueprint extends Resource
{
    /**
     * The internal templateId Novu generated for the template.
     *
     * @var string
     */
    public string $templateId;

    /**
     * Return the array form of Blueprint object & strip out all null fields.
     *
     * @return array
     */
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
