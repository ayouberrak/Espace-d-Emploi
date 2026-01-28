<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invitation;

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
        $requests = Invitation::where('sender_id','=',session('user_id'))
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
        $friends = Invitation::where('sender_id','=',session('user_id'))
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


    public function acceptInvi(){
        echo'heloooooo';
    }



}
