<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Entreprise;
use App\Models\Profil;

class ProfileController extends Controller
{

    public function profile($id = null){
        
        $id = $id ?? Auth::id();
        $user = User::with('profile')->findOrFail($id);
        $isMe = Auth::id() === $user->id;
        $entreprise = null;
        
        if ($user->role === 'recruiter') {
            $entreprise = Entreprise::where('recruiter_id', $user->id)->first();
        }

        return view('users.profile',['user'=>$user , 'isMe' => $isMe, 'entreprise' => $entreprise]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile ?? new Profil(['user_id' => $user->id]);

        if ($request->has('section')) {
            switch ($request->section) {
                case 'general':
                    if ($request->hasFile('photo')) {
                        $path = $request->file('photo')->store('photos', 'public');
                        $user->photo = $path;
                        $user->save();
                    }
                    if ($request->hasFile('cover_image')) {
                        $path = $request->file('cover_image')->store('covers', 'public');
                        $user->cover_image = $path;
                        $user->save();
                    }
                    if ($request->has('title')) $profile->title = $request->input('title');
                    if ($request->has('bio')) $profile->bio = $request->input('bio');
                    if ($request->has('phone')) {
                        $user->phone = $request->input('phone');
                        $user->save();
                    }
                    break;
                case 'skills':
                    $profile->skills = $request->input('skills', []);
                    break;
                case 'experiances':
                    $experiances = $request->input('experiances', []);
                    $profile->experiances = array_values($experiances);
                    break;
                case 'projects':
                    $projectsInput = $request->input('projects', []);
                    $projectsFiles = $request->file('projects', []);

                    foreach ($projectsInput as $index => &$project) {
                        if (isset($projectsFiles[$index]['image'])) {
                            $path = $projectsFiles[$index]['image']->store('projects', 'public');
                            $project['image'] = $path;
                        }
                    }
                    $profile->projects = array_values($projectsInput);
                    break;
                case 'entreprise':
                    $entreprise = Entreprise::where('recruiter_id', $user->id)->first();
                    if (!$entreprise) {
                        $entreprise = new Entreprise();
                        $entreprise->recruiter_id = $user->id;
                        $entreprise->create = now();
                    }
                    
                    if ($request->has('entreprise_nom')) $entreprise->nom = $request->input('entreprise_nom');
                    if ($request->has('entreprise_description')) $entreprise->description = $request->input('entreprise_description');
                    if ($request->has('entreprise_location')) $entreprise->location = $request->input('entreprise_location');
                    
                    if ($request->hasFile('entreprise_logo')) {
                        $path = $request->file('entreprise_logo')->store('entreprises', 'public');
                        $entreprise->logo = $path;
                    }
                    
                    $entreprise->save();
                    break;
            }
        } else {
            if ($request->has('title')) $profile->title = $request->input('title');
            if ($request->has('bio')) $profile->bio = $request->input('bio');
            if ($request->has('skills')) $profile->skills = $request->input('skills');
            if ($request->has('experiances')) $profile->experiances = $request->input('experiances');
            if ($request->has('projects')) $profile->projects = $request->input('projects');
            
            if ($request->has('phone')) {
                $user->phone = $request->input('phone');
                $user->save();
            }
        }

        $profile->save();

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Profil mis à jour avec succès', 'profile' => $profile]);
        }

        return redirect()->back()->with('success', 'Profil mis à jour avec succès !');
    }
}