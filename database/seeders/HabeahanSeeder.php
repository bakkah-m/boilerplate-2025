<?php

namespace Database\Seeders;

use App\Models\Habeahan;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class HabeahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('database/source/habeahan.xlsx');

        $rows = Excel::toCollection(null, $path)->first();

        $rows = $rows->skip(2);

        $data = [];

        foreach ($rows as $index => $row) {

            $row = $row->skip(1);

            foreach ($row as $r) {
                if ($r != null) {
                    $data[$index] = parseLine($r);

                    $parent = null;

                    if (! isset($data[$index]['sundut'])) {
                        dd($index, $r, $row);
                    }

                    $thisGeneration = $data[$index]['sundut'];

                    $parentSundut = $thisGeneration - 1;

                    if ($thisGeneration > 1) {

                        $reversed = array_reverse($data);

                        foreach ($reversed as $k => $d) {
                            if ($d['sundut'] == $parentSundut) {
                                $parent = $d;
                                $data[$index]['orang_tua'] = [
                                    'name' => $parent['nama'],
                                    'index' => $parent['id'],
                                ];
                                break;
                            }
                        }
                    } else {
                        $data[$index]['orang_tua'] = null;
                    }
                }
            }

        }

        foreach ($data as $i => $d) {
            Habeahan::create([
                'nama' => $d['nama'],
                'identifier' => $d['id'],
                'jenis_kelamin' => $d['jenis_kelamin'],
                'sundut' => $d['sundut'],
                'urutan_lahir' => $d['urutan_lahir'],
                'jumlah_saudara' => $d['jumlah_saudara'],
                'parent_id' => $d['orang_tua'] ? Habeahan::where('identifier', $d['orang_tua']['index'])->first()->id : null,
                'wilayah' => $d['wilayah'],
            ]);
        }

    }
}
