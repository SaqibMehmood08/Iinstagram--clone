<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class profileController extends Controller
{   public function index(User $user)
    {
        
    $follows=(auth()->user()) ? auth()->user()->following->contains($user->id):false;
 
    $postCount=Cache::remember('count.post.'.$user->id,
    now()->addSeconds(30),
    function () use($user){
        return $user->posts->count();
    });

    $followersCount=Cache::remember('count.post.'.$user->id,
    now()->addSeconds(30),
    function () use($user){
        return  $user->profile->followers->count();
    });

 
    $followingCount=Cache::remember('count.post.'.$user->id,
    now()->addSeconds(30),
    function () use($user){
    
    return $user->following ->count();  
});

         return view('profiles.index', compact('user', 'follows','postCount','followersCount','followingCount'));
      
    }
    public function edit(User $user){

    $this->authorize('update', $user->profile);

      return view('profiles.edit',compact('user'));
    }
    public function update(User $user){
    $this->authorize('update', $user->profile);

        $data=request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'',

        ]);
        if(request('image')){
            $imagePath=(request('image')->store('profile','public'));
            $image=Image::make(public_path("storage/{$imagePath}"))->fit(800,800);
            $image->save();

            $imageArray=['image'=>$imagePath];

        }
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []

        ));

        return redirect("/profile/{$user->id}");
    }
}
