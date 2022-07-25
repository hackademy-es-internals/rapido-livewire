<div>
    <form wire:submit.prevent="store">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror">
            @error('title')
                {{$message}}
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror">
            @error('price')
                {{$message}}
            @enderror
        </div>

        
        <div class="mb-3">
            <label for="body" class="form-label">Description:</label>
            <textarea wire:model="body" cols="30" rows="15" class="form-control @error('body') is-invalid @enderror"></textarea>
            @error('body')
                {{$message}}
            @enderror
        </div>

        <div class="my-3">
            <button type="submit" class="btn btn-info">Crea</button>
        </div>
    </form>
</div>

