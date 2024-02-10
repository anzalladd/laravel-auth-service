<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roleIdToFilter = $request->query('role_id');
        $searchTerm = $request->query('search');
        $sortField = $request->query('sort_field');
        $sortOrder = $request->query('sort_order');

        $query = User::with('role');

        if ($roleIdToFilter !== null) {
            $query->whereHas('role', function ($query) use ($roleIdToFilter) {
                $query->where('role_id', $roleIdToFilter);
            });
        }

        if ($searchTerm !== null) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
    
        }

        $per_page = $request->query('per_page', 5);

        $sortOrder = strtoupper($sortOrder) === 'DESC' ? 'DESC' : 'ASC';

        if ($sortField !== null) {
            $query->orderBy($sortField, $sortOrder);
        }

        $users = $query->paginate($per_page);

        return response()->json(
            ['status' => 'success', 'data' => $users],
        );
    }

    public function getDetail($userId)
    {
        $user = User::with('role')->find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(
            ['status' => 'success', 'data' => $user],
        );
    }
}
