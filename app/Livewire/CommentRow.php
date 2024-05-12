<?php

namespace App\Livewire;

use Livewire\Component;

class CommentRow extends Component
{
    public $comment;

    public function mount($comment)
    {
        $this->comment = $comment;
    }
    public function render()
    {
        return view('livewire.comment-row');
    }
}
