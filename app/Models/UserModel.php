<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; //mendefinisikan nama tabel model ini
    protected $primaryKey = 'user_id'; // mendefinisikan primary key dari tabel

    protected $fillable = ['level_id', 'username', 'nama', 'password'];
}
