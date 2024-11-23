<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\siteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function showsettings ()
    {
        return view ('backend.settings-policies.setting');
    }

    public function updateSettings (Request $request)
    {
        $getSiteSettings = siteSetting::first();

        $getSiteSettings->phone = $request->phone;
        $getSiteSettings->email = $request->email;
        $getSiteSettings->address = $request->address;
        $getSiteSettings->facebook = $request->facebook;
        $getSiteSettings->twitter = $request->twitter;
        $getSiteSettings->instagram = $request->instagram;
        $getSiteSettings->youtube = $request->youtube;

        if(isset($request->banner)){

            if($getSiteSettings->banner && file_exists('/backend/images/settings/'.$getSiteSettings->banner)){
                unlink('/backend/images/settings/'.$getSiteSettings->banner);
            }

            $imageName = rand().'-bannerupdate-'.'.'.$request->banner->extension();  //6578-bannerupdate-.jpg
            $request->banner->move('/backend/images/settings/',$imageName);
            $getSiteSettings->banner = $imageName;

        }

        if(isset($request->logo)){

            if($getSiteSettings->logo && file_exists('/backend/images/settings/'.$getSiteSettings->logo)){
               unlink('/backend/images/settings/'.$getSiteSettings->logo);
            
            }

            $imageName = rand().'-logoupdate-'.'.'.$request->logo->extension();
            $request->logo->move('/backend/images/settings/',$imageName);
            $getSiteSettings->logo = $imageName;

        }

        $getSiteSettings->save();
        toastr()->success('Updated Successfully');
        return redirect()->back();
    }
}
