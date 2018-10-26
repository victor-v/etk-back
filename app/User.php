<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Passport\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_pin_user', 'password', 'user_tin_company'
    ];

    public $primaryKey = 'id_user';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
    //TODO удалить все после подключения авторизации
    protected function getRequestParameter($parameter, $request, $default = null)
    {
        $requestParameters = (array) $request->getParsedBody();

        return isset($requestParameters[$parameter]) ? $requestParameters[$parameter] : $default;
    }

    //TODO переделать это
    public function findForPassport($request, $username)
    {
        $company = $this->getRequestParameter('user_tin_company',$request);
        $user = $this->where('user_pin_user', $username)
            ->where('user_tin_company', $company)
            ->first();
        if (!$user) {
            $user = new User([
                'user_pin_user' => $username,
                'password' => bcrypt('123456'),
                'user_tin_company' => $company
            ]);
            $user->save();
        }
        if ($company) {
            $structure = \Illuminate\Support\Facades\DB::table('structures')->where('tin_orgstruct', $company)->first();
            if (!$structure) {
                \Illuminate\Support\Facades\DB::table('structures')
                    ->insert(['tin_orgstruct' => $company, 'name_struct' => $company, 'datetrange_struct' => '[' . Carbon::now()->toDateString() . ',)']);
            }
        }
        return $user;
    }


}
