<?php

namespace App\Http\Controllers;

use App\Models\Habeahan;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index');
    }

    public function gorat()
    {
        return view('landing.tarombo.gorat.index');
    }
    public function bondar()
    {
        return view('landing.tarombo.bondar.index');
    }
    public function habeahan()
    {
        return view('landing.tarombo.habeahan.index');
    }

    public function rajaPasaribu()
    {
        return view('landing.tarombo.raja-pasaribu.index');
    }

    public function habeahanDetail(Request $request)
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

        return view('landing.tarombo.habeahan.detail', [
            'data' => $paginatedItems,
            'filters' => [
                'sundut' => $sundutFilter,
                'letter' => $letterFilter,
                'name' => $nameFilter,
            ],
        ]);
    }
}
