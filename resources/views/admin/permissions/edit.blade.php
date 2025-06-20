@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Update Permission')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container-fluid">
        <!-- Card Toolbar -->
        <div class="mt-5">
            <!-- Form Section -->
            <div class="card">
                <div class="form-header d-flex justify-content-between align-items-center">
                    <a href="{{ route('permissions.index') }}">
                        <button type="button" class="btn btn-sm add-section">
                            <i class="fas fa-eye icon"></i>View Permissions
                        </button>
                    </a>
                </div>                
                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.update', [$permission->id]) }}"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <label class="required" for="title">{{ trans('cruds.permission.fields.title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="title" id="title" value="{{ old('title', $permission->title) }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.permission.fields.title_helper') }}</span>
                            <button class="btn btn-sm save-btn mt-3" type="submit">
                                <i class="far fa-save icon"></i>{{ trans('global.save') }}
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.select-all').click(function() {
                $('#permissions option').prop('selected', true);
                $('#permissions').trigger('change');
            });

            $('.deselect-all').click(function() {
                $('#permissions option').prop('selected', false);
                $('#permissions').trigger('change');
            });
        });
    </script>
@endsection
@endsection
