@extends('layouts.app', ['breadcrumbs' => ['Master', 'Time Assasment', 'Edit']])
@section('title', 'Edit Assasment')

@section('main')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title font-weight-bold">Update Time Assasment</h4>
        </div>

         <!-- Informasi Mata Kuliah (3 Card dalam 1 Baris) -->
        
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

          
            <div class="mt-6">
            <form method="POST" action="{{ route('pages.updateUjian', $dataAssasment->id) }}" enctype="multipart/form-data">
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
                                @foreach($dataMatkul as $mk)
                                    <option value="{{ $mk->id }}" 
                                        {{ $mk->id == $dataAssasment->mata_kuliah_id ? 'selected' : '' }}>
                                        {{ $mk->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_kuliah_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Durasi Ujian -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="durasi_ujian" class="form-label">Durasi Ujian (Menit)</label>
                            <input type="number" name="durasi_ujian" class="form-control" 
                                   value="{{ $dataAssasment->durasi_ujian }}" min="30" required>
                            @error('durasi_ujian')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Tanggal Ujian -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_ujian" class="form-label">Tanggal Ujian</label>
                            <input type="date" name="tanggal_ujian" class="form-control" 
                                   value="{{ \Carbon\Carbon::parse($dataAssasment->tanggal_ujian)->format('Y-m-d') }}" required>
                            @error('tanggal_ujian')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

               

                <!-- Footer with buttons -->
                <div class="modal-footer">
                    <div class="">
                        <button type="submit" id="kt_docs_sweetalert_basic" class="btn btn-primary ml-4">Update</button>
                        <a href="{{ route('pages.indexUjian') }}" class="btn btn-light">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection
