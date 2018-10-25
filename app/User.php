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
        'user_pin_user','password','user_tin_company'
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


    //TODO переделать это
    public function findForPassport($request, $username) {

        $user =  $this->where('user_pin_user', $username)->where('user_tin_company',$request->getParsedBody()['user_tin_company'])->first();
        if (!$user) {
            $user = new User([
                'user_pin_user' => $username,
                'password' => bcrypt('123456'),
                'user_tin_company' => $request->getParsedBody()['user_tin_company']
            ]);
            $user->save();

            $structure = \Illuminate\Support\Facades\DB::table('structures')->where('tin_orgstruct',$request->getParsedBody()['user_tin_company'])->first();
            if (!$structure){
                \Illuminate\Support\Facades\DB::table('structures')
                    ->insert(['tin_orgstruct' => $request->getParsedBody()['user_tin_company'], 'datetrange_struct' => '['.Carbon::now()->toDateString().',)']);
            }
        }
        return $user;
    }


}
