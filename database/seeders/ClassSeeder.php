<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Major;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = ['x','xi','xii','xiii'];
    $allClass=[];
    // loop for levels
        foreach ($levels as $level ) {
                $majors = \App\Models\Major::all();
                $classes = [];
    // loop for majors
                foreach ($majors as $major ) {
                    
            // if major is Rpl
                if ($major->label =='Rpl' && $level !== 'xiii') {
                    $class = [];
                    // loop each of 2
                    for ($i=1; $i <= 2; $i++) {
                        array_push($class,['label'=>$i,'major_id'=>$major->id,'level'=>$level]);
                    }
                    array_push($classes,$class);
                }elseif ($major->label == 'Tkj' && $level !== 'xiii') {
                    $class = [];
                    // loop each of 3
                    for ($i=1; $i <= 3; $i++) {
                        array_push($class,['label'=>$i,'major_id'=>$major->id,'level'=>$level]);
                    }
                    array_push($classes,$class);
                }elseif ($major->label == 'Ak') {
                    $class = [];
                    // loop each of 6
                    for ($i=1; $i <= 6; $i++) {
                        array_push($class,['label'=>$i,'major_id'=>$major->id,'level'=>$level]);
                    }
                    array_push($classes,$class);
                }
            }
                array_push($allClass,$classes);

        }
        foreach($allClass as $classesByMajor){
            foreach ($classesByMajor as $classes ) {
                foreach ($classes as $class ) {
                    \App\Models\Classes::create($class);
                }
            }
        }
    }
}
