@extends('layouts.app', ['breadcrumbs' => ['Master', 'Time Assasment']])
@section('title', 'Dashboard')

@section('main')

<div class="card mt-10 p-4">
    <div class="row">
        <!-- Detail Mata Kuliah (30%) -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Detail Mata Kuliah</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="nama_dosen" class="form-label">Nama Dosen</label>
                        <input type="text" id="nama_dosen" class="form-control form-control-solid" placeholder="Joko Widodo" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_sks" class="form-label">Jumlah SKS</label>
                        <input type="text" id="jumlah_sks" class="form-control form-control-solid" placeholder="3 SKS" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_mk" class="form-label">Deskripsi</label>
                        <input type="text" id="deskripsi_mk" class="form-control form-control-solid" placeholder="Deskripsi Mata Kuliah" readonly />
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail PIC (30%) -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Detail PIC</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="pic_nama_dosen" class="form-label">Nama Dosen</label>
                        <input type="text" id="pic_nama_dosen" class="form-control form-control-solid" placeholder="Nama Dosen PIC" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="pic_jumlah_sks" class="form-label">Jumlah SKS</label>
                        <input type="text" id="pic_jumlah_sks" class="form-control form-control-solid" placeholder="3 SKS" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="pic_deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" id="pic_deskripsi" class="form-control form-control-solid" placeholder="Deskripsi PIC" readonly />
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Soal (40%) -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">Detail Soal</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="total_soal" class="form-label">Total Soal</label>
                        <input type="text" id="total_soal" class="form-control form-control-solid" placeholder="8" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_penyerahan" class="form-label">Tanggal Penyerahan</label>
                        <input type="text" id="tanggal_penyerahan" class="form-control form-control-solid" placeholder="12 November" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="status_soal" class="form-label">Status</label>
                        <input type="text" id="status_soal" class="form-control form-control-solid" placeholder="{{$dataApprover->status}}" readonly />
                    </div>
                </div>
            </div>
        </div>
    </div>

 <!-- Chat Section (Admin and PIC) -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="card shadow-sm" style="height: 400px;">
            <div class="card-header">
                <h3 class="card-title">Chat Admin & PIC</h3>
            </div>
            <div class="card-body chat-container" style="max-height: 320px; overflow-y: auto;">
                <!-- Example chat messages -->
                <div class="d-flex align-items-start mb-3">
                    <div class="me-2">
                        <span class="badge bg-primary">Admin</span>
                    </div>
                    <div class="p-2 bg-light rounded">
                        <p>Hello PIC, could you update the progress on the questions?</p>
                        <small class="text-muted">10:05 AM</small>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3">
                    <div class="me-2">
                        <span class="badge bg-secondary">PIC</span>
                    </div>
                    <div class="p-2 bg-light rounded">
                        <p>Sure, we have completed 8 out of 10 questions.</p>
                        <small class="text-muted">10:10 AM</small>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3">
                    <div class="me-2">
                        <span class="badge bg-primary">Admin</span>
                    </div>
                    <div class="p-2 bg-light rounded">
                        <p>Great! Let me know once it’s fully done. Keep up the good work!</p>
                        <small class="text-muted">10:15 AM</small>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <form id="chatForm" onsubmit="return sendMessage()">
                    <div class="input-group">
                        <input type="text" id="chatMessage" class="form-control" placeholder="Type a message..." required />
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Timeline and Actions -->
    <div class="col-md-4">
        <div class="d-flex justify-content-between mb-2">
            <form action="{{ route('pages.approve') }}" method="POST" class="w-50 me-2">
                @csrf
                <button type="submit" class="btn btn-success w-100">Approved</button>
            </form>
            <form action="{{ route('pages.reject') }}" method="POST" class="w-50">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Reject</button>
            </form>
        </div>
        
        <div class="card shadow-sm" style="height: 400px;">
            <div class="card-header">
                <h3 class="card-title">Timeline Soal</h3>
            </div>
            <div class="card-body" style="max-height: 320px; overflow-y: auto;">
                <ul class="timeline list-unstyled position-relative ps-3" style="border-left: 2px solid #007bff;">
                    <li class="mb-4">
                        <div class="ms-3">
                            <h6 class="fw-bold">Revisi 1</h6>
                            <small class="text-muted">20 November, 10:00 AM</small>
                            <p class="mb-1">Initial draft received. Needs refinement on question clarity.</p>
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="ms-3">
                            <h6 class="fw-bold">Revisi 2</h6>
                            <small class="text-muted">22 November, 2:00 PM</small>
                            <p class="mb-1">Content updated with additional explanations and examples.</p>
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="ms-3">
                            <h6 class="fw-bold">Revisi 3</h6>
                            <small class="text-muted">24 November, 9:30 AM</small>
                            <p class="mb-1">Minor errors corrected. Adjustments made to formatting.</p>
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="ms-3">
                            <h6 class="fw-bold">Revisi 4</h6>
                            <small class="text-muted">26 November, 11:15 AM</small>
                            <p class="mb-1">Added visual aids and additional references for clarity.</p>
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="ms-3">
                            <h6 class="fw-bold">Revisi 5</h6>
                            <small class="text-muted">28 November, 3:45 PM</small>
                            <p class="mb-1">Final review pending minor edits and approval.</p>
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="ms-3">
                            <h6 class="fw-bold">Revisi 6</h6>
                            <small class="text-muted">30 November, 5:00 PM</small>
                            <p class="mb-1">All revisions completed. Awaiting final approval.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function sendMessage() {
        const message = document.getElementById("chatMessage").value;
        if (message.trim() === "") return false;

        // Create a new message element
        const newMessage = document.createElement("div");
        newMessage.classList.add("d-flex", "align-items-start", "mb-3");
        newMessage.innerHTML = `
            <div class="me-2">
                <span class="badge bg-primary">Admin</span>
            </div>
            <div class="p-2 bg-light rounded">
                <p>${message}</p>
                <small class="text-muted">${new Date().toLocaleTimeString()}</small>
            </div>
        `;

        // Append the new message to the chat container
        document.querySelector(".chat-container").appendChild(newMessage);

        // Clear the input
        document.getElementById("chatMessage").value = "";

        // Scroll to the bottom
        const chatContainer = document.querySelector(".chat-container");
        chatContainer.scrollTop = chatContainer.scrollHeight;

        return false;
    }
</script>





@endsection
