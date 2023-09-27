<?php

namespace Novu\SDK\Resources;

class NotificationStats extends Resource
{
    /**
     * The weekly sent count.
     *
     * @var int
     */
    public $weeklySent;

    /**
     * The monthly sent count.
     *
     * @var int
     */
    public $monthlySent;

    /**
     * The yearly sent count.
     *
     * @var int
     */
    public $yearlySent;

    /**
     * Return the array form of Notification Stats object.
     */
    public function toArray(): array
    {
        return [
            'weeklySent'  => $this->weeklySent,
            'monthlySent' => $this->monthlySent,
            'yearlySent'  => $this->yearlySent,
        ];
    }
}
