<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;


/**
 *  user master data
 * @property integer id
 *
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'locked_flg',
        'error_count',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'category_recipe_user');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_recipe_user');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * マッチしたユーザを返す
     * return the user whose username match
     * @param string $username
     * @return object|false
     */
    public function getUser($username)
    {
        $a = User::where('username', '=', $username)->first();

        Log::debug('getUser:' . $a);

        if (is_null($a))
        {
            return false;
        }
        return $a;
    }

    /**
     * アカウントがロックされているか？
     * @param object $user
     * @return bool
     */
    public function isAccountLocked($user)
    {
        if ($user->locked_flg == 1)
        {
            return true;
        }
        return false;
    }

    /**
     *  成功したらエラーカウントをリセットする
     *  @param object $user
     *  @return
     */
    public function resetErrorCount($user)
    {
        if ($user->error_count > 0)
        {
            $user->error_count = 0;
            $user->save();
        }
    }

    /**
     * エラーカウントを1増やす
     * @param int $error_count
     * @return int
     */
    public function addErrorCount($error_count)
    {
        return $error_count + 1;
    }

    /**
     * locking account
     * @param object $user
     *
     */
    public function lockAccount($user)
    {
        if ($user->error_count >= 6)
        {
            $user->locked_flg = 1;
            return $user->save();

        }
        return false;
    }
}
