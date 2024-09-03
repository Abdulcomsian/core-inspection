@extends('layouts.admin')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid" id="kt_toolbar_container">
            <div class="toolbar d-flex flex-stack">
                <div class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-dark text-hover-primary">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Job #(Pending)</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                        aria-controls="general" aria-selected="true">General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab"
                        aria-controls="attachments" aria-selected="false">Attachments</a>
                </li>
            </ul>

            <!-- Tab Contents -->
            <div class="tab-content" id="myTabContent">
                <!-- General Tab Content -->
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="main-card card">
                        <div class="card-body">
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6 d-flex">
                                        <div class="inner-card card flex-fill">
                                            <div class="card-body">
                                                <div class="form-header">
                                                    <h3>Mandatory Job Information</h3>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="JobInfoClientSelect">Client</label>
                                                    <select id="JobInfoClientSelect" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="jobInforclientSiteSelect">Client Site</label>
                                                    <select id="jobInforclientSiteSelect" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="mainPhone">Main Phone</label>
                                                    <input class="form-control" type="number" name="main_phone"
                                                        id="mainPhone">
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="customerOrderNumber">Customer Ref/ Order Number</label>
                                                    <input class="form-control" type="text" name="customer_order_number"
                                                        id="customerOrderNumber">
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="subject">Subject</label>
                                                    <input class="form-control" type="text" name="subject"
                                                        id="subject">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <div class="inner-card card flex-fill">
                                            <div class="card-body">
                                                <div class="form-header">
                                                    <h3>Scheduling Information</h3>
                                                </div>
                                                <div class="form-group row input-spacing">
                                                    <div class="col-md-4">
                                                        <label for="scheduleDate">Schedule For</label>
                                                        <input class="form-control" type="date" name="schedule_date"
                                                            id="scheduleDate">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="scheduleTime">Time</label>
                                                        <input class="form-control" type="time" name="schedule_time"
                                                            id="scheduleTime">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="scheduleDuration">Duration</label>
                                                        <input class="form-control" type="number"
                                                            name="schedule_duration" id="scheduleDuration">
                                                    </div>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="status">Status</label>
                                                    <div>
                                                        <button type="button" class="btn btn-outline-primary">Pending
                                                            Job</button>
                                                        <button type="button" class="btn btn-outline-success">Active
                                                            Job</button>
                                                    </div>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="branchSelect">Branch</label>
                                                    <select id="branchSelect" class="form-control">
                                                        <option value="1">Head Office</option>
                                                    </select>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="competenciesRequiredSelect">Competencies Required</label>
                                                    <select id="competenciesRequiredSelect" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="schedulingWorkersSelect">Workers</label>
                                                    <select id="schedulingWorkersSelect" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 d-flex">
                                        <div class="inner-card card flex-fill">
                                            <div class="card-body">
                                                <div class="form-header">
                                                    <h3>Job Location Details</h3>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="jobLocPhone">Contact</label>
                                                    <input class="form-control" type="number" name="job_loc_phone"
                                                        id="jobLocPhone">
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="jobLocMobile">Mobile</label>
                                                    <input class="form-control" type="number" name="job_loc_mobile"
                                                        id="jobLocMobile">
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="jobLocEmail">Email</label>
                                                    <input class="form-control" type="email" name="job_loc_email"
                                                        id="jobLocEmail">
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="jobLocAddress">Address</label>
                                                    <input class="form-control" type="text" name="job_loc_address"
                                                        id="jobLocAddress">
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <input class="form-control" type="text" name="job_loc_address2"
                                                        id="jobLocAddress2">
                                                </div>
                                                <div class="form-group row input-spacing">
                                                    <div class="col-md-4">
                                                        <label for="jobLocCity">City</label>
                                                        <input class="form-control" type="text" name="job_loc_city"
                                                            id="jobLocCity">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="jobLocRegion">Region</label>
                                                        <input class="form-control" type="text" name="schedule_region"
                                                            id="jobLocRegion" placeholder="Region">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="jobLocPostCode">Post Code</label>
                                                        <input class="form-control" type="number" name="schedule_region"
                                                            id="jobLocPostCode" placeholder="Post Code">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <div class="inner-card card flex-fill">
                                            <div class="card-body">
                                                <div class="form-header">
                                                    <h3>Notes / Customer Requirements</h3>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="cus_req_note" id="cusReqNote" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-header">
                                                    <h3>Extra Fields</h3>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="salesOrderNo">Sales Order Number</label>
                                                    <input class="form-control" type="text" name="sale_order_no"
                                                        id="salesOrderNo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm"><i class="fas fa-save"></i>Save</button>
                                <button type="button" class="btn btn-success btn-sm"><i class="far fa-save"></i>Save & Continue</button>
                                <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i>Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Attachments Tab Content -->
                <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
                    <div class="main-card card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="inner-card card">
                                        <div class="card-body">
                                            <form>
                                                <div class="form-header">
                                                    <h3>Attachments</h3>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="fileUpload">Upload Files</label>
                                                    <input type="file" id="fileUpload" class="form-control" multiple>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="attachmentsList">Existing Attachments</label>
                                                    <ul id="attachmentsList" class="list-group">
                                                        <li class="list-group-item">File1.pdf</li>
                                                        <li class="list-group-item">File2.jpg</li>
                                                        <li class="list-group-item">File3.docx</li>
                                                    </ul>
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
    </script>
@endsection
@endsection
