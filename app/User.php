<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'branch', 'line_id', 'status', 'agent_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function add_users($line_id, $name, $phone_number, $branch, $agent_code)
    {
        $customers = User::where('line_id', $line_id)->first();
        if (!$customers)
            $customers = User::create([
                'name' => $name,
                'phone_number' => $phone_number,
                'branch' => $branch,
                'line_id' => $line_id,
                'agent_code' => $agent_code
            ]);
        return $customers;
    }

    public static function get_users($line_id)
    {
        $customers = User::where('line_id', $line_id)->first();
        if(!$customers)
            $customers = "null";
        else
            $customers = "found";
        return $customers;
    }

    public static function get_users_data($line_id)
    {
        $customers = User::where('line_id', $line_id)->first();
        return $customers;
    }

}
