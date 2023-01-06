<?php

namespace Novu\SDK\Resources;

use Novu\SDK\Novu;

class Resource
{
    /**
     * The resource attributes.
     *
     * @var array
     */
    public $attributes;

    /**
     * The Novu SDK instance.
     *
     * @var \Novu\SDK\Novu|null
     */
    protected $novu;

    /**
     * Create a new resource instance.
     *
     * @param  array  $attributes
     * @param  \Novu\SDK\Novu|null  $novu
     * @return void
     */
    public function __construct(array $attributes, Novu $novu = null)
    {
        $this->attributes = $attributes;
        $this->novu = $novu;

        $this->fill();
    }

    /**
     * Fill the resource with the array of attributes.
     *
     * @return void
     */
    protected function fill()
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);

            $this->{$key} = $value;
        }
    }

    /**
     * Convert the key name to camel case.
     *
     * @param  string  $key
     * @return string
     */
    protected function camelCase($key)
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = lcfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }

    /**
     * Transform the collection of tags to a string.
     *
     * @param  array  $tags
     * @param  string|null  $separator
     * @return string
     */
    protected function transformTags(array $tags, $separator = null)
    {
        $separator = $separator ?: ', ';

        return implode($separator, array_column($tags ?? [], 'name'));
    }

    public function toArray(): array
    {
        $publicProperties = get_object_vars($this);
        unset($publicProperties['attributes']);
        unset($publicProperties['novu']);

        return $publicProperties;
    }

}