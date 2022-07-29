<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class UserDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'member_id',
        'date_of_birth',
        'home_town',
        'current_residence',
        'university',
        'working_form',
        'time_start',
        'member_company',
        'position_id',
        'departments_id',
        'role_id',
        'japanese',
        'avatar',
        'national',
        'ethnic',
        'phone',
        'relative_phone',
        'passport',
        'date_range',
        'place_issue',
        'visa',
        'duration_visa',
        'link_fb',
        'user_id',
        'gender'
    ];

    protected $sortable = [
        'member_id',
        'date_of_birth',
    ];

    public function nameSortable($query, $direction)
    {
       return $query->orderBy('name', $direction);
    }

    public function emailSortable($query, $direction)
    {
        return $query->orderBy('email', $direction);
    }

    public function depart()
    {
        return $this->belongsTo(Department::class, 'departments_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
