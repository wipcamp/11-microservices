<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campers extends Model
{
    protected $table = 'campers';
    protected $fillable = ['wip_id',
    'bed_room',
    'class_room',
    'wifi_pass',
    'flavor_id',
    'doc_id',
    
];
protected $hidden =['created_at','updated_at'];
}
