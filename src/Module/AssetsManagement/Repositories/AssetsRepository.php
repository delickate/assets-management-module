<?php

namespace Modules\AssetsManagement\Repositories;

use Modules\AssetsManagement\Entities\Assets;
use Modules\AssetsManagement\Repositories\Interfaces\AssetsRepositoryInterface;

class AssetsRepository implements AssetsRepositoryInterface
{
    public function getAll($perPage, $search)
    {
        if (!empty($search)) {
            return Assets::with(['Vendors', 'Locations', 'Asset_Types', ])->get();
        }

        return Assets::with(['Vendors', 'Locations', 'Asset_Types', ])->paginate($perPage);
    }

    public function findById($id)
    {
        return Assets::with(['Vendors', 'Locations', 'Asset_Types', ])->find($id);
    }

    public function create(array $data)
    {
        return Assets::create($data);
    }

    public function update($id, array $data)
    {
        $record = Assets::find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $record = Assets::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}

