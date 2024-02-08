<?php

namespace App\Http\Controllers;

use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
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
        $per_page = $request->query('per_page');

        if (!$per_page) {
            $per_page = 5;
        }

        $users = UserRole::paginate($per_page);
        return response()->json(
            ['status' => 'success', 'data' => $users],
        );
    }

    public function getDetail($id)
    {
        $role = UserRole::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        return response()->json(
            ['status' => 'success', 'data' => $role],
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string',
        ]);

        $user = Auth::user();

        $user_role = UserRole::create([
            'role_name' => $request->role_name,
            'created_by' => $user->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully',
            'user_role' => $user_role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $role = UserRole::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $user = Auth::user();

        $role->update([
            'role_name' => $request->role_name,
            'updated_by' => $user->name // You can add an 'updated_by' field if needed
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Role updated successfully',
            'user_role' => $role,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = UserRole::find($id);
        if (!$role) {
            return response()->json(['message' => 'Role not found'], 404);
        }
        $role->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully',
        ]);
    }
}
