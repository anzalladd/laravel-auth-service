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

        $query = User::with('role');

        if ($roleIdToFilter !== null) {
            $query->whereHas('role', function ($query) use ($roleIdToFilter) {
                $query->where('role_id', $roleIdToFilter);
            });
        }

        $per_page = $request->query('per_page');

        if(!$per_page) {
            $per_page = 5;
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
