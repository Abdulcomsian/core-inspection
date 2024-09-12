@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'General Settings')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="container-fluid">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                        aria-controls="general" aria-selected="true">General Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab"
                        aria-controls="attachments" aria-selected="false">Email Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="integrations-tab" data-toggle="tab" href="#integrations" role="tab"
                        aria-controls="integrations" aria-selected="false">Integration Settings</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-check-label mb-0" for="failedItemsStamp">Failed
                                                        Items Stamp</label>
                                                </div>

                                                <div class="col-md-1">
                                                    <input class="form-check-input mt-0" type="checkbox"
                                                        id="failedItemsStamp">
                                                </div>

                                                <div class="col-md-8">
                                                    <label class="form-check-label mb-0" for="failedItemsStamp">Failed
                                                        Items will have a failed stamp on the certificate.</label>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-check-label mb-0"
                                                        for="highlightFailedItems">Highlight Failed Items</label>
                                                </div>

                                                <div class="col-md-1">
                                                    <input class="form-check-input mt-0" type="checkbox"
                                                        id="highlightFailedItems">
                                                </div>

                                                <div class="col-md-8">
                                                    <label class="form-check-label mb-0" for="highlightFailedItems">On
                                                        Equipment register and summary report, failed items will be
                                                        highlighted.</label>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-check-label mb-0" for="preventEdits">Prevent
                                                        Workers From Inspection Edits</label>
                                                </div>

                                                <div class="col-md-1">
                                                    <input class="form-check-input mt-0" type="checkbox" id="preventEdits">
                                                </div>

                                                <div class="col-md-8">
                                                    <label class="form-check-label mb-0" for="preventEdits">Workers will
                                                        not be able to edit inspections other than their own.</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-check-label mb-0" for="repeatClientReference">Repeat
                                                        Client Reference</label>
                                                </div>

                                                <div class="col-md-1">
                                                    <input class="form-check-input mt-0" type="checkbox"
                                                        id="repeatClientReference">
                                                </div>

                                                <div class="col-md-8">
                                                    <label class="form-check-label mb-0" for="repeatClientReference">When
                                                        this option is selected, Repeat
                                                        Client Reference on the Equipment Details page when adding
                                                        multiple items.</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class="form-check-label mb-0"
                                                        for="repeatClientReference">Repeat Client Reference</label>
                                                </div>

                                                <div class="col-md-9">
                                                    <select id="geographicZoneSelect" class="form-control mb-3">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Email Settings -->
                <div class="tab-pane fade" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-check-label mb-0 font-weight-bold"
                                                for="emailReplyAddress">Email reply address</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control mt-0" type="email" name="emailReplyAddress"
                                                id="emailReplyAddress">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center">
                                            <i class="fa fa-question-circle" data-toggle="tooltip"
                                                title="When emails are sent from the system, this email address will be the reply address."></i>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <span class="col-lg-3 control-label font-weight-bold">Overdue Email
                                            Reminders</span>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-check-label mb-0" for="preventEdits">Automatically send
                                                clients emails.</label>
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center">
                                            <input class="form-check-input mt-0" type="checkbox" id="preventEdits">
                                        </div>
                                        <div class="col-md-8 d-flex align-items-center">
                                            <i class="fa fa-question-circle" data-toggle="tooltip"
                                                title="When this option is selected, emails will be automatically sent to clients."></i>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-check-label mb-0" for="repeatClientReference">Repeat Client
                                                Reference</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input class="form-control mt-0" type="email"
                                                placeholder="email@example.com" id="repeatClientReference">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-check-label mb-0" for="emailTextEditor">Email text to be
                                                sent</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="body"></textarea>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <span class="col-lg-3 control-label font-weight-bold">Completed job
                                            notifications</span>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-check-label mb-0" for="preventEdits">Comma separated list
                                                of email addresses to be notified</label>
                                        </div>
                                        <div class="col-md-8 d-flex align-items-center">
                                            <input class="form-control mt-0" type="email" name="email">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-check-label mb-0" for="preventEdits">Email Subject</label>
                                        </div>
                                        <div class="col-md-8 d-flex align-items-center">
                                            <input class="form-control mt-0" type="email" name="email">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-check-label mb-0" for="emailTextEditor">Text of email to be
                                                sent</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" id="content2" placeholder="Enter the Description" rows="5" name="body"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Integration Settings --}}
                <div class="tab-pane fade" id="integrations" role="tabpanel" aria-labelledby="integrations-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex align-items-center">
                                                <div class="col-md-2">
                                                    <label class="form-check-label mb-0"
                                                        for="repeatClientReference">Office
                                                        365 Client Secret</label>
                                                </div>

                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name=""
                                                        id="">
                                                </div>

                                                <div class="col-md-3 d-flex align-items-center">
                                                    <label class="form-check-label mb-0 me-2" style="margin-left: 10px;"
                                                        for="failedItemsStamp">(available if integration is setup)</label>
                                                    <button type="button" class="btn btn-info btn-sm">Test
                                                        Connection</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="d-flex align-items-center">
                                                <div class="col-md-2">
                                                    <label class="form-check-label mb-0"
                                                        for="repeatClientReference">Office
                                                        365 ClientId</label>
                                                </div>

                                                <!-- Input -->
                                                <div class="col-md-7">
                                                    <input type="text" class="form-control" name=""
                                                        id="">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <div class="d-flex align-items-center">
                                                <!-- Label -->
                                                <div class="col-md-2">
                                                    <label class="form-check-label mb-0" for="repeatClientReference">Xero
                                                        Connection</label>
                                                </div>

                                                <!-- Input -->
                                                <div class="col-md-7">
                                                    <button type="button" class="btn btn-info btn-sm">Connet to
                                                        Xero</button>
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
    </div>
    </div>
    </div>

@section('scripts')
    <script></script>
    @parent
    <script>
        $('#geographicZoneSelect').select2();

        ClassicEditor.create(document.querySelector('#content'))
            .catch(error => {
                console.error(error);
            });
        ClassicEditor.create(document.querySelector('#content2'))
            .catch(error => {
                console.error(error);
            });
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip(); // Initialize tooltips
        });
    </script>
@endsection
@endsection
