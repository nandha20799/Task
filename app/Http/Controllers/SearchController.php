<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $val = $request->search;

        $query = User::query()->with(['department', 'designation']);

        if (!empty($val)) {
            $query->where(function ($query) use ($val) {
                $query->where('name', 'LIKE', "%{$val}%")
                    ->orWhereHas('department', function ($q) use ($val) {
                        $q->where('name', 'LIKE', "%{$val}%");
                    })
                    ->orWhereHas('designation', function ($q) use ($val) {
                        $q->where('name', 'LIKE', "%{$val}%");
                    });
            });
        }

        $users = $query->get();

        return response()->json($users);
    }

}
