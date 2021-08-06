<?php

/*
 * Vesta
 */

namespace App\Entity;

/**
 * Description of a building
 */
class Building
{

    public $name; // the name of the building
    public $district;
    public $floor; // how many floors ?
    public $heating;  // heating system
    public $coownership;
    public $alotAmount;  // how many alotment in the building
    public $hotWater; // hot water system
    public $standing;  // the standing of the building
    public $security; // security system for the building
    public $construction; // construction type
    public $facelift; // date of the last facelist (null if unknown)
    public $informationFlag; // some optional flags for this building

}
