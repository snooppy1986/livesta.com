<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
/*use Illuminate\Database\Eloquent\Model;*/
use Illuminate\Foundation\Auth\User as Model;

class Administration extends Model implements Authenticatable
{
    use HasFactory;
    protected $table='administrations';
    protected $primaryKey = 'id';
    protected $fillable=['login', 'password', 'email', 'avatar', 'role'];
    /*protected $guarded = ['*'];*/

    /**
     * @inheritDoc
     */
    public function getAuthIdentifierName()
    {
        return $this->getKey();
    }

    /**
     * @inheritDoc
     */
    public function getAuthIdentifier()
    {
        // TODO: Implement getAuthIdentifier() method.
    }

    /**
     * @inheritDoc
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    /**
     * @inheritDoc
     */
    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    /**
     * @inheritDoc
     */
    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }
}
