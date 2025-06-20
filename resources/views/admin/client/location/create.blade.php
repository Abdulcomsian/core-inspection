@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Location Details')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="JobInfoClientSelect">Title</label>
                                <input class="form-control" type="text" name="main_phone" id="mainPhone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="mainPhone">Location</label>
                                <input class="form-control" type="text" name="main_phone" id="mainPhone">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="description">Note</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Save and Cancel Buttons -->
                    <div class="form-group mt-4">
                        <button type="button" class="btn btn-sm save-btn">
                            <i class="far fa-save icon"></i> Save
                        </button>
                        <button type="button" class="btn btn-sm delete-btn">
                            <i class="fa fa-ban icon"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
