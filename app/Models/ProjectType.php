<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function project()
    {
        return $this->hasMany(Project::class, 'project_id');
    }

    public function role()
    {
        return $this->hasMany(Role::class, 'role_id');
    }
}
