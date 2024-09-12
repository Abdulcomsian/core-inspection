@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Update Profile')
<style>
    .dark-bold-text {
        color: #343a40;
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 15px;
    }

    .card-header {
        background-color: #f8f9fa;
        padding: 20px;
        border-bottom: 1px solid #dee2e6;
    }

    .card-body {
        padding: 25px;
    }

    .form-group label {
        font-weight: 600;
        font-size: 1rem;
    }

    .form-control {
        padding: 10px;
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .btn-danger {
        background-color: #e74c3c;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn {
        font-size: 1rem;
        padding: 10px 20px;
    }

    .dropzone {
        width: 100%;
        height: 200px;
        background-size: cover;
        background-position: center;
        border: 2px dashed #d3d3d3;
    }

    .dropzone .dz-preview .dz-image img {
        display: none;
    }

    .signature-image img {
        max-width: 100%;
        max-height: 200px;
        width: auto;
        height: auto;
        margin-top: 15px;
        border: 2px solid #ddd;
        border-radius: 5px;
    }

    .row {
        margin-top: 20px;
    }

    .container {
        max-width: 1100px;
    }

    .card {
        margin-bottom: 30px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
</style>

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <!-- Content Area -->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container">
                <!-- Update Profile Card -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="form-header">
                                My Profile
                            </div>
                            <div class="card-body">
                                <form id="profile-form" method="POST" action="{{ route('profile.password.updateProfile') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control" type="text" name="name" id="name"
                                            value="{{ old('name', auth()->user()->name) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="text" name="email" id="email"
                                            value="{{ old('email', auth()->user()->email) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="qualification">Qualification</label>
                                        <input class="form-control" type="text" name="qualification" id="qualification"
                                            value="{{ old('qualification', auth()->user()->qualification) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="job_title">Job Title</label>
                                        <input class="form-control" type="text" name="job_title" id="job_title"
                                            value="{{ old('job_title', auth()->user()->job_title) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="signature">Signature</label>
                                        <div id="signature-dropzone" class="dropzone"></div>
                                        @if (auth()->user()->signature)
                                            <div id="signature-image" class="signature-image">
                                                <img src="{{ asset('/' . auth()->user()->signature) }}" alt="Signature Image">
                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn btn-danger mt-2" type="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Change Password Card -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="form-header">
                                Change Password
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.password.update') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input class="form-control" type="password" name="password" id="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Repeat New Password</label>
                                        <input class="form-control" type="password" name="password_confirmation"
                                            id="password_confirmation" required>
                                    </div>
                                    <button class="btn btn-danger mt-2" type="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="form-header">
                                Delete Account
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.password.destroyProfile') }}"
                                    onsubmit="return prompt('{{ __('global.delete_account_warning') }}') == '{{ auth()->user()->email }}'">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Delete Account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        Dropzone.autoDiscover = false;

        var signatureFile = null;

        var signatureDropzone = new Dropzone("#signature-dropzone", {
            url: "#", // Prevent automatic submission
            maxFiles: 1,
            autoProcessQueue: false,
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeAllFiles();
                        alert('Drop only one file');
                    }
                    signatureFile = file;
                    var imageUrl = URL.createObjectURL(file);
                    document.getElementById('signature-dropzone').style.backgroundImage = 'url(' +
                        imageUrl + ')';
                });
                this.on("removedfile", function(file) {
                    signatureFile = null;
                    document.getElementById('signature-dropzone').style.backgroundImage = 'none';
                });
                this.on("error", function(file, response) {
                    console.error(response);
                });
            }
        });

        document.querySelector('#profile-form').addEventListener('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            if (signatureFile) {
                formData.append('signature', signatureFile);
            }

            fetch("{{ route('profile.password.updateProfile') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    console.log('Response Status:', response.status);
                    return response.text();
                })
                .then(text => {
                    console.log('Response Text:', text);
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        console.error('JSON Parsing Error:', e);
                        throw e;
                    }
                })
                .then(data => {
                    console.log('Parsed Data:', data);
                    console.log('status', data.status);
                    if (data.status == 'success') {
                        location.reload();
                    } else {
                        console.error('Errors:', data.errors);
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        });
    </script>
@endsection
@endsection
