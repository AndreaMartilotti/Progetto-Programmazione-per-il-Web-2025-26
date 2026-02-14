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
        }
        return back()->with('success','Aggiornamento ruolo effettuato');
    }

    public function search(Request $request){
        //recupero dalla value request 'search'
        $search=$request->input('search');
        //ricerca con valori simili all'interno della tabella
        if ($search) {
           $users=User::where('id', 'LIKE', "%$search%")
                       ->orWhere('name', 'LIKE', "%$search%")
                       ->orWhere('email', 'LIKE', "%$search%")
                       ->orWhere('role', 'LIKE', "%$search%")
                        ->get();
        } else {
            $users=User::all();
        }

        //per tornare alla stessa vista della gestione utenti
        return view('founder.manage-users',compact('users'));
    }
}
