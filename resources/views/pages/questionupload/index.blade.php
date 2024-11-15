@extends('layouts.app', ['breadcrumbs' => ['Master', 'Penugasan PIC']])

@section('title', 'Penugasan PIC')

@section('main')
    <div class="row">
        <!-- First Card (40%) -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
                    data-bs-target="#kt_docs_card_collapsible_1">
                    <h3 class="card-title">Detail Mata Kuliah</h3>
                    <div class="card-toolbar rotate-180">
                        <i class="ki-duotone ki-down fs-1"></i>
                    </div>
                </div>
                <div id="kt_docs_card_collapsible_1" class="collapse show">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="dosen" class="form-label">Nama Dosen</label>
                            <input type="text" id="dosen" class="form-control form-control-solid"
                                placeholder="Joko Widodo" readonly />
                        </div>
                        <div class="mb-3">
                            <label for="sks" class="form-label">Jumlah SKS</label>
                            <input type="text" id="sks" class="form-control form-control-solid" placeholder="3 SKS"
                                readonly />
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input type="text" id="deskripsi" class="form-control form-control-solid"
                                placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam suscipit orci at sapien tristique, non fermentum turpis."
                                readonly />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Card (60%) -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
                    data-bs-target="#kt_docs_card_collapsible_2">
                    <h3 class="card-title">Progres Soal</h3>
                    <div class="card-toolbar rotate-180">
                        <i class="ki-duotone ki-down fs-1"></i>
                    </div>
                </div>
                <div id="kt_docs_card_collapsible_2" class="collapse show">
                   
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                           <!--begin::Title-->
                           <div class="card-title d-flex flex-column">
                              <!--begin::Info-->
                              <div class="d-flex align-items-center">
                                 <!--begin::Amount-->
                                 <span
                                    class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">10</span>
                                 <!--end::Amount-->
                                 <!--begin::Badge-->
                                 <span class="badge badge-light-danger fs-base">
                                    <i class=" fs-5 text-danger ms-n1"></i>Deadline : 12 November 2024</span>
                                 <!--end::Badge-->
                              </div>
                              <!--end::Info-->
                              <!--begin::Subtitle-->
                              <span class="text-gray-500 pt-1 fw-semibold fs-6">Target Soal</span>
                              <!--end::Subtitle-->
                           </div>
                           <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end pt-0">
                           <!--begin::Progress-->
                           <div class="d-flex align-items-center flex-column mt-3 w-100">
                              <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                 <span class="fw-bolder fs-6 text-gray-900">{{$banyakPertanyaan}} Soal Terpenuhi</span>
                                 <span class="fw-bold fs-6 text-gray-500">100%</span>
                              </div>
                              <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                 <div class="bg-success rounded h-8px" role="progressbar" style="width: 20%;"
                                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                           </div>
                           <!--end::Progress-->
                        </div>
                        <!--end::Card body-->
            </div>
        </div>
    </div>

    <!-- Penugasan Form and Table -->
    <div class="card mt-10">
        <div class="card-header border-0 pt-6 mt-6">
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
            
            <!-- Modal Form -->
            <div class="modal fade" id="kt_modal_1" tabindex="-1" aria-labelledby="kt_modal_1_label" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="form-upload" method="POST" action="{{ route('pages.storePertanyaan') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="kt_modal_1_label">Upload Penugasan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
            
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="file" class="form-label required">Upload File:</label>
                                    <input type="file" name="file" id="file" class="form-control" required>
                                    <span class="invalid-feedback"></span>
                                </div>
                            </div>
            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-light-primary">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>

        <div class="card-body py-4">
            <!-- Bulk Update and Delete Form -->
            <form action="{{ route('pages.bulkUpdateAndDelete') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="new_point" class="form-label">New Point</label>
                    <input type="number" name="new_point" id="new_point" class="form-control" />
                </div>

                <div class="table-responsive">
                    <table class="table table-rounded table-striped border gy-7 gs-7" id="table-categories">
                        <thead>
                            <tr class="fw-bold fs-6 border-bottom border-gray-200 text-center">
                                <th>
                                    <input type="checkbox" id="select-all" class="form-check-input" />
                                </th>
                                <th>No.</th>
                                <th>Pertanyaan</th>
                                <th>Point</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($dataPertanyaan as $pertanyaan)
                                <tr>
                                    <td><input type="checkbox" name="questions[]" value="{{ $pertanyaan->id }}"
                                            class="form-check-input"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pertanyaan->pertanyaan }}</td>
                                    <td>{{ $pertanyaan->point }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Actions: Update or Delete -->
                <div class="d-flex justify-content-end">
                    <button type="submit" name="action" value="update" class="btn btn-sm btn-primary me-2">
                        <i class="ki-duotone ki-check fs-5"></i> Update Points
                    </button>
                    <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger">
                        <i class="ki-duotone ki-trash fs-5"></i> Delete Selected
                    </button>
                </div>
            </form>
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

@section('scripts')
    <script>
        document.getElementById('select-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="questions[]"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
