<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  const ROLE_ADMIN = 0;
  const ROLE_TECHNOLOG = 1;
  const ROLE_TASTOR = 2;

  public static function getRoles()
  {
    return [
      self::ROLE_ADMIN => 'Администратор',
      self::ROLE_TECHNOLOG => 'Технолог',
      self::ROLE_TASTOR => 'Дегустатор',
    ];
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'role',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    // 'email_verified_at' => 'datetime',
  ];

  // public function products()
  // {
  //   return $this->belongsTo(User::class, 'user_id', 'id');
  // }
  public function ratings()
  {
    return $this->belongsToMany(Rating::class, 'rating_users', 'user_id', 'rating_id');
  }
  public function getDateAsCarbonAttribute()
  {
    return Carbon::parse($this->created_at);
  }
}
