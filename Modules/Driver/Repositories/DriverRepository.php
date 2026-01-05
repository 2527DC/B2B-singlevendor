<?php

namespace Modules\Driver\Repositories;

use Modules\Driver\Entities\Driver;
use Illuminate\Support\Facades\Hash;

class DriverRepository implements DriverRepositoryInterface
{
    public function all()
    {
        return Driver::latest()->get();
    }

    public function find($id)
    {
        return Driver::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return Driver::create($data);
    }
}
