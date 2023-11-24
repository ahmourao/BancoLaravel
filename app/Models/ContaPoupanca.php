<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaPoupanca extends Model
{
    use HasFactory;

    protected $table = 'contas_poupanca';
    protected $primaryKey = 'id';
    protected $fillable = ['ID_Conta', 'TaxaJuros', 'DataVencimento'];
    public $timestamps = true;

    public function conta()
    {
        return $this->belongsTo(Conta::class, 'ID_Conta', 'id');
    }
}
