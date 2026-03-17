<?php

namespace Modules\AssetsManagement\Repositories;

use Modules\AssetsManagement\Entities\Asset_Maintenance;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_MaintenanceRepositoryInterface;

class Asset_MaintenanceRepository implements Asset_MaintenanceRepositoryInterface
{
    public function getAll($perPage, $search)
    {
        if (!empty($search)) {
            return Asset_Maintenance::with(['Assets', ])->get();
        }

        return Asset_Maintenance::with(['Assets', ])->paginate($perPage);
    }

    public function findById($id)
    {
        return Asset_Maintenance::with(['Assets', ])->find($id);
    }

    public function create(array $data)
    {
        return Asset_Maintenance::create($data);
    }

    public function update($id, array $data)
    {
        $record = Asset_Maintenance::find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $record = Asset_Maintenance::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}

