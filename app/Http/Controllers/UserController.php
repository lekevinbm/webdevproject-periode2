<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Redirect;


class UserController extends Controller
{
    /**
     * Show the profile of the user logged in.
     */
    public function index()
    {
        return view('user.profile');
    }

    /**
     * Open the page to edit the user.
     */
    public function openEditPage(){
        return view('user.edit');
    }

    /**
     * Edits the user with the data send with the form.
     */
    public function edit(Request $data){
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'streetAndNumber' => 'required|string',
            'zipcode' => 'required|string|max:10',
            'city' => 'required|string',
            'country' => 'required|string',
            'phoneNumber' => 'required|string',
            'VAT_number' => 'string',
            'accountNumber' => 'required|string',
        ]);

        if ($validator->passes()) { 
            
            Auth::user()->name = $data['name'];            
            Auth::user()->email = $data['email'];
            Auth::user()->streetAndNumber = $data['streetAndNumber'];
            Auth::user()->zipcode = $data['zipcode'];
            Auth::user()->city = $data['city'];
            Auth::user()->country = $data['country'];
            Auth::user()->phoneNumber = $data['phoneNumber'];
            Auth::user()->VAT_number = $data['VAT_number'];
            Auth::user()->accountNumber = $data['accountNumber'];
            Auth::user()->save();

            return redirect('/user');
        }
        return Redirect::back()->withErrors($validator);
    }

    /**
     * Deletes the user
     */
    public function delete(){
        Auth::user()->delete();
        return redirect('/');
    }
}