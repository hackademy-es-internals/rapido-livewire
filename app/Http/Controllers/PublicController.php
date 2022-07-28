<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    
    public function index()
    {
        $ads = Ad::orderBy('created_at','desc')->take(6)->get(); // sort in db
        return view('welcome',compact('ads'));
    }

    public function show(Ad $ad)
    {
        return view('ad.show',compact('ad'));
    }
    
    public function adsByCategory(Category $category){
        $ads = $category->ads()->paginate(1);
        return view('ad.by-category', compact ('category','ads'));
    }
    
    
}
