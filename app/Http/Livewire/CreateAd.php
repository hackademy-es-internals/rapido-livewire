<?php

namespace App\Http\Livewire;

use App\Models\Ad;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\ResizeImage;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Jobs\GoogleVisionSafeSearchImage;

class CreateAd extends Component
{
    use WithFileUploads;
    
    public $title;
    public $body;
    public $price;
    public $category;
    public $images = [];
    public $temporary_images;
    public $image;
    
    
    protected $rules = [
        'title'=>'required|min:4',
        'body'=>'required|min:8',
        'category'=>'required',
        'price'=>'required|numeric',
        'images.*'=>'image|max:2048',
        'temporary_images.*'=>'image|max:2048'
    ];
    
    protected $messages = [
        'required'=>'Field :attribute is required, please fill it',
        'min'=>'Field :attribute should be longer than :min',
        'numeric'=>'Field :attribute must be a number',
        'temporary_images.required' => 'La imagen es obligatoria',
        'temporary_images.*.image' => 'Los archivos tienen que ser imagenes',
        'temporary_images.*.max' => 'La imagen supera los :max mb',
        'images.image' => 'El archivo tiene que ser una imagen',
        'images.max' => 'La imagen supera los :max mb',
    ];
    
    
    public function updatedTemporaryImages()
    {
        if($this->validate([
            'temporary_images.*'=>'image|max:2048'
            ])){
                foreach ($this->temporary_images as $image) {
                    $this->images[] = $image;
                }
            }
    }
    
    public function removeImage($key)
    {
        if(in_array($key,array_keys($this->images))){
            unset($this->images[$key]);
        }
    }

    public function store()
    {
        // datos validados
        $validatedData = $this->validate();

        // busco la categoria
        $category = Category::find($this->category);
        
        // creo el anuncio a partir de la categoria usando la relacion y pasando los datos validados
        $ad = $category->ads()->create($validatedData);
        
        // vuelvo a guardar el anuncio "pasando" por la relacion del usuario
        Auth::user()->ads()->save($ad);

        // guardo cada imagen en el db y en el storage
        if(count($this->images)){
            $newFileName = "ads/$ad->id";

            foreach ($this->images as $image) {
                $newImage = $ad->images()->create([
                    'path'=>$image->store($newFileName,'public')
                ]);
                dispatch(new ResizeImage($newImage->path,400,300));
                dispatch(new GoogleVisionSafeSearchImage($newImage->id));
                dispatch(new GoogleVisionLabelImage($newImage->id));
            }

            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }
        
        session()->flash('message',['type'=>'success', 'text'=>'Ad created successfully']);

        $this->cleanForm();
    }
        
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
        
    public function cleanForm()
    {
        $this->title = "";
        $this->body = "";
        $this->category = "";
        $this->price = "";
        $this->images = [];
        $this->temporary_images = [];
    }

    public function render()
    {
        return view('livewire.create-ad');
    }
    }