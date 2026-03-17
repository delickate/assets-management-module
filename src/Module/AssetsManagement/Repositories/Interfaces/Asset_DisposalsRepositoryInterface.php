<?php

namespace Modules\AssetsManagement\Repositories\Interfaces;

interface Asset_DisposalsRepositoryInterface
{
    public function getAll($perPage, $search);
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
