<?php

namespace Database\Factories;

use App\Models\Guard;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Tuition;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tuition = Tuition::all()->random();
        return [
            'student_id'=>Student::all()->random()->id,
            'guard_id'=>Guard::all()->random()->id,
            'tuition_id'=>$tuition->id,
            'month'=> $this->faker->monthName('December'),
            'year'=> $this->faker->year(),
            'nominal' =>$tuition->nominal
        ];
    }
}
