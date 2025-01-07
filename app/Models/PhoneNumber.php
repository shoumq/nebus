<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'organization_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
