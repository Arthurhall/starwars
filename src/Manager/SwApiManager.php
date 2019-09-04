<?php

namespace App\Manager;

use App\Endpoint\CharactersEndpoint;
use App\Endpoint\FilmsEndpoint;
use App\Endpoint\PlanetsEndpoint;
use App\Endpoint\SpeciesEndpoint;
use App\Endpoint\StarshipsEndpoint;
use App\Endpoint\VehiclesEndpoint;

class SwApiManager
{
    /**
     * @var CharactersEndpoint
     */
    private $charactersEndpoint;

    /**
     * @var FilmsEndpoint
     */
    private $filmsEndpoint;

    /**
     * @var PlanetsEndpoint
     */
    private $planetsEndpoint;

    /**
     * @var SpeciesEndpoint
     */
    private $speciesEndpoint;

    /**
     * @var StarshipsEndpoint
     */
    private $starshipsEndpoint;

    /**
     * @var VehiclesEndpoint
     */
    private $vehiclesEndpoint;

    /**
     * @param CharactersEndpoint $charactersEndpoint
     * @param FilmsEndpoint $filmsEndpoint
     * @param PlanetsEndpoint $planetsEndpoint
     * @param SpeciesEndpoint $speciesEndpoint
     * @param StarshipsEndpoint $starshipsEndpoint
     * @param VehiclesEndpoint $vehiclesEndpoint
     */
    public function __construct(
        CharactersEndpoint $charactersEndpoint,
        FilmsEndpoint $filmsEndpoint,
        PlanetsEndpoint $planetsEndpoint,
        SpeciesEndpoint $speciesEndpoint,
        StarshipsEndpoint $starshipsEndpoint,
        VehiclesEndpoint $vehiclesEndpoint
    ) {
        $this->charactersEndpoint = $charactersEndpoint;
        $this->filmsEndpoint = $filmsEndpoint;
        $this->planetsEndpoint = $planetsEndpoint;
        $this->speciesEndpoint = $speciesEndpoint;
        $this->starshipsEndpoint = $starshipsEndpoint;
        $this->vehiclesEndpoint = $vehiclesEndpoint;
    }

    public function characters(): CharactersEndpoint
    {
        return $this->charactersEndpoint;
    }

    public function films(): FilmsEndpoint
    {
        return $this->filmsEndpoint;
    }

    public function planets(): PlanetsEndpoint
    {
        return $this->planetsEndpoint;
    }

    public function species()
    {
        return $this->speciesEndpoint;
    }

    public function starships()
    {
        return $this->starshipsEndpoint;
    }

    public function vehicles()
    {
        return $this->vehiclesEndpoint;
    }
}
