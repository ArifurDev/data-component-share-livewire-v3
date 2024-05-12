<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $comment;
    public $image;
    public $quersitionId = '1';

    protected $listeners = [
        'quersitionSelected' => 'updateQuersitionId'
    ];

    public function updateQuersitionId($quersitionId)
    {
         $this->quersitionId = $quersitionId;
    }

    public function createComment()
    {
        $this->validate([
            'comment' => 'required',
            'image' => 'required|image|max:1024', //  1MB Max
        ]);

        //file upload

        $imageFileName = Str::random(10).'.'.time().'.'.$this->image->extension();
        $this->image->storeAs('images',$imageFileName,'public');

        //create comment
        Comment::create([
            'description' => $this->comment,
            'image' => $imageFileName,
            'quersition_id' => $this->quersitionId
        ]);

        request()->session()->flash('success','Created successfuliy');
        $this->reset(['comment','image']);
    }

    public function delete(Comment $comment)
    {
        //delete comment
        $comment->delete();
        request()->session()->flash('success','Deleted Successfully');
    }
    public function render()
    {
        return view('livewire.comments',[
            'comments' => Comment::where('quersition_id',$this->quersitionId)->latest()->paginate(3)
        ]);
    }
}
