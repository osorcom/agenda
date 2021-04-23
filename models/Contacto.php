<?php
namespace agenda\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model{
   protected $table = 'contactos';
   protected $fillable = ['nom','email','telf'];
   public $timestamps = false;
}
?>
