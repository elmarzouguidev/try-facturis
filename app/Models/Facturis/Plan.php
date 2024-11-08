<?php

namespace App\Models\Facturis;

use App\Traits\GetModelByKeyName;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use GetModelByKeyName;
    use UuidGenerator;
}
