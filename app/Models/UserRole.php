<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';

    public function users()
    {
        return $this->hasMany(User::class);
    }
    protected $fillable = [
        'role_name',
        'created_by',
        'updated_by'
    ];
}
