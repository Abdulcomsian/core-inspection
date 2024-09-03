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
                        <li class="breadcrumb-item text-muted">General Settings</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="definition-tab" data-toggle="tab" href="#definition" role="tab"
                        aria-controls="definition" aria-selected="false">Definition</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reports-tab" data-toggle="tab" href="#reports" role="tab"
                        aria-controls="reports" aria-selected="false">Reports</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">

                <!-- Definition -->
                <div class="tab-pane fade show active" id="definition" role="tabpanel" aria-labelledby="definition-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="form-group col-md-12">
                                            <label class="form-check-label mb-0 font-weight-bold"
                                                for="name">Name</label>
                                            <input class="form-control mt-0" type="email" name="name" id="name">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-check-label mb-0 font-weight-bold"
                                                for="equipmenType">Equipment Type</label>
                                            <input class="form-control mt-0" type="text" name="equipment_type"
                                                id="equipmenType">
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="form-check" style="margin-left: 310px;">
                                                <input class="form-check-input" type="checkbox" name="available_on_web"
                                                    id="availableOnWeb">
                                                <label class="form-check-label font-weight-bold" for="availableOnWeb">
                                                    Only available on web
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label class="form-check-label mb-0 font-weight-bold"
                                                for="competencies">Competencies</label>
                                            <input class="form-control mt-0" type="text" name="competencies"
                                                id="competencies">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <!-- Container to hold dynamic inputs -->
                                            <div id="colorCodingContainer"></div>
                                            <div id="colorCodingButtonContainer">
                                                <label class="form-check-label mb-0 font-weight-bold"
                                                    for="colorCoding">Color Coding</label>
                                                <button type="button" class="btn btn-primary btn-sm me-2"
                                                    id="addColorCoding">
                                                    <i class="fas fa-plus"></i> Add Color Coding
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <!-- Container to hold dynamic inputs -->
                                            <div id="failureOptionsContainer"></div>
                                            <div id="initialfailureOptions">
                                                <label class="form-check-label mb-0 font-weight-bold"
                                                    for="failureOptions">Failure Options</label>
                                                <button type="button" class="btn btn-primary btn-sm me-2"
                                                    id="addfailureOptions">
                                                    <i class="fas fa-plus"></i> Add Failure Options
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mt-5">
                                            <label class="form-check-label mb-0 font-weight-bold"
                                                for="competencies">Calculation Excel file</label>
                                            <input class="form-control mt-0" type="file" name="competencies"
                                                id="competencies">
                                        </div>

                                    </div>

                                    <hr>

                                    <div class="form-group col-md-12">
                                        <div class="form-check" style="margin-left: 310px;">
                                            <input class="form-check-input" type="checkbox" name="available_on_web"
                                                id="availableOnWeb">
                                            <label class="form-check-label font-weight-bold" for="availableOnWeb">
                                                Display all inspections on 1 certificate when multi items are selected?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Report --}}
                <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-5">
                                <div class="container-fluid">
                                    <div class="mt-3">
                                        <div class="d-flex mb-3">
                                            <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_add_user"><i class="fas fa-plus"></i>
                                                Add New
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="mytable"
                                                class="table table-bordered table-striped table-hover datatable datatable-Role"
                                                data-ordering="false">
                                                <thead>
                                                    <tr style="text-wrap: nowrap;">
                                                        <th></th>
                                                        <th>Name</th>
                                                        <th>Internal Only</th>
                                                        <th>Filename (click to download)</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="no-records">
                                                        <td><button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                                data-bs-target="#kt_modal_add_user">
                                                                Edit
                                                            </button></td>
                                                        <td>Full Register Template</td>
                                                        <td>
                                                            <input class="form-check-input" type="checkbox"
                                                                id="preventEdits">
                                                        </td>
                                                        <td>
                                                            Full Register Template.docx
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button class="btn btn-success btn-sm me-2">Copy</button>
                                                                <button class="btn btn-danger btn-sm">Delete</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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

    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h2 class="fw-bolder">Add User</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Email address</label>
                          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Example select</label>
                          <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect2">Example multiple select</label>
                          <select multiple class="form-control" id="exampleFormControlSelect2">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Example textarea</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                      </form>
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
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function() {
            // Function to add dynamic input fields for Color Coding
            $('#addColorCoding').on('click', function() {
                // Template for new Color Coding input
                const colorCodingTemplate = `
            <div class="form-group row align-items-center mb-2">
                <div class="col-md-4">
                    <label>When result</label>
                    <input type="text" name="color_labels[]" class="form-control" placeholder="Enter label">
                </div>
                <div class="col-md-4">
                    <label>Mark color with</label>
                    <select name="color_codes[]" class="form-control">
                        <option value="red">Red</option>
                        <option value="green">Green</option>
                        <option value="blue">Blue</option>
                    </select>
                </div>
                <div class="col-md-2 mt-4">
                    <button type="button" class="btn btn-danger btn-sm removeColorCoding">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        `;

                // Append the new input group to the container
                $('#colorCodingContainer').append(colorCodingTemplate);

                // Move the button container below the newly added input group
                $('#colorCodingContainer').append($('#colorCodingButtonContainer'));
            });

            // Remove Color Coding input
            $(document).on('click', '.removeColorCoding', function() {
                $(this).closest('.form-group').remove();
            });

            // Function to add dynamic input fields for Failure Options
            $('#addfailureOptions').click(function() {
                let optionIndex = $('#failureOptionsContainer .input-group').length + 1;

                // Template for new Failure Option input
                const failureOptionsTemplate = `
            <div class="form-group row align-items-center mb-2" id="option-${optionIndex}">
                <div class="col-md-8">
                    <label>Fail when any values are equal to</label>
                    <input type="text" class="form-control" name="failureOptions[]" placeholder="Text Value">
                </div>
                <div class="col-md-2 mt-4">
                    <button type="button" class="btn btn-danger btn-sm remove-option" data-index="${optionIndex}">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        `;

                // Append the new input group to the container
                $('#failureOptionsContainer').append(failureOptionsTemplate);

                // Move the button below the newly added input group
                $('#failureOptionsContainer').append($('#initialfailureOptions'));
            });

            // Remove Failure Option input
            $(document).on('click', '.remove-option', function() {
                const index = $(this).data('index');
                $(`#option-${index}`).remove();
            });
        });
    </script>
@endsection
@endsection
