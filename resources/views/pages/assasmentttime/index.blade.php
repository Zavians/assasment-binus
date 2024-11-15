@extends('layouts.app', ['breadcrumbs' => ['Master', 'Time Assasment']])
@section('title', 'Dashboard')


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
                        placeholder="Search Assasment" />
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button data-bs-toggle="modal" data-bs-target="#kt_modal_1" class="btn btn-sm btn-light-primary me-2">
                        <i class="ki-duotone ki-plus fs-5"></i>
                        Add Assasment
                    </button>
                </div>

                <div class="modal fade" tabindex="-1" id="kt_modal_1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Add Assasment</h3>
                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </div>
                            </div>

                            <!-- Form to Add Data -->
                         <form id="form-ujian" method="POST" action="{{ route('pages.storeUjian') }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3 detail-row">
                                        <div class="col">
                                            <!-- Mata Kuliah -->
                                            <label for="mata_kuliah_id" class="form-label required">Mata Kuliah:</label>
                                            <select name="mata_kuliah_id" class="form-control" required>
                                                <option value="">Pilih Mata Kuliah</option>
                                                @foreach($dataMatkul as $mk)
                                                    <option value="{{ $mk->id }}">{{ $mk->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                            
                                    <div class="mb-3 detail-row">
                                        <div class="col">
                                            <!-- Durasi Ujian -->
                                            <label for="durasi_ujian" class="form-label required">Durasi Ujian (Menit):</label>
                                            <input type="number" name="durasi_ujian" class="form-control" placeholder="Enter duration in minutes" min="30" required>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                            
                                    <div class="mb-3 detail-row">
                                        <div class="col">
                                            <!-- Tanggal Ujian -->
                                            <label for="tanggal_ujian" class="form-label required">Tanggal Ujian:</label>
                                            <input type="date" name="tanggal_ujian" class="form-control" required>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-light-primary">Submit</button>
                                </div>
                                
                            </form>  
                            
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
                        </div>
                    </div>
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
                            <th>Waktu Pelaksanaan</th>
                            <th>Durasi</th>
                            <th>Mata Kuliah</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="items">
                        @foreach($dataWaktuUjian as $ujian)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($ujian->tanggal_ujian)->format('d M Y') }}</td>
                                <td>{{ $ujian->durasi_ujian }} menit</td>
                                <td>{{ $ujian->mataKuliah->name }}</td>
                                <td>
                                    <!-- Actions (Edit, Delete) -->
                                    <a href="{{ route('pages.showUjian', $ujian->id) }}" class="btn btn-sm btn-info">View</a>
                                    <form action="{{ route('pages.destroyUjian', $ujian->id) }}" method="POST" style="display:inline;">
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


    </div>


@endsection