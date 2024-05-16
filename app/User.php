<?php

namespace App;

use App\Models\Returns;
use App\Models\ServiceCenter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'google_token', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'google_token', 'remember_token',
    ];

    public function keys() {
        return $this->hasMany(Key::class);
    }

    public function xeroTenants() {
        return $this->hasMany(XeroTenant::class);
    }

    public function serviceCenterReturnsCheckerIn() {
        return $this->hasMany(Returns::class, 'check_in_user_id');
    }

    public function serviceCenterReturnsTechnician() {
        return $this->hasMany(Returns::class, 'technician_id');
    }

    /**
     * Check if user has a permission
     *
     * @param string $permission
     * @return boolean
     */
    public function hasPermission(string $permission) {
        //Check this is a valid permission (exists in config)
        if (!in_array($permission, array_keys(config('permissions')))) {
            throw new InvalidArgumentException("Permission [{$permission}] doesn't exist in config");
        }
        //Look for entry in database (Cache this for future speed improvements)
        $entry = DB::table('user_permissions')
            ->where('permission', $permission)
            ->where('user_id', $this->id)
            ->first();


        if (!$entry) {
            //No entry, return default value
            $configEntry = config('permissions')[$permission];
            return key_exists('default', $configEntry) ? $configEntry['default'] : false;
            //Defaults to false if value doesn't exist.
        }

        //Return user set value
        return $entry->allowed;
    }
}
