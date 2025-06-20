@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Edit Inspection')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <div class="card mt-5">
                <div class="card-body">
                    <!-- Inspection info Section -->
                    <h5 class="mb-4">Inspection Information</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="JobInfoClientSelect">Date of Inspection</label>
                                <input class="form-control" type="date" name="main_phone" id="mainPhone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="JobInfoClientSelect">Next inspection Date</label>
                                <input class="form-control" type="date" name="main_phone" id="mainPhone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="competenciesRequiredSelect">Performed By</label>
                                <select id="competenciesRequiredSelect" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="schedulingWorkersSelect">Location</label>
                            <select id="schedulingWorkersSelect" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>

                    <hr>

                    <!-- General Section -->
                    <h5 class="mb-4">General</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="examinationtypeSelect">Examination type</label>
                            <select id="examinationtypeSelect" class="form-control">
                                <option value="1">None Selected</option>
                                <option value="2">Visual</option>
                                <option value="3">Proof Load</option>
                                <option value="3">Visual + Proof Load</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="standardAppliedSelect">Standard Applied</label>
                                <select id="standardAppliedSelect" class="form-control">
                                    <option value="1">None Selected</option>
                                    <option value="2">Visual</option>
                                    <option value="3">Proof Load</option>
                                    <option value="3">Visual + Proof Load</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="status">Certificate No</label>
                                <input class="form-control" type="text" name="job_loc_phone" id="jobLocPhone">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="scheduleTime">Select All</label>
                                <div class="row">
                                    <div class="form-group col-md-6 mt-3">
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">Pass</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #7F8C8D;color: #fff;">Fail</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">N/A</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="scheduleTime">Mendatory Information present & legible</label>
                                <div class="row">
                                    <div class="form-group col-md-6 mt-3">
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">Pass</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #7F8C8D;color: #fff;">Fail</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">N/A</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="scheduleTime">Outer Cover</label>
                                <div class="row">
                                    <div class="form-group col-md-6 mt-3">
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">Pass</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #7F8C8D;color: #fff;">Fail</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">N/A</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="scheduleTime">Core</label>
                                <div class="row">
                                    <div class="form-group col-md-6 mt-3">
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">Pass</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #7F8C8D;color: #fff;">Fail</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">N/A</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="scheduleTime">Stitching</label>
                                <div class="row">
                                    <div class="form-group col-md-6 mt-3">
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">Pass</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #7F8C8D;color: #fff;">Fail</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">N/A</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="scheduleTime">Wear / Protective Sleeving</label>
                                <div class="row">
                                    <div class="form-group col-md-6 mt-3">
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">Pass</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #7F8C8D;color: #fff;">Fail</button>
                                        <button type="button" class="btn btn-sm"
                                            style="background-color: #E67E22;color: #fff;">N/A</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="description">Notes</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Testing Criteria Section -->
                    <h5 class="mb-4">Testing Criteria Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocPhone">Working Load Limit (LBS)</label>
                                <input class="form-control" type="text" name="job_loc_phone" id="jobLocPhone">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocMobile">Proof Load Applied (LBS)</label>
                                <input class="form-control" type="text" name="job_loc_mobile" id="jobLocMobile">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="equipmentUsedSelect">Test Equipment Used</label>
                                <select id="equipmentUsedSelect" class="form-control">
                                    <option value="1">None Selected</option>
                                    <option value="2">Visual</option>
                                    <option value="3">Proof Load</option>
                                    <option value="3">Visual + Proof Load</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="jobLocAddress">Duration Head (s)</label>
                                <input class="form-control" type="text" name="job_loc_address" id="jobLocAddress">
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-4">Attachements</h5>
                    <div class="form-group mb-3">
                        <form action="#" class="dropzone" id="my-dropzone">
                            <div class="dz-message">
                                <h4>Drag and drop files here or click to upload</h4>
                            </div>
                        </form>
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

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            Dropzone.autoDiscover = false;
            if (!Dropzone.instances.length) {
                let productDropzone = new Dropzone("#my-dropzone", {
                    maxFilesize: 5,
                    addRemoveLinks: true,
                    acceptedFiles: "image/*",
                    dictDefaultMessage: "Drop your files here or click to upload",
                    dictRemoveFile: "Remove",
                    dictMaxFilesExceeded: "You can only upload up to 5 images.",
                    autoProcessQueue: false,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    init: function() {
                        this.on("success", function(file, response) {
                            fileMappings[file.name] = response.path;
                            imagePaths.push(response);
                            $('#imagePaths').val(imagePaths.join(','));
                        });

                        this.on("addedfile", function(file) {
                            tempFilesArr.push(file);
                        });

                        this.on("removedfile", function(file) {
                            let index = tempFilesArr.findIndex(tempFile => tempFile.name ===
                                file
                                .name);
                            if (index !== -1) {
                                tempFilesArr.splice(index, 1);
                            }
                        });
                    }
                });
            }
        });
        $('#standardAppliedSelect').select2();
        $('#examinationtypeSelect').select2();
        $('#equipmentUsedSelect').select2();
    </script>
@endsection
@endsection
