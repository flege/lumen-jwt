<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $softDeletes = true;
    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];
    protected $fillable = ['nama','username','password','token'];
    public static $rules = [
        'nama' => 'required',
        'username' => 'required',
        'password' => 'required'
    ];
}
