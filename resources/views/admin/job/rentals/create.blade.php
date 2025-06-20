@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Rental Details')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <div class="card mt-5">
                <div class="card-body">
                    <!-- Equipment Type Description Section -->
                    <h5 class="mb-4">Mandatory Job Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="JobInfoClientSelect">Client</label>
                                <select id="JobInfoClientSelect" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobInforclientSiteSelect">Client Site</label>
                                <select id="jobInforclientSiteSelect" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="mainPhone">Main Phone</label>
                                <input class="form-control" type="number" name="main_phone" id="mainPhone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="customerOrderNumber">Customer Ref/ Order Number</label>
                                <input class="form-control" type="text" name="customer_order_number"
                                    id="customerOrderNumber">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Scheduling Information Section -->
                    <h5 class="mb-4">Scheduling Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="scheduleDate">Schedule For</label>
                                <input class="form-control" type="date" name="schedule_date" id="scheduleDate">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="scheduleTime">Time</label>
                                <input class="form-control" type="time" name="schedule_time" id="scheduleTime">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="scheduleDuration">Duration</label>
                                <input class="form-control" type="number" name="schedule_duration" id="scheduleDuration">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <div class="row">
                                    <div class="form-group col-md-6 mt-3">
                                        <button type="button" class="btn btn-sm" style="background-color: #7F8C8D;color: #fff;">Pending
                                            Job</button>
                                        <button type="button" class="btn btn-sm" style="background-color: #E67E22;color: #fff;">Active
                                            Job</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="branchSelect">Branch</label>
                                <select id="branchSelect" class="form-control">
                                    <option value="1">Head Office</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="competenciesRequiredSelect">Competencies Required</label>
                                <select id="competenciesRequiredSelect" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="schedulingWorkersSelect">Workers</label>
                                <select id="schedulingWorkersSelect" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Reference Documents Section -->
                    <h5 class="mb-4">Job Location Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocPhone">Contact</label>
                                <input class="form-control" type="number" name="job_loc_phone" id="jobLocPhone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocMobile">Mobile</label>
                                <input class="form-control" type="number" name="job_loc_mobile" id="jobLocMobile">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocEmail">Email</label>
                                <input class="form-control" type="email" name="job_loc_email" id="jobLocEmail">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocAddress">Address</label>
                                <input class="form-control" type="text" name="job_loc_address" id="jobLocAddress">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocAddress">Address</label>
                                <input class="form-control" type="text" name="job_loc_address2" id="jobLocAddress2">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocCity">City</label>
                                <input class="form-control" type="text" name="job_loc_city" id="jobLocCity">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocRegion">Region</label>
                                <input class="form-control" type="text" name="schedule_region" id="jobLocRegion"
                                    placeholder="Region">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocPostCode">Post Code</label>
                                <input class="form-control" type="number" name="schedule_region" id="jobLocPostCode"
                                    placeholder="Post Code">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-4">Notes / Customer Requirements</h5>
                    <div class="form-group mb-3">
                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                    </div>

                    <hr>

                    <h5 class="mb-4">Extra Fields</h5>
                    <div class="form-group mb-3">
                        <label for="jobLocRegion">Certificate Number</label>
                        <input class="form-control" type="text" name="schedule_region" id="jobLocRegion">
                    </div>

                    <!-- Save and Cancel Buttons -->
                    <div class="form-group mt-4">
                        <button type="button" class="btn btn-sm save-btn">
                            <i class="far fa-save icon"></i> Save
                        </button>
                        <button type="button" class="btn btn-sm save-btn">
                            <i class="far fa-save icon"></i> Save & Continue
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
        $('#JobInfoClientSelect').select2();
        $('#jobInforclientSiteSelect').select2();
        $('#competenciesRequiredSelect').select2();
        $('#schedulingWorkersSelect').select2();

        $("#inspectionInterval").select2({
            width: '100%',
            height: '100%',
        });
    </script>
@endsection
@endsection
