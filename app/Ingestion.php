<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Ingestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service', 'raw_data', 'comments', 'status',
    ];


    public function key() {
        return $this->belongsTo(Key::class);
    }


    public function zingtreeSessions() {
        return $this->hasMany(ZingtreeSession::class);
    }
}
