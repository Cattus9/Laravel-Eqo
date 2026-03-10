@extends('layouts.app')

@section('title', 'Supplier Management - ' . $type)
@section('orm_type', $type)

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="card-title mb-0 fw-bold">Daftar Supplier</h5>
            <button class="btn btn-primary btn-sm" onclick="openAddModal()"><i class="bi bi-truck"></i> Tambah
                Supplier</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $index => $supplier)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold text-primary">{{ $supplier->nama_supplier }}</td>
                                <td>{{ Str::limit($supplier->alamat, 50) }}</td>
                                <td>{{ $supplier->no_telp }}</td>
                                <td><a href="mailto:{{ $supplier->email }}">{{ $supplier->email }}</a></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning"
                                        onclick="openEditModal({{ json_encode($supplier) }})"><i
                                            class="bi bi-pencil"></i></button>
                                    <form
                                        action="{{ route('supplier.destroy.' . ($type == 'Eloquent ORM' ? 'eloquent' : 'query_builder'), $supplier->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus supplier ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Tidak ada data supplier.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Supplier -->
    <div class="modal fade" id="supplierModal" tabindex="-1" aria-labelledby="supplierModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="supplierModalLabel">Form Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="supplierForm" method="POST" action="">
                        @csrf
                        <div id="method-put"></div>
                        <div class="mb-3">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required
                                placeholder="Contoh: PT. Medika Utama">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="supplierForm" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const storeUrl = "{{ route('supplier.store.' . ($type == 'Eloquent ORM' ? 'eloquent' : 'query_builder')) }}";
        const updateUrlTemplate = "{{ route('supplier.update.' . ($type == 'Eloquent ORM' ? 'eloquent' : 'query_builder'), ':id') }}";

        function openAddModal() {
            document.getElementById('supplierModalLabel').innerText = 'Tambah Supplier';
            document.getElementById('supplierForm').action = storeUrl;
            document.getElementById('method-put').innerHTML = ''; // Method POST
            document.getElementById('supplierForm').reset();
            var modal = new bootstrap.Modal(document.getElementById('supplierModal'));
            modal.show();
        }

        function openEditModal(supplier) {
            document.getElementById('supplierModalLabel').innerText = 'Edit Supplier';
            document.getElementById('supplierForm').action = updateUrlTemplate.replace(':id', supplier.id);
            document.getElementById('method-put').innerHTML = '@method("PUT")'; // Method PUT

            // Populate data
            document.getElementById('nama_supplier').value = supplier.nama_supplier;
            document.getElementById('alamat').value = supplier.alamat;
            document.getElementById('no_telp').value = supplier.no_telp;
            document.getElementById('email').value = supplier.email;
            document.getElementById('keterangan').value = supplier.keterangan || '';

            var modal = new bootstrap.Modal(document.getElementById('supplierModal'));
            modal.show();
        }
    </script>
@endsection