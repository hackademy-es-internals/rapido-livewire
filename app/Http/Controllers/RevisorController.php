<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;

class RevisorController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth.revisor');
    // }
    
    public function index()
    {
        $ad = Ad::where('is_accepted',null)
        ->orderBy('created_at','desc')
        ->first();
        return view('revisor.home',compact('ad'));
    }
    
    
    public function acceptAd(Ad $ad)
    {
        $ad->setAccepted(true);
        return redirect()->back()->with(['type'=>'success','message'=>'Anuncio aceptado']);
    }
    public function rejectAd(Ad $ad)
    {
        $ad->setAccepted(false);
        return redirect()->back()->with(['type'=>'danger','message'=>'Anuncio rechazado']);

    }
}
