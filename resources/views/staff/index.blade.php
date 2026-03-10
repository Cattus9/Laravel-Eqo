@extends('layouts.app')

@section('title', 'Staff Management - ' . $type)
@section('orm_type', $type)

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="card-title mb-0 fw-bold">Daftar Staff</h5>
            <button class="btn btn-primary btn-sm" onclick="openAddModal()"><i class="bi bi-person-plus"></i> Tambah
                Staff</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Staff</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staffs as $index => $staff)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-bold">{{ $staff->nama_staff }}</td>
                                <td>{{ Str::limit($staff->alamat, 50) }}</td>
                                <td>{{ $staff->no_telp }}</td>
                                <td><a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning" onclick="openEditModal({{ json_encode($staff) }})"><i
                                            class="bi bi-pencil"></i></button>
                                    <form
                                        action="{{ route('staff.destroy.' . ($type == 'Eloquent ORM' ? 'eloquent' : 'query_builder'), $staff->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus staff ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Tidak ada data staff.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Staff -->
    <div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staffModalLabel">Form Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="staffForm" method="POST" action="">
                        @csrf
                        <div id="method-put"></div>
                        <div class="mb-3">
                            <label for="nama_staff" class="form-label">Nama Staff</label>
                            <input type="text" class="form-control" id="nama_staff" name="nama_staff" required
                                placeholder="Nama Lengkap">
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
                    <button type="submit" form="staffForm" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        const storeUrl = "{{ route('staff.store.' . ($type == 'Eloquent ORM' ? 'eloquent' : 'query_builder')) }}";
        const updateUrlTemplate = "{{ route('staff.update.' . ($type == 'Eloquent ORM' ? 'eloquent' : 'query_builder'), ':id') }}";

        function openAddModal() {
            document.getElementById('staffModalLabel').innerText = 'Tambah Staff';
            document.getElementById('staffForm').action = storeUrl;
            document.getElementById('method-put').innerHTML = ''; // Method POST
            document.getElementById('staffForm').reset();
            var modal = new bootstrap.Modal(document.getElementById('staffModal'));
            modal.show();
        }

        function openEditModal(staff) {
            document.getElementById('staffModalLabel').innerText = 'Edit Staff';
            document.getElementById('staffForm').action = updateUrlTemplate.replace(':id', staff.id);
            document.getElementById('method-put').innerHTML = '@method("PUT")'; // Method PUT

            // Populate data
            document.getElementById('nama_staff').value = staff.nama_staff;
            document.getElementById('alamat').value = staff.alamat;
            document.getElementById('no_telp').value = staff.no_telp;
            document.getElementById('email').value = staff.email;
            document.getElementById('keterangan').value = staff.keterangan || '';

            var modal = new bootstrap.Modal(document.getElementById('staffModal'));
            modal.show();
        }
    </script>
@endsection