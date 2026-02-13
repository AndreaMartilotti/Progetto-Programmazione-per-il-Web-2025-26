<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserRoleController extends Controller
{
    public function index(){
        $users=User::all();
        return view('founder.manage-users',compact('users'));
     }

    public function update(Request $request, User $user){
        $request->validate(['role'=>'required|string',]);
        $user->update(['role'=>$request->role,]);
        return back();
    }

    public function updateAll(Request $request){
        $rolesFromForm=$request->input('roles');
        if ($rolesFromForm){
            foreach ($rolesFromForm as $userId => $newRole) {
                \App\Models\User::where('id',$userId)->update(['role'=>$newRole]);
            }
        }//inserire filtri di ricerca e notifica di success sulla schermata
        return back()->with('success','Aggiornamento ruolo effettuato');
    }
}
