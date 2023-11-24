<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
class Conta extends Model
{
    use HasFactory;

    protected $table = 'contas';
    protected $primaryKey = 'id';
    protected $fillable = ['ID_Cliente', 'TipoConta', 'Saldo'];
    public $timestamps = true;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ID_Cliente', 'id');
    }
}
