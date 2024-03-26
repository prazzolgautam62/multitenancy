<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantConfiguration extends Model
{
    use HasFactory;
    protected $connection = 'main';
    protected $fillable = ['tenant_id', 'configuration'];
    protected $casts = ['configuration' => 'array'];
}
