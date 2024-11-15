@extends('layouts.app', ['breadcrumbs' => ['Master', 'Penugasan PIC', 'Edit']])
@section('title', 'Edit Penugasan')

@section('main')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title font-weight-bold">Update Penugasan</h4>
        </div>

        <div class="card-body">
            <div id="mata-kuliah-info" class="row mt-3">
                @if($dataDetailMatkul)
                    <!-- Card for Nama Dosen -->
                    <div class="col-md-4">
                        <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                            <div class="card-body d-flex align-items-center">
                                <span class="svg-icon fs-1">
                                    <i class="ki-duotone ki-user fs-2"></i>
                                </span>
    
                                <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                    Nama Dosen:<br>
                                    <span class="fs-7 text-muted">{{ $dataDetailMatkul->nama_dosen }}</span>
                                </span>
                            </div>
                        </a>
                    </div>
    
                    <!-- Card for Jumlah SKS -->
                    <div class="col-md-4">
                        <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                            <div class="card-body d-flex align-items-center">
                                <span class="svg-icon fs-1">
                                    <i class="ki-duotone ki-layers fs-2"></i>
                                </span>
    
                                <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                    Jumlah SKS:<br>
                                    <span class="fs-7 text-muted">{{ $dataDetailMatkul->jumlah_sks }}</span>
                                </span>
                            </div>
                        </a>
                    </div>
    
                    <!-- Card for Deskripsi -->
                    <div class="col-md-4">
                        <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                            <div class="card-body d-flex align-items-center">
                                <span class="svg-icon fs-1">
                                    <i class="ki-duotone ki-file fs-2"></i>
                                </span>
    
                                <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                    Deskripsi Mata Kuliah:<br>
                                    <span class="fs-7 text-muted">{{ $dataDetailMatkul->deskripsi }}</span>
                                </span>
                            </div>
                        </a>
                    </div>
                @else
                    <p>Pilih Mata Kuliah untuk melihat informasi lebih lanjut.</p>
                @endif
            </div>

            <div id="pic-info" class="row mt-3">
                @if($dataDetailPIC)
                    <!-- Card for Jumlah SKS -->
                    <div class="col-md-4">
                        <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                            <div class="card-body d-flex align-items-center">
                                <span class="svg-icon fs-1">
                                    <i class="ki-duotone ki-layers fs-2"></i>
                                </span>
    
                                <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                    Email PIC:<br>
                                    <span class="fs-7 text-muted">{{ $dataDetailPIC->email }}</span>
                                </span>
                            </div>
                        </a>
                    </div>
    
                    <!-- Card for Deskripsi -->
                    <div class="col-md-4">
                        <a href="#" class="card hover-elevate-up shadow-sm parent-hover">
                            <div class="card-body d-flex align-items-center">
                                <span class="svg-icon fs-1">
                                    <i class="ki-duotone ki-file fs-2"></i>
                                </span>
    
                                <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                                    PIC Phone Number:<br>
                                    <span class="fs-7 text-muted">{{ $dataDetailPIC->phone }}</span>
                                </span>
                            </div>
                        </a>
                    </div>
                @else
                    <p>Pilih Mata Kuliah untuk melihat informasi lebih lanjut.</p>
                @endif
            </div>
            <div class="mt-6">
            <form method="POST" action="{{ route('pages.updatePenugasan', $dataPenugasan->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Form Fields -->
                <div class="row g-3">
                    <!-- Mata Kuliah -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="mata_kuliah_id" class="form-label">Mata Kuliah</label>
                            <select name="mata_kuliah_id" id="mata_kuliah_id" class="form-control" required>
                                <option value="">Pilih Mata Kuliah</option>
                                @foreach ($dataMatkul as $mk)
                                    <option value="{{ $mk->id }}"
                                        {{ $mk->id == $dataPenugasan->mata_kuliah_id ? 'selected' : '' }}>
                                        {{ $mk->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_kuliah_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- PIC -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="pic_user_id" class="form-label">PIC</label>
                            <select name="pic_user_id" id="pic_user_id" class="form-control" required>
                                <option value="">Pilih PIC</option>
                                @foreach ($dataPIC as $pic)
                                    <option value="{{ $pic->id }}"
                                        {{ $pic->id == $dataPenugasan->pic_user_id ? 'selected' : '' }}>
                                        {{ $pic->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pic_user_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Deadline -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="{{ $dataPenugasan->deadline }}" required>
                            @error('deadline')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" name="status" class="form-control" value="{{ $dataPenugasan->status }}" placeholder="e.g. pending">
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Footer with buttons -->
                <div class="modal-footer">
                    <div class="">
                        <button type="submit" class="btn btn-primary ml-4">Update</button>
                        <a href="{{ route('pages.indexPenugasan') }}" class="btn btn-light">Cancel</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
