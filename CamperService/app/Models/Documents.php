<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = 'documents';

    protected $primaryKey = 'doc_id';

    protected $fillable = ['doc_id',
                            'pick_location',
                            'size',
                            'transcript',
                            'confrim',
                            'receipt',
                            'reason',
                            
                        ];
    protected $hidden =['created_at','updated_at'];

    public $timestamps = false;
    public $timestamp = false;
}
