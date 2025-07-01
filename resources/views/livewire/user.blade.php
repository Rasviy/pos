
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

    <div class="container py-4">
        {{-- Tombol Navigasi Menu --}}
        <div class="mb-4 d-flex gap-2">
            <button wire:click="pilihMenu('lihat')" 
                class="btn btn-custom {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">
                Semua Pengguna
            </button>
            <button wire:click="pilihMenu('tambah')" 
                class="btn btn-custom {{ $pilihanMenu == 'tambah' ? 'btn-success' : 'btn-outline-success' }}">
                Tambah Pengguna
            </button>
            <button wire:loading class="btn btn-info btn-custom">
                Loading ...
            </button>
        </div>

        {{-- Konten Dinamis --}}
        <div class="card card-custom">
            <div class="card-body">
                @if ($pilihanMenu == 'lihat')
                    <h5 class="mb-3 fw-bold text-primary">📋 Daftar Pengguna</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Peran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaPengguna as $pengguna)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pengguna->name }}</td>
                                        <td>{{ $pengguna->email }}</td>
                                        <td>{{ ucfirst($pengguna->peran) }}</td>
                                        <td>
                                            <button wire:click="pilihEdit({{ $pengguna->id }})" 
                                                class="btn btn-sm btn-outline-primary btn-custom">
                                                Edit
                                            </button>
                                            <button wire:click="pilihHapus({{ $pengguna->id }})" 
                                                class="btn btn-sm btn-outline-danger btn-custom">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                @if ($semuaPengguna->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Belum ada pengguna.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                @elseif ($pilihanMenu == 'tambah' || $pilihanMenu == 'edit')
                    <h5 class="mb-3 fw-bold text-success">
                        {{ $pilihanMenu == 'tambah' ? '➕ Tambah Pengguna' : '✏️ Edit Pengguna' }}
                    </h5>
                    <form wire:submit.prevent="{{ $pilihanMenu == 'tambah' ? 'simpan' : 'simpanEdit' }}">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" wire:model.defer="nama" />
                            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" wire:model.defer="email" />
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" wire:model.defer="password" />
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Peran</label>
                            <select class="form-select" wire:model.defer="peran">
                                <option value="">-- Pilih Peran --</option>
                                <option value="kasir">Kasir</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('peran') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn btn-success btn-custom">SIMPAN</button>
                            @if ($pilihanMenu == 'edit')
                                <button type="button" wire:click="batal" class="btn btn-secondary btn-custom">BATAL</button>
                            @endif
                        </div>
                    </form>

                @elseif ($pilihanMenu == 'hapus')
                    <h5 class="fw-bold text-danger">⚠️ Konfirmasi Hapus</h5>
                    <p>Apakah kamu yakin ingin menghapus pengguna ini?</p>
                    <p><strong>Nama:</strong> {{ $penggunaTerpilih->name }}</p>
                    <div class="d-flex gap-2">
                        <button class="btn btn-danger btn-custom" wire:click="hapus">HAPUS</button>
                        <button class="btn btn-secondary btn-custom" wire:click="batal">BATAL</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

