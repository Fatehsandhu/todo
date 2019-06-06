<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
class Users extends Model implements Authenticatable
{
    //
    use AuthenticableTrait;
    protected $fillable = ['name','password','userimage'];
    protected $hidden = [
        'password'
    ];

    public function todo()
    {
        return $this->hasMany('App\Todo','user_id');
    }
}
