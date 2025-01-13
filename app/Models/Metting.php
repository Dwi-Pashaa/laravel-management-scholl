<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metting extends Model
{
    use HasFactory;
    protected $table = 'mettings';
    protected $fillable = ['departements_id', 'title', 'start_at', 'end_at', 'notes'];

    public function departement() 
    {
        return $this->belongsTo(Departement::class, 'departements_id', 'id');    
    }
}
