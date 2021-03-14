<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $majors = [
            [
                'name'=>'Rekayasa Perangkat Lunak',
                'label' =>'Rpl'
            ],
            [
                'name'=>'Teknik Komputer Jaringan',
                'label' => 'Tkj',
            ],
            [
                'name'=> 'Analisis Kimia',
                'label' => 'Ak',
            ]
        ];
        foreach ($majors as $major ) {
            Major::create($major);
        }
    }
}
