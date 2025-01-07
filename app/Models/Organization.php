<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'building_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'organization_activities');
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }
}
