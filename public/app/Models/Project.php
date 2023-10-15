<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_name',
        'contact_name',
        'contact_email',
        'start_date',
        'end_date',
        'auto_renewal',
        'option',
        'environment_id',
        'member_id',
    ];

    public function environment()
    {
        return $this->belongsTo(Environment::class, 'environment_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'project_option')->withTimestamps();
        // return $this->belongsToMany(Option::class)->withTimestamps();
    }

}
