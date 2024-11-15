@extends('layouts.app', ['breadcrumbs' => ['Master', 'Penugasan PIC']])
@section('title', 'Penugasan PIC')

@section('main')

    <div class="card mt-10">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" id="search" class="form-control form-control-solid w-250px ps-13"
                        placeholder="Search Penugasan" />
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button data-bs-toggle="modal" data-bs-target="#kt_modal_1" class="btn btn-sm btn-light-primary me-2">
                        <i class="ki-duotone ki-plus fs-5"></i>
                        Add Penugasan
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body py-4">
            <div class="mx-auto mt-4 table-responsive">
                <!-- Pages Table -->
                <table class="table table-rounded table-striped border gy-7 gs-7" id="table-categories">
                    <thead>
                        <tr class="fw-bold fs-6 border-bottom border-gray-200 text-center">
                            <th>No.</th>
                            <th>PIC Name</th>
                            <th>Mata Kuliah</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($dataPenugasan as $penugasan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $penugasan->picUser->name }}</td>
                                <td>{{ $penugasan->mataKuliah->name }}</td>
                                <td><span
                                        class="badge badge-danger">{{ \Carbon\Carbon::parse($penugasan->deadline)->format('d M Y') }}</span>
                                </td>
                                <td><span class="badge badge-warning">{{ ucfirst($penugasan->status) }}</span></td>
                                <td>
                                    <a href="{{ route('pages.showPenugasan', $penugasan->id) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    <form action="{{ route('pages.destroyPenugasan', $penugasan->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Penugasan -->
    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Penugasan</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"></i>
                    </button>
                </div>

                <!-- Form to Add Data -->
                <form id="form-penugasan" method="POST" action="{{ route('pages.storePenugasan') }}">
                    @csrf
                    <div class="modal-body">

                        <!-- Mata Kuliah -->
                        <div class="mb-3">
                            <label for="mata_kuliah_id" class="form-label required">Mata Kuliah:</label>
                            <select name="mata_kuliah_id" class="form-control" required>
                                <option value="">Pilih Mata Kuliah</option>
                                @foreach ($dataMatkul as $mk)
                                    <option value="{{ $mk->id }}">{{ $mk->name }}</option>
                                @endforeach
                            </select>
                            @error('mata_kuliah_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- PIC -->
                        <div class="mb-3">
                            <label for="pic_user_id" class="form-label required">PIC:</label>
                            <select name="pic_user_id" class="form-control" required>
                                <option value="">Pilih PIC</option>
                                @foreach ($dataPIC as $pic)
                                    <option value="{{ $pic->id }}">{{ $pic->name }}</option>
                                @endforeach
                            </select>
                            @error('pic_user_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deadline -->
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline:</label>
                            <input type="date" name="deadline" class="form-control">
                            @error('deadline')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <input type="text" name="status" class="form-control" placeholder="e.g. pending">
                            @error('status')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-light-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            })
        </script>
    @endif

@endsection
