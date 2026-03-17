<?php

namespace Modules\AssetsManagement\Repositories;

use Modules\AssetsManagement\Entities\Employees;
use Modules\AssetsManagement\Repositories\Interfaces\EmployeesRepositoryInterface;

class EmployeesRepository implements EmployeesRepositoryInterface
{
    public function getAll($perPage, $search)
    {
        if (!empty($search)) {
            return Employees::with([])->get();
        }

        return Employees::with([])->paginate($perPage);
    }

    public function findById($id)
    {
        return Employees::with([])->find($id);
    }

    public function create(array $data)
    {
        return Employees::create($data);
    }

    public function update($id, array $data)
    {
        $record = Employees::find($id);
        if ($record) {
            return $record->update($data);
        }
        return false;
    }

    public function delete($id)
    {
        $record = Employees::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }
}

