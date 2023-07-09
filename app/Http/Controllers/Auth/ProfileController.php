<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function update(Request $request)
   {
       $user = $request->user();
   
       $this->validate($request, [
           'first_name' => ['required', 'string', 'max:255'],
           'last_name' => ['required', 'string', 'max:255'],
           'pseudo' => ['required', 'string', 'max:255', 'unique:users,pseudo,'.$user->id],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
           'age' => ['required', 'integer', 'min:0', 'max:99'],
       ]);
   
       $user->first_name = $request->first_name;
       $user->last_name = $request->last_name;
       $user->pseudo = $request->pseudo;
       $user->email = $request->email;
       $user->age = $request->age;

       $user->save();
   
       return response()->json([
           'user' => $user,
           'message' => 'Les informations de l\'utilisateur ont été mises à jour avec succès.'
       ]);
   }
}