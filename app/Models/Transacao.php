<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transacao extends Model
{
    use HasFactory;

    protected $table = 'transacoes';
    protected $primaryKey = 'id';
    protected $fillable = ['ID_Conta', 'TipoTransacao', 'Valor', 'DataTransacao'];
    public $timestamps = true;

    public function conta()
    {
        return $this->belongsTo(Conta::class, 'ID_Conta', 'id');
    }
}
