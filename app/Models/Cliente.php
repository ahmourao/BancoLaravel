<?php

namespace app\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conta;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['Nome', 'CPF', 'Endereco', 'Telefone'];
    public $timestamps = true;

    public function conta()
    {
        return $this->hasOne(Conta::class, 'id', 'ID_Conta');
    }
}
