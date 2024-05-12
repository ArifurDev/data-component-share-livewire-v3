<div class="col-md-5 card text-center p-2">
    <h4>Quersition</h4>
    @if (session('quersition'))
        <small class="text-success">{{ session('quersition') }}</small>
    @endif
    <form wire:submit="createQuersition">
        <div class="mb-3">
            <input type="text" class="form-control"  wire:model="quersition">
            @error('quersition')
                 <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @foreach ($quersitions as $quersition)
        <div class="card mt-3 {{  $quersition->id == $activeId  ? 'bg-primary' : ' ' }}"
            wire:click="quersitionSelected({{ $quersition->id }})">
            <div class="card-body">
            <div class="card-title d-flex justify-content-between">
                <span class="mt-2" style="font-size: 11px">{{ $quersition->created_at->diffForHumans() }}</span>
                <button class="btn btn-danger"
                    type="button"
                    wire:confirm='Are you sure to delete this comment?'
                    wire:click='delete({{ $quersition->id }})'
                >
                X
                </button>
            </div>
            <p class="card-text">{{ $quersition->quersition }}</p>
            </div>
        </div>
    @endforeach
    {{ $quersitions->links() }}
</div>

