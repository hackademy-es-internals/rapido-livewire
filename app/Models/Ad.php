<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
class Ad extends Model
{
    protected $fillable = ['title','body','price'];
    
    use Searchable,HasFactory;
    
    
    public function toSearchableArray()
    {
        return [
            'title'=>$this->title,
            'body'=>$this->body,
        ];
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }
    
    static public function ToBeRevisionedCount()
    {
        return Ad::where('is_accepted', null)->count();
    }
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
