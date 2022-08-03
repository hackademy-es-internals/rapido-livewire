<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ad extends Model
{
    protected $fillable = ['title','body','price'];
    
    use HasFactory;
    
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    static public function ToBeRevisionedCount()
    {
        return Ad::where('is_accepted', null)->count();
    }
}
