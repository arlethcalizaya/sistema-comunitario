<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ImagenReporte extends Model {
    protected $table = 'imagenes_reportes';
    protected $fillable = ['reporte_id', 'ruta'];
}