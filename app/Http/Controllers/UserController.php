<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query();

            return DataTables::eloquent($users)
                # add index column
                ->addIndexColumn()
                # customize date field
                ->addColumn('created_at', function ($user) {
                    return Carbon::parse($user->created_at)->format('d-m-Y');
                })
                # add raw action btn column
                ->addColumn('action', function ($user) {
                    return '<a href="' . route('users.edit', $user->id) . '" class="btn btn-info btn-sm">Edit</a>
                            <button data-id="' . $user->id . '" class="btn btn-danger btn-sm delete-user">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    // delete the user
    public function destory($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'User has been deleted successfully.']);
        }

        return response()->json(['status' => 'failed', 'message' => 'Something went wrong.']);
    }
}
