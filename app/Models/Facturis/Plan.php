<?php

namespace App\Models\Facturis;

use App\Traits\GetModelByKeyName;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use GetModelByKeyName;
    use UuidGenerator;


    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
