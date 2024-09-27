@extends('layouts.app')
@section('title', 'Software')
@section('content')
    <div class="d-flex flex-column flex-root">
        {{-- <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url(assets/media/illustrations/progress-hd.png)"> --}}
            <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="index.html" class="mb-12">
                    <img alt="Logo" src="assets/media/logos/logo-2-dark.svg" class="h-45px" />
                </a>
                <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form method="POST" action="{{ route('password.otp.verification') }}">
                        @csrf

                        <div class="form-group">
                            <label for="username">{{ trans('cruds.user.fields.username') }}</label>
                            <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text"
                                name="username" id="username" required value="{{ $username }}" readonly>
                            @if ($errors->has('username'))
                                <span class="text-danger">
                                    {{ $errors->first('username') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="required" for="username">{{ trans('global.otp') }}</label>
                            <input id="otp" type="numebr"
                                class="form-control{{ $errors->has('otp') ? ' is-invalid' : '' }}" name="otp" required
                                autocomplete="otp" autofocus placeholder="{{ trans('global.otp') }}"
                                value="{{ old('otp') }}">

                            @if ($errors->has('otp'))
                                <span class="text-danger">
                                    {{ $errors->first('otp') }}
                                </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-sm orange-btn btn-flat btn-block mt-3">
                                    {{ trans('global.submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
