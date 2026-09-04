<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model {
    // IMPORTANTE: Como el nombre es en español, Laravel necesita que le digamos el nombre de la tabla
    protected $table = 'categorias'; 

    protected $fillable = [
        'nombre', 'descripcion', 'icono', 'estado'
    ];
}
