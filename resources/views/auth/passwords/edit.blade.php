@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Update Profile')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="container-fluid">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="form-header">
                                    My Profile
                                </div>
                                <div class="card-body">
                                    <form id="profile-form" method="POST"
                                        action="{{ route('profile.password.updateProfile') }}">
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
                                            <input class="form-control" type="text" name="qualification"
                                                id="qualification"
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
                                                    <img src="{{ asset('/' . auth()->user()->signature) }}"
                                                        alt="Signature Image">
                                                </div>
                                            @endif
                                        </div>
                                        <button class="btn btn-sm mt-2 save-btn" type="submit"><i
                                                class="far fa-save icon"></i>Save</button>
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
                                            <input class="form-control" type="password" name="password" id="password"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Repeat New Password</label>
                                            <input class="form-control" type="password" name="password_confirmation"
                                                id="password_confirmation" required>
                                        </div>
                                        <button class="btn btn-sm mt-2 save-btn" type="submit">
                                            <i class="far fa-save icon"></i>Save</button>
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
                                        <button class="btn btn-sm save-btn" type="submit"><i
                                                class="fa fa-ban icon"></i>Delete Account</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

    </div>
    </div>

@section('scripts')
    @parent
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
