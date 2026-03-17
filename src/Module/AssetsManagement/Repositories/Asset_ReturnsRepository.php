<?php

namespace Modules\AssetsManagement\Repositories;

use Modules\AssetsManagement\Entities\Asset_Returns;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_ReturnsRepositoryInterface;

class Asset_ReturnsRepository implements Asset_ReturnsRepositoryInterface
{
    public function getAll($perPage, $search)
    {
        if (!empty($search)) {
            return Asset_Returns::with(['Asset_Assignments', ])->get();
        }

        return Asset_Returns::with(['Asset_Assignments', ])->paginate($perPage);
    }

    public function findById($id)
    {
        return Asset_Returns::with(['Asset_Assignments', ])->find($id);
    }

    public function create(array $data)
    {
        return Asset_Returns::create($data);
    }

    public function update($id, array $data)
    {
        $record = Asset_Returns::find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $record = Asset_Returns::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}

