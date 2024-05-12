<div class="col-md-5 card text-center p-2">
    <h4>comments</h4>
    @if (session('success'))
        <small class="text-success">{{ session('success') }}</small>
    @endif
    <form wire:submit="createComment">
        <div class="mb-3">
            <input type="text" class="form-control"  wire:model="comment">
            @error('comment')
                 <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <div class="mb-3"
                x-data="{ uploading: false, progress: 0 }"
                x-on:livewire-upload-start="uploading = true"
                x-on:livewire-upload-finish="uploading = false"
                x-on:livewire-upload-cancel="uploading = false"
                x-on:livewire-upload-error="uploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
            <input type="file" class="form-control"  wire:model="image">
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" alt="" width="100">
            @endif

            @error('image')
                 <span class="text-danger">{{ $message }}</span>
            @enderror

            <!-- Progress Bar -->
            <div x-show="uploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!--comments-->
    @foreach ($comments as $comment)
         @livewire('comment-row', ['comment' => $comment], key($comment->id))
    @endforeach
    {{ $comments->links() }}

</div>
