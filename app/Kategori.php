<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model {
    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_kategori';
    protected $table = 'kategori';
    protected $softDeletes = true;
    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];
    protected $fillable = ['nama'];
    public static $rules = [
        'nama' => 'required',
    ];
}
