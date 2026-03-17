<?php

namespace Modules\AssetsManagement\Repositories;

use Modules\AssetsManagement\Entities\Asset_Types;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_TypesRepositoryInterface;

class Asset_TypesRepository implements Asset_TypesRepositoryInterface
{
    public function getAll($perPage, $search)
    {
        if (!empty($search)) {
            return Asset_Types::with([])->get();
        }

        return Asset_Types::with([])->paginate($perPage);
    }

    public function findById($id)
    {
        return Asset_Types::with([])->find($id);
    }

    public function create(array $data)
    {
        return Asset_Types::create($data);
    }

    public function update($id, array $data)
    {
        $record = Asset_Types::find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $record = Asset_Types::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}

