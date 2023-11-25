<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Conta;

class ContaCorrente extends Model
{
    use HasFactory;

    protected $table = 'contas_corrente';
    protected $primaryKey = 'id';
    protected $fillable = ['ID_Conta', 'LimiteCredito', 'TarifaMensal'];
    public $timestamps = true;

    public function conta()
    {
        return $this->belongsTo(Conta::class, 'ID_Conta', 'id');
    }
}
