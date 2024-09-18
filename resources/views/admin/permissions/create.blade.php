@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Permission Create')
@section('content')

<div class="container mt-4">
    <form method="POST" action="{{ route('permissions.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="title" class="form-label required">{{ trans('cruds.permission.fields.title') }}</label>
            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
            @if($errors->has('title'))
                <div class="invalid-feedback">
                    {{ $errors->first('title') }}
                </div>
            @endif
            <small class="form-text text-muted">{{ trans('cruds.permission.fields.title_helper') }}</small>
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="far fa-save me-2"></i> Save
            </button>
        </div>
    </form>
</div>

@endsection
