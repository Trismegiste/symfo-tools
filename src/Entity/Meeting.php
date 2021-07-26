<?php

/*
 * Vesta
 */

namespace App\Entity;

use Trismegiste\Toolbox\MongoDb\Root;
use Trismegiste\Toolbox\MongoDb\RootImpl;

/**
 * Generic class of a meeting between users at a location and an date
 */
abstract class Meeting implements Root
{

    use RootImpl;

    protected $location;
    protected $rdvTime;

    public function __construct(Address $loc, int $ts)
    {
        $this->location = $loc;
        $this->rdvTime = $ts;
    }

}