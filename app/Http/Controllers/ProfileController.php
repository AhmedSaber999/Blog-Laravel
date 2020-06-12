<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Profile;
use Auth;

class ProfileController extends Controller
{
    
    public function index()
    {
        $user_id = Auth::user()->id ;
        $profile = Profile::join("users", "users.id", "profiles.user_id")
        ->where("users.id", $user_id)
        ->select("users.*", "profiles.*")
        ->first() ;
        return view('profiles.profile', ["profile" => $profile]);
    }

    public function update_profile(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'profile_pic' => 'required',
        ]);
        $profile = new Profile;
        $profile->name = $request->input('name');
        $profile->description = $request->input('description');
        $profile->user_id = Auth::user()->id;
        if($request->hasFile('profile_pic')){
            $image = $request->file('profile_pic');    
            $image->move(public_path().'/Images/', $image->getClientOriginalName());
            $url = '/Images' . $image->getClientOriginalName(); 
            $profile->profile_pic = $url;
            $profile->save();
            return redirect('/profile')->with('response', 'Your profile was updated successfully');
        }  
        session()->flash('danger', "Obss! try again plz");
        return redirect('/profile');  
    }

}
