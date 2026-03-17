<?php

namespace Modules\AssetsManagement\Repositories;

use Modules\AssetsManagement\Entities\Locations;
use Modules\AssetsManagement\Repositories\Interfaces\LocationsRepositoryInterface;

class LocationsRepository implements LocationsRepositoryInterface
{
    public function getAll($perPage, $search)
    {
        if (!empty($search)) {
            return Locations::with([])->get();
        }

        return Locations::with([])->paginate($perPage);
    }

    public function findById($id)
    {
        return Locations::with([])->find($id);
    }

    public function create(array $data)
    {
        return Locations::create($data);
    }

    public function update($id, array $data)
    {
        $record = Locations::find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $record = Locations::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}

