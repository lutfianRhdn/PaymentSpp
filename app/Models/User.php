<?php

namespace App\Models;

use App\Mail\SendInfoUserMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Support\Facades\Mail;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;



class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function officer()
    {
        return $this->hasOne(Guard::class);
    }
    public function createStudent($data)
    {
        $password = Str::random(8);
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($password),
            'remember_token' => Str::random(10)
        ]);
        $user->assignRole('student');
        $user->student()->create([
            'nis'=>$data->nis,
            'nisn'=>$data->nisn,
            'phone'=>$data->phone,
            'address'=>$data->address,
            'class_id'=>$data->class

        ]);
        if ($data->photo) {

            $photo = Storage::put('/public/profile-photos', $data->photo);
            $user->profile_photo_path = $photo;
            $user->save();
        }
        Mail::to($user->email)->send(new SendInfoUserMail($user,$password));
        return $user;
    }
    public function updateStudent($student,$data)
    {
        $password = Str::random(8);
        $student->update([
            'nis'=>$data->nis,
            'nisn'=>$data->nisn,
            'phone'=>$data->phone,
            'address'=>$data->address,
            'class_id'=>$data->class
            
            ]);
            $student->user()->update([
                'name' => $data->name,
                'email' => $data->email,
            ]);
            if ($data->photo) {

            $photo = Storage::put('/public/profile-photos', $data->photo);
            $student->user->profile_photo_path = $photo;
            $student->user()->save();
        }
        dd('ok');
        return $student;
    }
}
