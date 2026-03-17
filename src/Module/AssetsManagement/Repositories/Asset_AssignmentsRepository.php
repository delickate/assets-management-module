<?php

namespace Modules\AssetsManagement\Repositories;

use Modules\AssetsManagement\Entities\Asset_Assignments;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_AssignmentsRepositoryInterface;

class Asset_AssignmentsRepository implements Asset_AssignmentsRepositoryInterface
{
    public function getAll($perPage, $search)
    {
        if (!empty($search)) {
            return Asset_Assignments::with(['Assets', 'Asset_Types', ])->get();
        }

        return Asset_Assignments::with(['Assets', 'Asset_Types', ])->paginate($perPage);
    }

    public function findById($id)
    {
        return Asset_Assignments::with(['Assets', 'Asset_Types', ])->find($id);
    }

    public function create(array $data)
    {
        return Asset_Assignments::create($data);
    }

    public function update($id, array $data)
    {
        $record = Asset_Assignments::find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $record = Asset_Assignments::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}

