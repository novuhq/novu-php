<?php

namespace Novu\SDK\Resources;

class NotificationStats extends Resource
{
    /**
     * The weekly sent count
     *
     * @var integer
     */
    public $weeklySent;

    /**
     * The monthly sent count
     *
     * @var integer
     */
    public $monthlySent;

    /**
     * The yearly sent count
     *
     * @var integer
     */
    public $yearlySent;

    /**
     * Return the array form of Notification Stats object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'weeklySent' => $this->weeklySent,
            'monthlySent' => $this->monthlySent,
            'yearlySent' => $this->yearlySent,
        ];
    }
}