<?php

namespace App\Http\Controllers;

use App\Helpers\TransactionWrapper;
use App\Http\Controllers\Traits\HasGrid;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    protected array $gridColumns = ['id', 'name', 'email', 'role'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'columns' => $this->gridColumns,
        ]);
    }

    public function grid(Request $request)
    {
        $query = User::query();

        // Apply filters
        if ($filters = $request->get('filter')) {
            foreach ($filters as $field => $value) {
                if (in_array($field, $this->gridColumns) && $value !== '') {
                    $query->where($field, 'like', "%{$value}%");
                }
            }
        }

        if ($search = $request->string('search')->trim()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $sort = $request->get('sort', 'id');
        $dir = $request->get('dir', 'asc');
        if (in_array($sort, $this->gridColumns)) {
            $query->orderBy($sort, $dir);
        }

        // Paginate results
        $perPage = $request->integer('limit', 10); // items per page
        $page = $request->integer('page') + 1;   // current page

        Log::info($page . '-'. $perPage);
        

        $data = $query->paginate($perPage, ['*'], 'page', $page);


        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return TransactionWrapper::run(function () use ($request) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required']
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
        }, 'Berhasil menambahkan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return TransactionWrapper::run(function () use ($request, $id) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
                'role' => ['required']
            ]);

            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'role' => $request->role
            ]);
        }, 'Berhasil mengubah data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        return TransactionWrapper::run(function () use ($id) {
            User::find($id)->delete();
        });
    }
}
