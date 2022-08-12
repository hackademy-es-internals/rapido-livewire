<div>

    @if (session()->has('message'))
        <x-alert :type="session('message')['type']" :message="session('message')['text']"/>
    @endif
    <form wire:submit.prevent="store">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">{{__('Título')}}:</label>
            <input wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror">
            @error('title')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">{{__('Precio')}}:</label>
            <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror">
            @error('price')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="body" class="form-label">{{__('Descripción')}}:</label>
            <textarea wire:model="body" cols="30" rows="15" class="form-control @error('body') is-invalid @enderror"></textarea>
            @error('body')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="caegory" class="form-label">{{__('Categoría')}}</label>
            <select wire:model.defer="category" class="form-control">
                <option value="">{{__('Seleccionar Categoría')}}</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <input wire:model="temporary_images" type="file" name="images" multiple class="form-control shadow @error('temporary_images.*') is-invalid @enderror">
            @error('temporary_images.*')
                <p class="text-danger mt-2">{{$message}}</p>
            @enderror
        </div>
        @if(!empty($images))
        <div class="row">
            <div class="col-12">
                <p>{{__('Vista previa')}}:</p>
                <div class="row">
                    @foreach ($images as $key=>$image)
                        <div class="col-12 col-md-4">
                            <img src="{{$image->temporaryUrl()}}" alt="" class="img-fluid">
                            <button type="button" class="btn btn-danger" wire:click="removeImage({{$key}})">Eliminar</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <div class="my-3">
            <button type="submit" class="btn btn-info">{{__('Crear')}}</button>
        </div>
    </form>
</div>

