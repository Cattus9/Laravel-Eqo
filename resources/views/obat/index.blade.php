@extends('layouts.app')

@section('title', 'Master Obat - ' . $type)
@section('orm_type', $type)

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="card-title mb-0 fw-bold">Daftar Obat</h5>
            <button class="btn btn-primary btn-sm" onclick="openAddModal()"><i class="bi bi-plus-lg"></i> Tambah
                Obat</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Obat</th>
                            <th>Satuan</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($obats as $index => $obat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $obat->nama_obat }}</td>
                                <td><span class="badge bg-secondary">{{ $obat->satuan }}</span></td>
                                <td>Rp {{ number_format($obat->harga_beli, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($obat->harga_jual, 0, ',', '.') }}</td>
                                <td>
                                    @if($obat->stok < 50)
                                        <span class="text-danger fw-bold">{{ $obat->stok }}</span>
                                    @else
                                        <span class="text-success">{{ $obat->stok }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning" onclick="openEditModal({{ json_encode($obat) }})"><i
                                            class="bi bi-pencil"></i></button>
                                    <form
                                        action="{{ route('obat.destroy.' . ($type == 'Eloquent ORM' ? 'eloquent' : 'query_builder'), $obat->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus obat ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Tidak ada data obat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Obat -->
    <div class="modal fade" id="obatModal" tabindex="-1" aria-labelledby="obatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="obatModalLabel">Form Obat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="obatForm" method="POST" action="">
                        @csrf
                        <div id="method-put"></div>
                        <div class="mb-3">
                            <label for="nama_obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" required
                                placeholder="Contoh: Paracetamol 500mg">
                        </div>
                        <div class="mb-3">
                            <label for="satuan" class="form-label">Satuan</label>
                            <select class="form-select" id="satuan" name="satuan" required>
                                <option value="">Pilih Satuan...</option>
                                <option value="Tablet">Tablet</option>
                                <option value="Kapsul">Kapsul</option>
                                <option value="Botol">Botol</option>
                                <option value="Sachet">Sachet</option>
                                <option value="Pcs">Pcs</option>
                                <option value="Box">Box</option>
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="harga_beli" class="form-label">Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
                            </div>
                            <div class="col">
                                <label for="harga_jual" class="form-label">Harga Jual</label>
                                <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok Awal</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="obatForm" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        const storeUrl = "{{ route('obat.store.' . ($type == 'Eloquent ORM' ? 'eloquent' : 'query_builder')) }}";
        const updateUrlTemplate = "{{ route('obat.update.' . ($type == 'Eloquent ORM' ? 'eloquent' : 'query_builder'), ':id') }}";

        function openAddModal() {
            document.getElementById('obatModalLabel').innerText = 'Tambah Obat';
            document.getElementById('obatForm').action = storeUrl;
            document.getElementById('method-put').innerHTML = ''; // Method POST
            document.getElementById('obatForm').reset();
            var modal = new bootstrap.Modal(document.getElementById('obatModal'));
            modal.show();
        }

        function openEditModal(obat) {
            document.getElementById('obatModalLabel').innerText = 'Edit Obat';
            document.getElementById('obatForm').action = updateUrlTemplate.replace(':id', obat.id);
            document.getElementById('method-put').innerHTML = '@method("PUT")'; // Method PUT

            // Populate data
            document.getElementById('nama_obat').value = obat.nama_obat;
            document.getElementById('satuan').value = obat.satuan;
            document.getElementById('harga_beli').value = obat.harga_beli;
            document.getElementById('harga_jual').value = obat.harga_jual;
            document.getElementById('stok').value = obat.stok;
            document.getElementById('keterangan').value = obat.keterangan || '';

            var modal = new bootstrap.Modal(document.getElementById('obatModal'));
            modal.show();
        }
    </script>
@endsection