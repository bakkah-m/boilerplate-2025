<?php

function parseLine($line)
{
    // Ambil pola: {urutan}. {nomor_sundut}. {sisa}
    if (! preg_match('/^\s*(\d+)\.\s*([\d]+b?\/\d+)\.\s*(.+)$/u', $line, $m)) {
        return null;
    }

    $nomorSundut = $m[2];
    $rest = trim($m[3]);

    // pecah nama dan wilayah (pakai "h;" sebagai pemisah wilayah)
    $nama = $rest;
    $wilayah = null;
    if ((strpos($rest, 'h;') || strpos($rest, 'h:')) !== false) {

        $parts = explode('h;', $rest, 2);

        if (count($parts) < 2) {
            $parts = explode('h:', $rest, 2);
        }

        // Pastikan selalu ada 2 elemen
        [$namaPart, $wilayahPart] = array_pad($parts, 2, null);

        $nama = trim($namaPart);
        $wilayah = trim($wilayahPart);
    }

    // parsing nomor sundut (contoh: 1/3 atau 1b/3)
    preg_match('/^(\d+)(b?)[\/](\d+)$/i', $nomorSundut, $parts);

    return [
        'id' => uuid_create(UUID_TYPE_RANDOM),
        'nama' => $nama,
        'wilayah' => $wilayah,
        'sundut' => $m[1],
        'jenis_kelamin' => strtolower($parts[2]) === 'b' ? 'P' : 'L',
        'urutan_lahir' => (int) $parts[1],
        'jumlah_saudara' => (int) $parts[3],
    ];
}

function sortByParentChild($items, $parentId = null)
{
    $sorted = [];

    // ambil semua item yang parent_id = $parentId
    foreach ($items->where('parent_id', $parentId) as $item) {
        $sorted[] = $item; // parent dulu
        // tambahkan anak secara rekursif
        $sorted = array_merge($sorted, sortByParentChild($items, $item->id));
    }

    return $sorted;
}

function randomPastelTailwind($index)
{
    // Predefined pastel palette
    $colors = [
        1 => '#d8b4fe', // purple
        2 => '#f9a8d4', // pink
        3 => '#7cfa7cff', // green
        4 => '#fcd34d',
        5 => '#a5f3fc', // cyan
        6 => '#93c5fd', // blue
        7 => '#fde68a', // amber
        8 => '#fbcfe8', // rose
        9 => '#c7d2fe', // indigo
        10 => '#fecdd3', // soft red
        11 => '#fef9c3', // light yellow
        12 => '#bef264', // lime
        13 => '#a7f3d0', // mint green
        14 => '#bae6fd', // sky blue
        15 => '#e9d5ff', // violet
        16 => '#fda4af', // pastel red
        17 => '#fef3c7', // cream
        18 => '#d9f99d', // light lime
        19 => '#f5d0fe', // soft purple
        20 => '#c4b5fd', // light indigo
        21 => '#fcd5ce', // peach
        22 => '#ffddd2', // coral
        23 => '#e2f0cb', // pistachio
        24 => '#b5ead7', // aquamarine
        25 => '#caffbf', // mint
        26 => '#fdffb6', // pale yellow
        27 => '#9bf6ff', // baby blue
        28 => '#a0c4ff', // powder blue
        29 => '#bdb2ff', // lavender
        30 => '#ffc6ff', // lilac pink
    ];

    // Fallback: cycle through the palette if index > count
    $keys = array_keys($colors);

    return $colors[$index] ?? $colors[$keys[($index - 1) % count($colors)]];
}

function turnToLetter($number)
{
    $alphabet = range('A', 'Z');
    return $alphabet[$number - 1];
}