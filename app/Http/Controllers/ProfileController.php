<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Transaction;
use App\Models\Category;

class ProfileController extends Controller
{
    
    public function show()
    {
        $user = Auth::user();
        
       
        if (!$user) {
            return redirect()->route('login');
        }
        
        
        \Log::info('User ID: ' . $user->id);
        
        
        $totalTransactions = Transaction::where('user_id', $user->id)->count();
        $totalCategories = Category::where('user_id', $user->id)->count();
        $daysSinceJoined = $user->created_at->diffInDays(now());
        
        
        \Log::info('Total Transactions: ' . $totalTransactions);
        \Log::info('Total Categories: ' . $totalCategories);
        \Log::info('Days Since Joined: ' . $daysSinceJoined);
        
        $stats = [
            'totalTransactions' => $totalTransactions,
            'totalCategories' => $totalCategories,
            'daysSinceJoined' => $daysSinceJoined,
        ];

        
        dd($stats); 
        
        return view('profile', compact('stats'));
    }

   
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('profile')->with('success', 'Password changed successfully!');
    }
}