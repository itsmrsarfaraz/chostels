<?php

namespace App\Services\Hostel;

use App\Models\Hostel;

class HostelService
{
    public function create(array $data): Hostel
    {
        return Hostel::create($data);
    }

    public function update(Hostel $hostel, array $data): Hostel
    {
        $hostel->update($data);
        return $hostel;
    }
}