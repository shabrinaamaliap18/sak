<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['flow_id','schema_sebelum','schema_sesudah','urutan'];
    protected $table = 'proses';


public function schema()
    {
        return $this->belongsTo('App\Models\Schema', 'schema_id', 'id');
    }


    public function workflow()
    {
        return $this->belongsTo('App\Models\Workflow', 'flow_id', 'id');
    }
}