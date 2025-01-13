<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartementUser extends Model
{
    use HasFactory;
    protected $table = 'department_users';
    protected $fillable = ['departements_id', 'users_id'];

    public function user() 
    {
        return $this->belongsTo(User::class, 'users_id', 'id');    
    }
}
