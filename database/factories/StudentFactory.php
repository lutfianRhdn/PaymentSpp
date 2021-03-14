<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::whereHas('roles',function($q){
            $q->where('roles.name','student');
        })->get()->random();
        return [
            'user_id'=>$user->id,
            'nis'=>rand(11111111,99999999),
            'phone'=>  $this->faker->e164PhoneNumber,
            'address'=>$this->faker->address
        ];
    }
}
