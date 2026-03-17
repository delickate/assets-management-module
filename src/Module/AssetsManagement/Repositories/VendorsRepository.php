<?php

namespace Modules\AssetsManagement\Repositories;

use Modules\AssetsManagement\Entities\Vendors;
use Modules\AssetsManagement\Repositories\Interfaces\VendorsRepositoryInterface;

class VendorsRepository implements VendorsRepositoryInterface
{
    public function getAll($perPage, $search)
    {
        if (!empty($search)) {
            return Vendors::with([])->get();
        }

        return Vendors::with([])->paginate($perPage);
    }

    public function findById($id)
    {
        return Vendors::with([])->find($id);
    }

    public function create(array $data)
    {
        return Vendors::create($data);
    }

    public function update($id, array $data)
    {
        $record = Vendors::find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $record = Vendors::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}

