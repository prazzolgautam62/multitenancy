<?php

namespace App\Models\Main;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tenant extends Model
{
    use HasFactory;
    protected $connection = 'main';
    protected $guarded = [];
    protected $hidden = ['database_name'];

    public function connect(){
    	if(!$this->isConnected())
    		connectTenant($this->database_name);
    }

    private function isConnected(){
    	return $this->database_name == config('database.connections.tenant.database');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function configuration() :HasOne
    {
        return $this->hasOne(TenantConfiguration::class, 'tenant_id');
    }
}
