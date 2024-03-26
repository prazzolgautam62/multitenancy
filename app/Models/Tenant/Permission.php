<?php

namespace App\Models\Tenant;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    protected $connection = 'tenant';
    public $timestamps = false;
    protected $hidden = ['pivot'];
    const ROLES = [
        1 => 'superadmin',
        2 => 'admin',
        3 => 'normal user',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
