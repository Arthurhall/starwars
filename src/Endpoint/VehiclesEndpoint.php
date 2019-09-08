<?php

namespace App\Endpoint;

use App\Model\Vehicle;

class VehiclesEndpoint extends AbstractEndpoint
{
    public function index($page = 1)
    {
        $response = $this->client->getVehicles($page);

        return $this->hydrateMany($response, Vehicle::class, $page);
    }

    public function get($id)
    {
        $response = $this->client->getVehicle($this->parseId($id));

        return $this->hydrateOne($response, Vehicle::class);
    }
}
