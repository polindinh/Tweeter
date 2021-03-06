<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Profile;
use Auth;
use Image;
use App\User;
use Storage;
use Illuminate\Support\Facades\Redirect;


class ProfilesController extends Controller
{
    public function showProfile(Request $request){
        $profiles = \App\Profile::where('user_id','=',$request->id)->get();
        $tweets = \App\Tweet::where('user_id', '=', $request->id )->get();
        $users = \App\User::find($request->id);
        return view('profiles.profile', ['profiles'=> $profiles,'tweets'=>$tweets,'users'=>$users]);
    }

    public function showGuestProfile(Request $request){
        $profiles = \App\Profile::where('user_id','=',$request->id)->first();
        $tweets = \App\Tweet::where('user_id', '=', $request->id )->get();
        $users = \App\User::find($request->id);
        return view('profiles.allprofiles', ['profiles'=> $profiles,'tweets'=>$tweets,'users'=>$users]);
    }

    public function addProfile(Request $request){
            if($request->hasFile('profile_pic')){
                $validateData = $request->validate(['date_of_birth'=>'required',
                                                    'gender'=>'required',
                                                    'quote'=>'required|max:100',
                                                    'profile_pic'=>'required|image|max:5000',

                                            ]);

                $profiles = new \App\Profile;
                $profiles -> name = Auth::user()->name;
                $profiles -> user_id = Auth::user()->id;
                $profiles -> date_of_birth = $request->date_of_birth;
                $profiles -> gender = $request->gender;
                $profiles -> quote = $request->quote;
                $profiles -> profile_pic = $request->profile_pic->store('profile_images','public');
                $profiles -> save();
                $result = \App\Profile::all();

                return Redirect::route('home', ['profiles'=>$result])->with('success','Your profile has been created successfully!');
            }
            return redirect('home');
    }
    public function updateForm($id){
        $profiles = \App\Profile::where('id','=',$id)->get();
        return view('profiles.updateprofile', ['profiles'=> $profiles]);
    }

    public function updateProfile(Request $request){
        if($request->hasFile('profile_pic')){
            $validateData = $request->validate(['date_of_birth'=>'required',
                                                'gender'=>'required',
                                                'quote'=>'required|max:100',
                                                'profile_pic'=>'image|max:5000',
                                        ]);

        $profiles = \App\Profile::find($request->id);
        $profiles -> user_id = $request->user_id;
        $profiles -> date_of_birth = $request->date_of_birth;
        $profiles -> gender = $request->gender;
        $profiles -> quote = $request->quote;
        $profiles -> profile_pic = $request->profile_pic->store('profile_images','public');
        $profiles -> save();
        // $result = \App\Profile::where('id','=',$id)->get();
        return Redirect::route('home')->with('success','Your profile has been updated successfully!');
        // return view('profiles.updateprofile', ['profiles'=> $profiles]);

        }else{
            $validateData = $request->validate(['date_of_birth'=>'required',
                                                'gender'=>'required',
                                                'quote'=>'required|max:100',
                                                // 'profile_pic'=>'image|max:5000',
                                        ]);

        $profiles = \App\Profile::find($request->id);
        $profiles -> user_id = $request->user_id;
        $profiles -> date_of_birth = $request->date_of_birth;
        $profiles -> gender = $request->gender;
        $profiles -> quote = $request->quote;
        // $profiles -> profile_pic = $request->profile_pic->store('profile_images','public');
        $profiles -> save();
        // $result = \App\Profile::all();
        return Redirect::route('home')->with('success','Your profile has been updated successfully!');

        }

    }
    public function deleteProfile(Request $request){
        $profile= \App\Profile::find($request->id);
        if($profile->user_id == Auth::user()->id){
            \App\Profile::destroy($request->id);
            $result = \App\Profile::all();
            return Redirect::route('home', ['profiles'=>$result])->with('success','Your profile has been deleted successfully!');
        }else{
            return Redirect::route('home', ['profiles'=>$result])->with('warning', 'You can only delete your own profile');
        }
    }

    function deleteProfileConfirm(Request $request){
        $profile = \App\Profile::find($request->id);
        return view('profiles.confirm',['profile'=>$profile]);

    }

}
