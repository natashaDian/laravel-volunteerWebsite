<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class CompanyProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('company.profile.edit', [
            'company' => $request->user('company'),
        ]);
    }

    public function update(Request $request)
    {
        $company = $request->user('company');

        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ]);

        $company->update($request->only('name', 'email'));

        return back()->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request)
    {
        $company = $request->user('company');

        $request->validate([
            'current_password' => ['required', 'current_password:company'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $company->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('status', 'password-updated');
    }

    public function destroy(Request $request)
    {
        $company = $request->user('company');

        $request->validate([
            'password' => ['required', 'current_password:company'],
        ]);

        $company->delete();

        auth('company')->logout();

        return redirect('/')->with('status', 'company-deleted');
    }
}
