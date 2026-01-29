<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Models\User;

class inviController extends Controller
{    
    
    public function store($id){
        Invitation::create([
            'sender_id'=>session('user_id'),
            'resever_id'=>$id,
            'status'=>'pending',
            'created_at'=>NOW()
        ]);

        return redirect()->route('networkIndex');
    }

    public function showInvi(){
        $requests = Invitation::where('resever_id','=',session('user_id'))
                                ->where('status' , '=','pending')
                                ->get()
                                ->map(function($inv){
            return[
                'invitation' => [
                    'id' => $inv->id,
                    'status' => $inv->status,
                    'created_at' => $inv->created_at,
                ],

                'receiver' => [
                    'id' => $inv->receiver->id,
                    'name' => $inv->receiver->name,
                    'photo' => $inv->receiver->photo,
                    'title' => $inv->receiver->profile->title ?? null,
                ]
            ];
        });
        $friends = Invitation::where('resever_id','=',session('user_id'))
                                ->orWhere('sender_id','=',session('user_id'))
                                ->where('status' , '=','accepted')
                                ->get()
                                ->map(function($inv){
            return[
                'invitation' => [
                    'id' => $inv->id,
                    'status' => $inv->status,
                    'created_at' => $inv->created_at,
                ],

                'receiver' => [
                    'id' => $inv->receiver->id,
                    'name' => $inv->receiver->name,
                    'photo' => $inv->receiver->photo,
                    'title' => $inv->receiver->profile->title ?? null,
                ]
            ];
        });

        return view('network.index',["requests"=>$requests , 'friends'=>$friends]);
    }


    public function acceptInvi($id){
        $invi = Invitation::find($id);
        $invi->status = 'accepted';
        $invi->save();

        $user = User::find(session('user_id'));
        $amis = $user->amis ?? [];

        $friendId = $invi->sender_id == $user->id
            ? $invi->resever_id
            : $invi->sender_id;

        if (!in_array($friendId, $amis)) {
            $amis[] = $friendId;
            $user->amis = $amis;
            $user->save();
        }

       $otherUser = User::find($friendId);
        if ($otherUser) {
            $otherAmis = $otherUser->amis ?? [];
            if (!in_array($user->id, $otherAmis)) {
                $otherAmis[] = $user->id;
                $otherUser->amis = $otherAmis;
                $otherUser->save();
            }
        }
        
        return redirect()->route('networkIndex');
    }   

    public function declineInvi($id){
        $invi = Invitation::find($id);
        $invi->status = 'declined';
        $invi->save();

        return redirect()->route('networkIndex');
    }
}
