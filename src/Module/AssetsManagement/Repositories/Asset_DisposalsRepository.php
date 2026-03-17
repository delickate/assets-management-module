<?php

namespace Modules\AssetsManagement\Repositories;

use Modules\AssetsManagement\Entities\Asset_Disposals;
use Modules\AssetsManagement\Repositories\Interfaces\Asset_DisposalsRepositoryInterface;

class Asset_DisposalsRepository implements Asset_DisposalsRepositoryInterface
{
    public function getAll($perPage, $search)
    {
        if (!empty($search)) {
            return Asset_Disposals::with(['Assets', ])->get();
        }

        return Asset_Disposals::with(['Assets', ])->paginate($perPage);
    }

    public function findById($id)
    {
        return Asset_Disposals::with(['Assets', ])->find($id);
    }

    public function create(array $data)
    {
        return Asset_Disposals::create($data);
    }

    public function update($id, array $data)
    {
        $record = Asset_Disposals::find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $record = Asset_Disposals::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}

