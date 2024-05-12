<div class="card mt-3">
    <div class="card-body">
    <div class="card-title d-flex justify-content-between">
        <span class="mt-2" style="font-size: 11px">{{ $comment->created_at->diffForHumans() }}</span>
        <button class="btn btn-danger"
            type="button"
            wire:confirm='Are you sure to delete this comment?'
            wire:click='$parent.delete({{ $comment->id }})'
        >
        X
        </button>
    </div>
    <p class="card-text">{{ $comment->description }}</p>
    @if ($comment->image)
    <img src="{{ Storage::url('public/images/' . $comment->image) }}" width="10%" height="auto" alt="{{ $comment->image }}">
    @endif
    </div>
</div>
