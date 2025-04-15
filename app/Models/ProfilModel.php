<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class ProfilModel extends Model
{
    use HasFactory;
 
    protected $table = 'profils'; 
    protected $primaryKey = 'id'; 
    protected $fillable = ['user_id', 'foto', 'nama_lengkap', 'email', 'no_hp', 'alamat', 'role'];
 
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}