@extends('layouts.admin')
<style>
    .dark-bold-text {
        color: #343a40;
        font-weight: bold;
        font-size: 1.25rem;
    }

    #signature-dropzone {
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
        margin-top: 50px;
    }
</style>
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-place="true" data-kt-place-mode="prepend"
                    data-kt-place-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                    <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">Update Profile</h1>
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header dark-bold-text">
                                    {{ trans('global.my_profile') }}
                                </div>

                                <div class="card-body">
                                    <form id="profile-form" method="POST"
                                        action="{{ route('profile.password.updateProfile') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="required"
                                                for="name">{{ trans('cruds.user.fields.name') }}</label>
                                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                type="text" name="name" id="name"
                                                value="{{ old('name', auth()->user()->name) }}" required>
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('name') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required"
                                                for="title">{{ trans('cruds.user.fields.email') }}</label>
                                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                type="text" name="email" id="email"
                                                value="{{ old('email', auth()->user()->email) }}" required>
                                            @if ($errors->has('email'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('email') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="title">Qualification</label>
                                            <input
                                                class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}"
                                                type="text" name="qualification" id="qualification"
                                                value="{{ old('qualification', auth()->user()->qualification) }}" required>
                                            @if ($errors->has('qualification'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('qualification') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="title">Job Title</label>
                                            <input class="form-control {{ $errors->has('job_title') ? 'is-invalid' : '' }}"
                                                type="text" name="job_title" id="job_title"
                                                value="{{ old('job_title', auth()->user()->job_title) }}" required>
                                            @if ($errors->has('job_title'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('job_title') }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="required" for="signature">Signature</label>
                                                    <div id="signature-dropzone" class="dropzone {{ $errors->has('signature') ? 'is-invalid' : '' }}"></div>
                                                    @if ($errors->has('signature'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('signature') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    @if (auth()->user()->signature)
                                                        <div id="signature-image" class="signature-image">
                                                            <img src="{{ asset('/' . auth()->user()->signature) }}" alt="Signature Image" />
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>                                        

                                        <div class="form-group">
                                            <button class="btn btn-danger mt-2" type="submit">
                                                {{ trans('global.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header dark-bold-text">
                                    {{ trans('global.change_password') }}
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('profile.password.update') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label class="required" for="password">New
                                                {{ trans('cruds.user.fields.password') }}</label>
                                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                type="password" name="password" id="password" required>
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="required" for="password_confirmation">Repeat New
                                                {{ trans('cruds.user.fields.password') }}</label>
                                            <input
                                                class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                                type="password" name="password_confirmation" id="password_confirmation"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-danger mt-2" type="submit">
                                                {{ trans('global.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header dark-bold-text">
                                    {{ trans('global.delete_account') }}
                                </div>

                                <div class="card-body">
                                    <form method="POST" action="{{ route('profile.password.destroyProfile') }}"
                                        onsubmit="return prompt('{{ __('global.delete_account_warning') }}') == '{{ auth()->user()->email }}'">
                                        @csrf
                                        <div class="form-group">
                                            <button class="btn btn-danger" type="submit">
                                                {{ trans('global.delete') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
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
