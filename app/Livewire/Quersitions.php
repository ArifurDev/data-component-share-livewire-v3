<?php

namespace App\Livewire;

use App\Models\Quersition;
use Livewire\Component;
use Livewire\WithPagination;

class Quersitions extends Component
{
    use WithPagination;

    public $quersition;
    public $activeId = 1;

    public function createQuersition()
    {
        $this->validate([
            'quersition' => 'required',
        ]);

        Quersition::create([
            'quersition' => $this->quersition,
        ]);

        request()->session()->flash('quersition','Quersition Create successfuly');
        $this->reset('quersition');
    }


    public function quersitionSelected($quersitionId)
    {
        $this->activeId = $quersitionId;
        $this->dispatch('quersitionSelected', $quersitionId); // Emitting the event with the quersitionId
    }

    public function render()
    {
        return view('livewire.quersitions',[
            'quersitions' => Quersition::latest()->paginate(3)
        ]);
    }
}
