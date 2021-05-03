<?php
namespace agenda\Models;

use Illuminate\Database\Eloquent\Model;

class Estadistica extends Model{
   protected $table = 'estadisticas';
   protected $fillable = ['url','total'];
   protected $primaryKey = 'url';
   public $incrementing = false;
   public $timestamps = false;
}
?>
