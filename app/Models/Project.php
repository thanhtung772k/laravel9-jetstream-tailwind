<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete

class Project extends Model
{
    use HasFactory,
        SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'customer',
        'project_type_id',
        'departments_id',
        'vale_contract',
        'start_date',
        'end_date',
        'status',
        'description'
    ];

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }
}
