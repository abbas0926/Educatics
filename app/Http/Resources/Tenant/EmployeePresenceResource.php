<?php

namespace App\Http\Resources\Tenant;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeePresenceResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
