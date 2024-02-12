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

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'mobile_number' => 'required|string|min:6',
        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'user_role' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
        ]);
    }
}
