<?php

namespace App\Models;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Departement extends Model
{
    use HasFactory;
    protected $table = 'departements';
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'department_users', 'departments_id', 'users_id');
    }
}
