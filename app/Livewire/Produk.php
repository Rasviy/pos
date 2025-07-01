<?php

namespace App\Livewire;

use App\Models\Produk as ModelProduk;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Produk as ImporProduk;

class Produk extends Component
{
    use WithFileUploads;

    public $pilihanMenu = 'lihat';
    public $nama;
    public $kode;
    public $harga;
    public $stok;
    public $produkTerpilih;
    public $fileExcel;

    public function mount()
    {
        if (auth()->user()->peran != 'admin') {
            abort(403);
        }
    }

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset(['nama', 'kode', 'harga', 'stok', 'produkTerpilih', 'fileExcel']);
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'unique:produks,kode'],
            'barcode' => 'required|digits:12',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        ModelProduk::create([
            'nama' => $this->nama,
            'kode' => $this->kode,
            'harga' => $this->harga,
            'stok' => $this->stok,
        ]);

        session()->flash('sukses', 'Produk berhasil ditambahkan');
        $this->pilihMenu('lihat');
    }

    public function pilihEdit($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->nama = $this->produkTerpilih->nama;
        $this->kode = $this->produkTerpilih->kode;
        $this->harga = $this->produkTerpilih->harga;
        $this->stok = $this->produkTerpilih->stok;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required',
            'kode' => ['required', 'unique:produks,kode,' . $this->produkTerpilih->id],
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $this->produkTerpilih->update([
            'nama' => $this->nama,
            'kode' => $this->kode,
            'harga' => $this->harga,
            'stok' => $this->stok,
        ]);

        session()->flash('sukses', 'Produk berhasil diupdate');
        $this->pilihMenu('lihat');
    }

    public function pilihHapus($id)
    {
        $this->produkTerpilih = ModelProduk::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus()
    {
        $this->produkTerpilih->delete();
        session()->flash('sukses', 'Produk dihapus');
        $this->pilihMenu('lihat');
    }

    public function batal()
    {
        $this->pilihMenu('lihat');
    }

    public function imporExcel()
    {
        $this->validate([
            'fileExcel' => 'required|file|mimes:xlsx,xls',
        ]);

        Excel::import(new ImporProduk, $this->fileExcel->getRealPath());

        session()->flash('sukses', 'Data produk berhasil diimpor');
        $this->pilihMenu('lihat');
    }

    public function render()
    {
        return view('livewire.produk', [
            'semuaProduk' => ModelProduk::all(),
        ]);
    }
}
