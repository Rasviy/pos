<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Produk as ModelProduk;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Produk implements ToCollection, WithStartRow
{
    public function startRow(): int
    {
        return 2; // mulai dari baris kedua (header di baris pertama)
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $col) {
            // Pastikan kolom kode dan nama ada
            if (!isset($col[1]) || !isset($col[2])) {
                continue; // skip jika kolom penting kosong
            }

            $produkLama = ModelProduk::where('kode', $col[1])->first();

            if (!$produkLama) {
                $simpan = new ModelProduk();
                $simpan->kode = $col[1];       // kolom B
                $simpan->barcode = $col[2];    // kolom C
                $simpan->nama = $col[3];       // kolom D
                $simpan->harga = preg_replace('/[^\d]/', '', $col[4]); // kolom E, hapus titik/koma
                $simpan->stok = 10;
                $simpan->save();

            }
        }
    }
}
