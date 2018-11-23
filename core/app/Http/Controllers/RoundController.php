<?php

namespace App\Http\Controllers;

use App\Round;
use Illuminate\Http\Request;

class RoundController extends Controller
{
    public function round()
    {
        $rounds = Round::orderBy('id','DESC')->get();
        $pt = 'rounds';
        return view('admin.website.round', compact('rounds','pt'));
    }
           
    public function roundCreate(Request $request)
    {
        $this->validate($request, ['name' => 'required','base_price' => 'required','inc_rate' => 'required','winner' => 'required','endin' => 'required']);
      
        $round['name'] = $request->name;
        $round['base_price'] = $request->base_price;
        $round['inc_rate'] = $request->inc_rate;
        $round['winner'] = $request->winner;
        $round['pot'] = 0;
        $round['endin'] = $request->endin;
        Round::create($round);
        
        return back()->with('success','New Round Created Successfully');
    }

    public function roundUpdate(Request $request, Round $round)
    {
        $this->validate($request, ['name' => 'required','base_price' => 'required','inc_rate' => 'required','winner' => 'required','endin' => 'required']);
        
        $round['name'] = $request->name;
        $round['base_price'] = $request->base_price;
        $round['inc_rate'] = $request->inc_rate;
        $round['winner'] = $request->winner;
        $round['endin'] = $request->endin;
        $round->update();
        
        return back()->with('success','Round Updated Successfully');
    }
}
