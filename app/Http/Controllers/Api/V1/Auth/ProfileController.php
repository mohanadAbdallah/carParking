<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user()->only('name','email'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
           'name'=> ['required' ,'string'],
           'email' =>['required','email',Rule::unique('users')->ignore(auth()->user())]
        ]);
        auth()->user()->update($validatedData);
        return response()->json($validatedData, Response::HTTP_ACCEPTED);

    }
}