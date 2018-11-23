<?php

namespace App\Http\Controllers;

use App\Team;
use App\Round;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function team()
    {
        $teams = Team::all();
        $pt = 'TEAMS';
        return view('admin.website.team', compact('teams','pt'));
    }
           
    public function teamCreate(Request $request)
    {
        $this->validate($request, ['name' => 'required','image' => 'image|mimes:jpeg,png,jpg|max:2048','amount' => 'required','details' => 'required']);
        if($request->hasFile('image'))
        {
            $imgname = str_random(12).'.'. $request->image->getClientOriginalExtension();
            $npath = 'assets/images/team/'.$imgname;
            Image::make($request->image)->resize(200, 200)->save($npath);
        }
        $team['name'] = $request->name;
        $team['image'] = $imgname;
        $team['amount'] = $request->amount;
        $team['details'] = $request->details;
        Team::create($team);
        
        return back()->with('success','New Team Created Successfully');
    }

    public function teamUpdate(Request $request, Team $team)
    {
        $this->validate($request,  ['name' => 'required','image' => 'image|mimes:jpeg,png,jpg|max:2048','amount' => 'required','details' => 'required']);
        
        if($request->hasFile('image'))
        {
            $oldpath = 'assets/images/team/'.$team->image;
            if(file_exists($oldpath))
            {
                unlink($oldpath);
            }
            $imgname = str_random(12).'.'. $request->image->getClientOriginalExtension();
            $npath = 'assets/images/team/'.$imgname;
            Image::make($request->image)->resize(200, 200)->save($npath);
            $team['image'] = $imgname;
        }
        $team['name'] = $request->name;
        $team['amount'] = $request->amount;
        $team['details'] = $request->details;
        $team['status'] = $request->status;
        $team->update();
        
        return back()->with('success','Team Updated Successfully');
    }
}
