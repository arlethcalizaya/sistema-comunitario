<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model {
    protected $table = 'reportes';
    protected $fillable = [
        'user_id', 'categoria_id', 'zona_id', 'titulo', 'descripcion', 
        'latitud', 'longitud', 'direccion', 'prioridad', 'estado'
    ];

    // Relaciones (para que el reporte sepa quién lo creó y de qué tipo es)
    public function usuario() { return $this->belongsTo(User::class, 'user_id'); }
    public function categoria() { return $this->belongsTo(Categoria::class, 'categoria_id'); }
    public function zona() { return $this->belongsTo(Zona::class, 'zona_id'); }
}