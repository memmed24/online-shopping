<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Support\Facades\DB;
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
  use Authenticatable, Authorizable;

  protected $table = "users";
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'surname'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'api_token', 'photo_id'
  ];

  protected $appends = ['photo'];

  public function getPhotoAttribute(){
    return DB::table('photos')->where('id', $this->photo_id)->get();
  }
}
