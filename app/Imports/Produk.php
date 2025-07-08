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
        return 2; 
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $col) {
           
            if (!isset($col[1]) || !isset($col[2])) {
                continue;
            }

            $produkLama = ModelProduk::where('kode', $col[1])->first();

            if (!$produkLama) {
                $simpan = new ModelProduk();
                $simpan->kode = $col[1];      
                $simpan->barcode = $col[2];    
                $simpan->nama = $col[3];       
                $simpan->harga = preg_replace('/[^\d]/', '', $col[4]); 
                $simpan->stok = 10;
                $simpan->save();

            }
        }
    }
}
