<?php

namespace Ravarin\Entities;

use App\Events\UserWasRegistered;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Socialite\Two\User as SocialiteUser;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function createOrUpdateFromSocialite(SocialiteUser $socialite) 
    {

        $user = $this->where('email', $socialite->getEmail())->first();

        if (!$user)  {
            $password = str_random(6);
            $user = $this->create([
                'name' => $socialite->getName(),
                'email' => $socialite->getEmail(),
                'password' => bcrypt($password),
            ]);

            event(new UserWasRegistered($user, $password));
        }

        return $user;
    }

    public function favoritePlaces() 
    {
        return $this->belongsToMany(Place::class, 'favorites')->withTimestamps();
    }

    public function hasFavoritePlace(Place $place) 
    {
        return $this->favoritePlaces()->where('place_id', $place->id)->count();
    }

    public function setPasswordAttribute($value) 
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarAttribute() 
    {
        return asset('images/default.jpg');
    }
}
