<?php

namespace Modules\Driver\Repositories;

interface DriverRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
}
