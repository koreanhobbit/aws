<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\profilesocialmedia;
use App\profileattribute;
use App\teamprofile;
use Illuminate\Validation\Rule;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailNewUser;
use App\Mail\changePassword;
use Illuminate\Support\Facades\Gate;


class TeamProfileController extends Controller
{
    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'month' => ['required'],
        'date' => ['required','date_format:d'],
        'year' => ['required','date_format:Y'],
        'job_title' => ['required'],
        'location' => ['required'],
    ]; 

    public function index() {
        $users = User::orderBy('id', 'asc')->simplePaginate(5, ['*'], 'teamprofilepage');
    	return view('admin.teamprofile.index', compact('users'));
    }

    public function create() {
        $roles = Role::orderBy('id', 'asc')->get();
    	$profileImages = Image::orderBy('id','desc')->get();
        $socialMedias = profilesocialmedia::orderBy('id', 'asc')->get();
        $attributes = profileattribute::orderBy('id', 'asc')->get();
    	return view('admin.teamprofile.partials._create', compact('profileImages', 'socialMedias', 'attributes', 'roles'))->render();
    	
    }

    public function reloadImageList(Request $request) {
        $profileImages = Image::orderBy('id', 'desc')->get();
        if($request->ajax()) {
            return view('admin.teamprofile.partials._profileimglist', compact('profileImages'))->render();
        }
    }

    public function store(Request $request) {
        $this->validate($request, $this->rules);
        foreach(profileattribute::get() as $attribute) {
            $this->validate($request, [
                    $attribute->name => ['nullable','integer','between:0,100'],
                ]);
        }

        foreach(profilesocialmedia::get() as $item) {
            $this->validate($request, [
                    $item->name => ['nullable','url'],
                ]);
        }

        $birthday = $request->year . "-" . $request->month . "-" .$request->date; 

        $rand_pass = str_random(8);

        $profile = new User;

        $role = Role::find($request->user_role);


        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->password = Hash::make($rand_pass);
        $profile->job_title = $request->job_title;
        $profile->user_status = $request->user_status;
        //$profile->remember_token = $request->_token;
        $profile->save();

        $profile->teamprofile()->create([
            'month' => $request->month,
            'date' => $request->date,
            'year' => $request->year,
            'birthday' => $birthday,
            'location' => $request->location,
            'description' => $request->description,

        ]);


        foreach(profilesocialmedia::get() as $socmed) {
            $socmedName = $socmed->name;
            if(!empty($request->$socmedName)) {
                $socmed = $profile->profilesocialmedias()->attach($socmed, ['link' => $request->$socmedName]);
            }
        }

        foreach(profileattribute::get() as $attr) {
            $attrName = $attr->name;
            if(!empty($request->$attrName)) {
                $attr = $profile->profileattributes()->attach($attr, ['value' => $request->$attrName]);
            }
        }

        $imageId = $request->imageid;
        $image = Image::where('id', '=', $imageId)->get();
        $image = $profile->images()->attach($image);

        $profile->roles()->save($role);

        Mail::to($profile)->queue(new EmailNewUser($profile, $rand_pass));

        $users = User::orderBy('id', 'asc')->simplePaginate(5, ['*'], 'teamprofilepage');

        if($request->ajax()) {
            return view('admin.teamprofile.partials._list', compact('users'))->render();
        }
        
        return view('admin.teamprofile.index', compact('users'));
    }

    public function edit(Request $request, User $tp) {
        $roles = Role::orderBy('id', 'asc')->get();
        $profileImages = Image::orderBy('id','desc')->get();
        $socialMedias = profilesocialmedia::orderBy('id', 'asc')->get();
        $attributes = profileattribute::orderBy('id', 'asc')->get();
        if($request->ajax()) {
            return view('admin.teamprofile.partials._edit', compact('tp', 'profileImages', 'socialMedias', 'attributes', 'roles'))->render();
        }
        return "This browser doesn't support this website. Please update your browser or use different browser. Thank You";
    }

    public function myprofile(Request $request, User $tp)
    {
        $roles = Role::orderBy('id', 'asc')->get();
        $profileImages = Image::orderBy('id','desc')->get();
        $socialMedias = profilesocialmedia::orderBy('id', 'asc')->get();
        $attributes = profileattribute::orderBy('id', 'asc')->get();

        return view('admin.teamprofile.myprofile', compact('tp', 'profileImages', 'socialMedias', 'attributes', 'roles'));
    }

    public function update(Request $request, User $tp) {
        $this->validate($request,[
                'name' => ['required'],
                'month' => ['required'],
                'date' => ['required','date_format:d'],
                'year' => ['required','date_format:Y'],
                'job_title' => ['required'],
                'location' => ['required'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($tp->id)],
                'current_password' => ['nullable'],
                'password' => ['required_with:current_password', 'same:password'],
                'password_confirmation' => ['required_with:current_password', 'same:password'],

            ]
        );

        foreach(profileattribute::get() as $attribute) {
            $this->validate($request, [
                    $attribute->name => ['nullable','integer','between:0,100'],
                ]);
        }

        foreach(profilesocialmedia::get() as $item) {
            $this->validate($request, [
                    $item->name => ['nullable','url'],
                ]);
        }

        $role = Role::find($request->user_role);

        $tp->roles()->detach();

        $birthday = $request->year . "-" . $request->month . "-" .$request->date;

        $tp->name = $request->name;
        $tp->email = $request->email;
        $tp->job_title = $request->job_title;
        $tp->user_status = $request->user_status;
        if (!empty($request->current_password)) {
            $tp->password = Hash::make($request->password);
        }
        
        $tp->save();

        $tp->teamprofile->month = $request->month;
        $tp->teamprofile->date = $request->date;
        $tp->teamprofile->year = $request->year;
        $tp->teamprofile->birthday = $birthday;
        $tp->teamprofile->location = $request->location;
        $tp->teamprofile->description = $request->description;

        $tp->teamprofile->save();


        $tp->profilesocialmedias()->detach();
        foreach(profilesocialmedia::get() as $socmed) {
            $socmedName = $socmed->name;
            if(!empty($request->$socmedName)) {
                $socmed = $tp->profilesocialmedias()->attach($socmed, ['link' => $request->$socmedName]);
            }
        }

        $tp->profileattributes()->detach();
        foreach(profileattribute::get() as $attr) {
            $attrName = $attr->name;
            if(!empty($request->$attrName)) {
                $attr = $tp->profileattributes()->attach($attr, ['value' => $request->$attrName]);
            }
        }

        $tp->images()->detach();
        $imageId = $request->imageid;
        $image = Image::where('id', '=', $imageId)->get();
        $image = $tp->images()->attach($image);

        $tp->roles()->attach($role);

        if (!empty($request->current_password)) {
            $new_pass = $request->password; 
            Mail::to($tp)->queue(new changePassword($tp, $new_pass));
        }

        $users = User::orderBy('id', 'asc')->simplePaginate(5, ['*'], 'teamprofilepage');

        if($request->ajax()) {
            return view('admin.teamprofile.partials._list', compact('users'))->render();
        }
        
        return view('admin.teamprofile.index', compact('users'));

    } 

    public function destroy(Request $request, User $tp) {
        $tp->images()->detach();
        $tp->profileattributes()->detach();
        $tp->profilesocialmedias()->detach();
        $tp->delete();
        session()->flash('message', 'Team Profile Deleted Successfully!');

        $users = User::orderBy('id', 'asc')->simplePaginate(5, ['*'], 'teamprofilepage');

        if($request->ajax()) {
            return view('admin.teamprofile.partials._list', compact('users'))->render();
        }

        return view('admin.teamprofile.index', compact('users'));
    }
}
