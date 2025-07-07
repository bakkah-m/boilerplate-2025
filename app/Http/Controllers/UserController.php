<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::orderBy('created_at', 'desc')->get();

        return view('users.index', [
            'data' => $data
        ]);
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
        try{

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required']
            ]);

            DB::beginTransaction();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);

            DB::commit();

            Alert::toast('Berhasil menambahkan data.', 'success');
            return redirect()->back();
        }catch(Exception $e){
            DB::rollBack();
            Alert::error('Error', 'Messages : ' . $e->getMessage());
            return redirect()->back();
        }
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
        try{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
                'role' => ['required']
            ]);

            DB::beginTransaction();

            $user = User::find($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'role' => $request->role
            ]);

            DB::commit();

            Alert::toast('Berhasil mengubah data.', 'success');
            return redirect()->back();
        }catch(Exception $e){
            DB::rollBack();
            Alert::error('Error', 'Messages : ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();

            User::find($id)->delete();

            DB::commit();

            Alert::toast('Berhasil menghapus data.', 'success');
            return redirect()->back();
        }catch(Exception $e){
            DB::rollBack();
            Alert::error('Error', 'Messages : ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
