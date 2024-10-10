@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Billing Details')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <div class="card mt-5">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="clientSelect">Client</label>
                                <select id="clientSelect" class="form-control">
                                    <option value="1">Cient 1</option>
                                    <option value="2">Client 2</option>
                                    <option value="3">Client 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobSelect">Job</label>
                                <select id="jobSelect" class="form-control">
                                    <option value="1">Job 1</option>
                                    <option value="2">Job 2</option>
                                    <option value="3">Job 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="equipmentSelect">Equipment</label>
                                <select id="equipmentSelect" class="form-control">
                                    <option value="1">Equipment 1</option>
                                    <option value="2">Equipment 2</option>
                                    <option value="3">Equipment 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="inspectionSelect">Inspection</label>
                                <select id="inspectionSelect" class="form-control">
                                    <option value="1">Inspection 1</option>
                                    <option value="2">Inspection 2</option>
                                    <option value="3">Inspection 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="inspectionSelect">Price</label>
                                <input type="number" class="form-control" name="price" id="price">
                            </div>
                        </div>
                    </div>

                    <!-- Save and Cancel Buttons -->
                    <div class="form-group mt-4">
                        <button type="button" class="btn btn-sm save-btn">
                            <i class="far fa-save icon"></i> Save Billing
                        </button>
                        <button type="button" class="btn btn-sm delete-btn">
                            <i class="fa fa-ban icon"></i> Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    @parent
    <script>
        $("#clientSelect").select2({
            width: '100%',
            height: '100%',
        });

        $("#jobSelect").select2({
            width: '100%',
            height: '100%',
        });

        $("#equipmentSelect").select2({
            width: '100%',
            height: '100%',
        });

        $("#inspectionSelect").select2({
            width: '100%',
            height: '100%',
        });
    </script>
@endsection
@endsection
