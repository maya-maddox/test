<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ServiceCenter extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'location',
        'timezone',
        'user_preference'
    ];

    protected $casts = [
        'user_preference' => 'array'
    ];

    public function returns()
    {
        return $this->hasMany(Returns::class);
    }

    public function selectUserPreference(User $user = null)
    {
        if ($user == null) { $user = Auth::user(); }
        
        if (!$this->isUserPreference($user)) {
            $this->user_preference = array_merge($this->user_preference ?? [], [$user->id]);
            $this->save();
        }

        foreach (ServiceCenter::all() as $service_center)
        {
            if ($this->is($service_center)) { continue; }
            if (in_array($user->id, $service_center->user_preference ?? [])) {
                $service_center->user_preference = array_filter($service_center->user_preference ?? [], fn ($up) => $up != $user->id);
                $service_center->save();
            }
        }
    }

    public function isUserPreference(User $user = null)
    {
        if ($user == null) { $user = Auth::user(); }

        return in_array($user->id, $this->user_preference ?? []);
    }
}
