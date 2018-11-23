<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Social;
use App\Frontend;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FrontendController extends Controller
{

  public function aboutSection()
  {
      $front = Frontend::first();
      if(is_null($front))
      {
        $default = [
            'about_heading' => 'About Heading',
            'about_details' => 'about details',
            'about_image' => 'Image.jpg',
            'video' => 'videourl',
            'footer' => 'content',
            'contact_email' => 'content@email.com',
            'contact_number' => '010110010',
        ];
        Frontend::create($default);
        $front = Frontend::first();
      }
      $pt= "ABOUT SECTION";

      return view('admin.website.about', compact('front','pt'));
  }

  public function aboutUpdate(Request $request)
  {
      $front = Frontend::first();
      $this->validate($request,['about_heading' => 'required',
      'video' => 'required','about_details' => 'required',
      'about_image' => 'image|mimes:jpeg,png,jpg|max:4048',
       ]);

       if($request->hasFile('about_image'))
       {
            $oldpath = 'assets/images/frontend/'.$front->about_image;
            if(file_exists($oldpath))
            {
                unlink($oldpath);
            }

            $front['about_image'] = uniqid().'.'.$request->about_image->getClientOriginalExtension();
            $path = 'assets/images/frontend/'. $front['about_image'];
            Image::make($request->about_image)->resize(932, 538)->save($path);
       }

      $front['about_heading'] = $request->about_heading;
      $front['about_details'] = $request->about_details;
      $front['video'] = $request->video;
      $front->update();

      return back()->with('success','About Section Updated Successfully.');
  }

  public function footerSection()
  {
      $front = Frontend::first();
      if(is_null($front))
      {
        $default = [
            'about_heading' => 'About Heading',
            'about_details' => 'about details',
            'about_image' => 'Image.jpg',
            'video' => 'videourl',
            'footer' => 'content',
            'contact_email' => 'content@email.com',
            'contact_number' => '010110010',
        ];
        Frontend::create($default);
        $front = Frontend::first();
      }
      $pt= "FOOTER SECTION";

      return view('admin.website.footer', compact('front','pt'));
  }

  public function footerUpdate(Request $request)
  {
      $front = Frontend::first();
      $this->validate($request,['footer' => 'required',
      'contact_email' => 'required','contact_number' => 'required',
       ]);

      $front['footer'] = $request->footer;
      $front['contact_email'] = $request->contact_email;
      $front['contact_number'] = $request->contact_number;
      $front->update();

      return back()->with('success','Fooetr Section Updated Successfully.');
  }

  public function sliderSection()
  {
      $sliders = Slider::all();
      $pt= "MESSAGE SLIDER SECTION";
      return view('admin.website.slider', compact('sliders','pt'));
  }


  public function sliderStore(Request $request)
  {
      $this->validate($request,
          [
              'heading' => 'required',
          ]);
      $slider['heading'] = $request->heading;
      Slider::create($slider);

      return back()->with('success', 'New Slide Created Successfully!');
  }

 public function  sliderUpdate(Request $request, $id)
  {
      $slider = Slider::find($id);
      $this->validate($request,
      [
          'heading' => 'required',
      ]);
   
        $slider['heading'] = $request->heading;
        $slider->update();

      return back()->with('success', 'Slider Updated Successfully!');
  }

  public function  sliderDestroy($id)
  {
      $slider = Slider::findOrFail($id);
      $slider->delete();
      
      return back()->with('success', 'Slider Deleted Successfully!');
  }
  public function socialSection()
  {
      $socials = Social::all();
      $pt= "SOCIAL SECTION";
      return view('admin.website.social', compact('socials','pt'));
  }


  public function socialStore(Request $request)
  {
      $this->validate($request,
          [
              'icon' => 'required',
              'link' => 'required',
          ]);

      $social['icon'] = $request->icon;
      $social['link'] = $request->link;
      Social::create($social);

      return back()->with('success', 'New Social Icon Created Successfully!');
  }

 public function  socialUpdate(Request $request, $id)
  {
      $social = Social::find($id);
      $this->validate($request,
          [
              'icon' => 'required',
              'link' => 'required',
          ]);
          $social['icon'] = $request->icon;
          $social['link'] = $request->link;
        $social->update();

      return back()->with('success', 'Social Icon Updated Successfully!');
  }

  public function  socialDestroy($id)
  {
      $social = Social::findOrFail($id);
     
      $social->delete();
      
      return back()->with('success', 'Social Icon Deleted Successfully!');
  }
}
