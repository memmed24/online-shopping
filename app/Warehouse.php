<?php
/**
 * Created by PhpStorm.
 * User: Lenova
 * Date: 2/27/2018
 * Time: 10:49
 */

namespace App;


use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Support\Facades\DB;

class Warehouse extends Model implements AuthenticatableContract, AuthorizableContract
{
  use Authenticatable, Authorizable;

  protected $table = "warehouse";
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'price'
  ];

  protected $hidden = ['user_id', 'photo_id'];
  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */

  protected $appends = ['user', 'photo'];

  public function getUserAttribute(){
    return User::find($this->user_id);
  }

  public function getPhotoAttribute(){
    return DB::table('photos')->where('id', $this->photo_id)->get();
  }

}