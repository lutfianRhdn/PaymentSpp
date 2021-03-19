<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Card extends Component
{
    public function render()
    {
        // dd($this->content);
        return view('livewire.card')->extends('layouts.test')->section('content');
    }
}
