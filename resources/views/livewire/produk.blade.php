
<style>
        body {
            background-color: #f1f3f9;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .btn-custom {
            border-radius: 8px;
            font-weight: 600;
            padding: 6px 14px;
        }

        .btn-custom:hover {
            opacity: 0.9;
        }

        .table thead {
            background-color: #e9ecef;
        }
    </style>
<div class="container">
    <div class="row mb-3">
        <div class="col-12">
            <button wire:click="pilihMenu('lihat')" class="btn btn-sm me-2 {{ $pilihanMenu=='lihat' ? 'btn-primary' : 'btn-outline-primary' }}">Semua Produk</button>
            <button wire:click="pilihMenu('tambah')" class="btn btn-sm me-2 {{ $pilihanMenu=='tambah' ? 'btn-success text-white' : 'btn-outline-success' }}">Tambah Produk</button>
            <button wire:click="pilihMenu('exel')" class="btn btn-sm me-2 {{ $pilihanMenu=='exel' ? 'btn-info text-white' : 'btn-outline-info' }}">Import Produk</button>
            <button wire:loading class="btn btn-sm btn-secondary">Loading...</button>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if($pilihanMenu=='lihat')
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">📦 Daftar Produk</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaProduk as $produk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->kode }}</td>
                                <td>{{ $produk->nama }}</td>
                                <td>Rp{{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td>{{ $produk->stok }}</td>
                                <td>
                                    <button wire:click="pilihEdit({{ $produk->id }})" class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                    <button wire:click="pilihHapus({{ $produk->id }})" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @elseif ($pilihanMenu=='tambah' || $pilihanMenu=='edit')
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">{{ $pilihanMenu == 'tambah' ? '➕ Tambah Produk' : '✏️ Edit Produk' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent='{{ $pilihanMenu == 'tambah' ? 'simpan' : 'simpanEdit' }}'>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" wire:model='nama' />
                            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode / Barcode</label>
                            <input type="text" class="form-control" wire:model='kode' />
                            @error('kode') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" class="form-control" wire:model='harga' />
                            @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stok</label>
                            <input type="number" class="form-control" wire:model='stok' />
                            @error('stok') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        @if($pilihanMenu=='edit')
                        <button type="button" wire:click='batal' class="btn btn-secondary">Batal</button>
                        @endif
                    </form>
                </div>
            </div>

            @elseif ($pilihanMenu=='hapus')
            <div class="card border-danger shadow-sm">
                <div class="card-header bg-danger text-white">
                    Konfirmasi Hapus Produk
                </div>
                <div class="card-body">
                    <p>Yakin ingin menghapus produk <strong>{{ $produkTerpilih->nama }}</strong>?</p>
                    <button class="btn btn-danger" wire:click='hapus'>Hapus</button>
                    <button class="btn btn-secondary" wire:click='batal'>Batal</button>
                </div>
            </div>

            @elseif ($pilihanMenu=='exel')
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    Import Produk (Excel)
                </div>
                <div class="card-body">
                    <form wire:submit.prevent='imporExcel'>
                        <div class="mb-3">
                            <input type="file" class="form-control" wire:model='fileExcel'>
                        </div>
                        <button class="btn btn-primary" type="submit">Import</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

