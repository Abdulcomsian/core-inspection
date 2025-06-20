@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Update Role')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid">
            <!-- Card Toolbar -->
            <div class="mt-5">
                <!-- Form Section -->
                <div class="card">
                    <div class="form-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('roles.index') }}">
                            <button type="button" class="btn btn-sm add-section">
                                <i class="fas fa-eye icon"></i>View Roles
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', [$role->id]) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <!-- Title Input Field -->
                            <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="title" id="title" value="{{ old('title', $role->title) }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>

                            <!-- Permissions Select Field -->
                            <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                            <div class="d-flex gap-2 mb-2">
                                <span class="btn btn-sm select-all delete-btn">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-sm deselect-all delete-btn">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}"
                                name="permissions[]" id="permissions" multiple required>
                                @foreach ($permissions as $id => $permission)
                                    <option value="{{ $id }}"
                                        {{ in_array($id, old('permissions', [])) || $role->permissions->contains($id) ? 'selected' : '' }}>
                                        {{ $permission }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('permissions'))
                                <span class="text-danger">{{ $errors->first('permissions') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>

                            <!-- Submit Button -->
                            <button class="btn btn-sm save-btn mt-3" type="submit">
                                <i class="far fa-save icon"></i>
                                {{ trans('global.save') }}
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

            $("#permissions").select2({
                width: '100%',
                height: '100%',
            });
        });
    </script>
@endsection
@endsection
