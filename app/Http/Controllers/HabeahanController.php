<?php

namespace App\Http\Controllers;

use App\Models\Habeahan;
use DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HabeahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil nilai filter dari query string (opsional)
        $sundutFilter = $request->query('sundut_filter');
        $letterFilter = $request->query('letter_filter');
        $nameFilter = $request->query('name_filter');

        // Mulai query dasar
        $query = Habeahan::query();

        // Terapkan filter sundut (generasi)
        if (! empty($sundutFilter)) {
            $query->where('sundut', $sundutFilter);
        }

        // Terapkan filter abjad (huruf pertama nama)
        if (! empty($letterFilter)) {
            $query->where('nama', 'LIKE', $letterFilter.'%');
        }

        // Terapkan filter nama (pencarian sebagian)
        if (! empty($nameFilter)) {
            $query->where('nama', 'LIKE', '%'.$nameFilter.'%');
        }

        // Ambil data acak berdasarkan filter yang diterapkan
        $habeahans = $query->inRandomOrder()->get();

        // Buat map parent_id => children
        $map = [];
        foreach ($habeahans as $item) {
            $map[$item->parent_id][] = $item;
        }

        // Fungsi rekursif untuk sorting
        function sortByParentChildMap($map, $parentId = null)
        {
            $sorted = [];

            if (! isset($map[$parentId])) {
                return [];
            }

            $children = $map[$parentId];
            usort($children, function ($a, $b) {
                // 1. Laki-laki dulu
                if ($a->jenis_kelamin !== $b->jenis_kelamin) {
                    return $a->jenis_kelamin === 'L' ? -1 : 1;
                }

                // 2. urutan lahir
                return $a->urutan_lahir <=> $b->urutan_lahir;
            });

            foreach ($children as $item) {
                $sorted[] = $item;
                $sorted = array_merge($sorted, sortByParentChildMap($map, $item->id));
            }

            return $sorted;
        }

        $sortedHabeahans = $habeahans;
        
        if(empty($sundutFilter) && empty($letterFilter) && empty($nameFilter)){
            
            $sortedHabeahans = sortByParentChildMap($map);
        }


        // Pagination manual
        $page = request()->get('page', 1);
        $perPage = 10;
        $items = collect($sortedHabeahans);


        $paginatedItems = new \Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('habeahan.index', [
            'data' => $paginatedItems,
            'filters' => [
                'sundut' => $sundutFilter,
                'letter' => $letterFilter,
                'name' => $nameFilter,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id = $request->query('id');

        $parent = Habeahan::find($id);

        return view('habeahan.create', compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {

                $habeahan = Habeahan::create([
                    'identifier' => uuid_create(),
                    'nama' => $request->nama,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'sundut' => $request->sundut,
                    'urutan_lahir' => $request->urutan_lahir,
                    'jumlah_saudara' => $request->jumlah_saudara,
                    'parent_id' => $request->parent_id,
                    'wilayah' => $request->wilayah,
                ]);
            });

            Alert::toast('Berhasil menambahkan data.', 'success');

            return redirect()->route('habeahan.index');
        }catch(\Exception $e){
            Alert::toast($e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Habeahan $habeahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Habeahan::find($id);
        return view('habeahan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            DB::transaction(function () use ($request, $id) {

                $habeahan = Habeahan::find($id);

                $habeahan->update([
                    'nama' => $request->nama,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'urutan_lahir' => $request->urutan_lahir,
                    'jumlah_saudara' => $request->jumlah_saudara,
                    'wilayah' => $request->wilayah,
                ]);
            });

            Alert::toast('Berhasil mengubah data.', 'success');
            return redirect()->route('habeahan.index');
        }catch(\Exception $e){
            Alert::toast($e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::transaction(function () use ($id) {

                $data = Habeahan::find($id);

                $children = Habeahan::where('parent_id', $data->id)->get();

                foreach ($children as $child) {
                    $child->delete();
                }
                $data->delete();
            });

            Alert::toast('Berhasil menghapus data.', 'success');
            return redirect()->route('habeahan.index');
        }catch(\Exception $e){
            Alert::toast($e->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
