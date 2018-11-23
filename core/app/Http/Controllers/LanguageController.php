<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{
    public function index()
    {
        $enpath = base_path('resources/lang/en.json');
        $encontents =File::get($enpath);
        $eng = (array) json_decode($encontents);

        $chpath = base_path('resources/lang/ch.json');
        $chcontents =File::get($chpath);
        $chin = (array) json_decode($chcontents);

        $tcpath = base_path('resources/lang/tc.json');
        $tccontents =File::get($tcpath);
        $trad = (array) json_decode($tccontents);
        
        $keys = array();
        $i = 1;
        foreach($eng as $k => $item)
        {
            $keys[$i] = $k;
            $i++;
        }
        $pt= "MANAGE LANGUAGE";
        
        return view('admin.website.language', compact('keys','eng','chin','trad','pt'));
    }

    public function store(Request $request)
    {
        $enpath = base_path('resources/lang/en.json');
        $enc =File::get($enpath);
        $eng = (array) json_decode($enc);
        $eng[$request->key] = $request->eng; 
        $jsonEng = json_encode($eng);
        File::put($enpath, $jsonEng);

        
        $chpath = base_path('resources/lang/ch.json');
        $chc =File::get($chpath);
        $chin = (array) json_decode($chc);
        $chin[$request->key] = $request->chs;
        $jsonCh = json_encode($chin);
        File::put($chpath, $jsonCh);

        $tcpath = base_path('resources/lang/tc.json');
        $tcc =File::get($tcpath);
        $trad = (array) json_decode($tcc);
        $trad[$request->key] = $request->tch;
        $jsonTc = json_encode($trad);
        File::put($tcpath, $jsonTc);

        return back()->with('success', 'New Content Entry Successfull');

    }
    public function update(Request $request)
    {
        $enpath = base_path('resources/lang/en.json');
        $enc =File::get($enpath);
        $eng = (array) json_decode($enc);
        $eng[$request->key] = $request->eng; 
        $jsonEng = json_encode($eng);
        File::put($enpath, $jsonEng);

        
        $chpath = base_path('resources/lang/ch.json');
        $chc =File::get($chpath);
        $chin = (array) json_decode($chc);
        $chin[$request->key] = $request->chs;
        $jsonCh = json_encode($chin);
        File::put($chpath, $jsonCh);

        $tcpath = base_path('resources/lang/tc.json');
        $tcc =File::get($tcpath);
        $trad = (array) json_decode($tcc);
        $trad[$request->key] = $request->tch;
        $jsonTc = json_encode($trad);
        File::put($tcpath, $jsonTc);

        return back()->with('success', 'New Content Entry Successfull');

    }
    public function delete(Request $request)
    {
        $enpath = base_path('resources/lang/en.json');
        $enc =File::get($enpath);
        $eng = (array) json_decode($enc);
        unset($eng[$request->key]);
        $jsonEng = json_encode($eng);
        File::put($enpath, $jsonEng);

        
        $chpath = base_path('resources/lang/ch.json');
        $chc =File::get($chpath);
        $chin = (array) json_decode($chc);
        unset($chin[$request->key]);
        $jsonCh = json_encode($chin);
        File::put($chpath, $jsonCh);

        $tcpath = base_path('resources/lang/tc.json');
        $tcc =File::get($tcpath);
        $trad = (array) json_decode($tcc);
        unset($trad[$request->key]);
        $jsonTc = json_encode($trad);
        File::put($tcpath, $jsonTc);

        return back()->with('success', 'New Content Entry Successfull');

    }
}
