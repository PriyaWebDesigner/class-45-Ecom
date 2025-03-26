<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function create ()
    {
        return view ('backend.banner.create');
    }
    public function store (Request $request)
    {
        $banner = new Banner();

        if(isset($request->image)){
            $imageName = rand().'-banner-'.'.'.$request->image->extension();
            $request->image->move('backend/images/banner/', $imageName);

            $banner->image = $imageName;
        }

        $banner->save();
        return redirect()->back();
    }

    public function show ()
    {
        $banners = Banner::get();
        return view ('backend.banner.list',compact('banners'));
    }

    public function delete ($id)
    {
        $banner = Banner::find($id);
        $banner->delete();

        return redirect()->back();
    }
    public function edit ($id)
    {
        $banner = Banner::find($id);
        return view ('backend.banner.edit',compact('banner'));
    }
    public function update (Request $request ,$id)
    {
        $banner = Banner::find($id);

        if(isset($request->image)){
            if($banner->image && file_exists('backend/images/banner/'.$banner->image)){
                unlink('backend/images/banner/'.$banner->image);
            }

            $imageName = rand().'-banner-'.'.'.$request->image->extension();
            $request->image->move('backend/images/banner',$imageName);
            $banner->image = $imageName;
        }

        $banner->save();
        toastr()->success('Successfully updated the review');
        return redirect()->back();
    }
}
