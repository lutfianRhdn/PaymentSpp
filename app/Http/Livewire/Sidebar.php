<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        // $main = $this->slot;
        // dd($this->slot);
        return view('livewire.sidebar');
    }
}
