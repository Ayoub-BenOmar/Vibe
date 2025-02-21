<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class MmemberController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');

        $users = User::where('name', 'like', "%{$search}%")
            ->orWhere('username', 'like', "%{$search}%")
            ->orWhere('bio', 'like', "%{$search}%")
            // Add any other fields you want to search
            ->get();

        return response()->json($users);
    }
}
