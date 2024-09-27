@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Equipment Type Details')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <div class="card mt-5">
                <div class="card-body">
                    <!-- Equipment Type Description Section -->
                    <h5 class="mb-4">Equipment Type Description</h5>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="descriptionFormula">Description Formula</label>
                                <input class="form-control" type="text" name="description_formula"
                                    id="descriptionFormula" placeholder="Description Formula eg <<Height of Lift>>m">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="inspectionInterval">Inspection Interval</label>
                                <select id="inspectionInterval" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Equipment Type Attributes Section -->
                    <h5 class="mb-4">Equipment Type Attributes</h5>
                    <div id="section-container"></div>
                    <div class="form-group mb-3">
                        <button class="btn btn-sm add-section" id="add-section-btn">
                            <i class="fas fa-plus icon"></i> Add Section
                        </button>
                    </div>

                    <hr>

                    <!-- Reference Documents Section -->
                    <h5 class="mb-4">Reference Documents</h5>
                    <form action="#" class="dropzone" id="my-dropzone">
                        <div class="dz-message">
                            <h4>Drag and drop files here or click to upload</h4>
                        </div>
                    </form>

                    <!-- Save and Cancel Buttons -->
                    <div class="form-group mt-4">
                        <button type="button" class="btn btn-sm save-btn">
                            <i class="far fa-save icon"></i> Save Definition
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

        document.getElementById('add-section-btn').addEventListener('click', function() {
            const sectionContainer = document.getElementById('section-container');

            function addSection() {
                const section = document.createElement('div');
                section.classList.add('section', 'mb-4', 'p-3', 'border');

                const inputRow = document.createElement('div');
                inputRow.classList.add('row', 'mb-3');

                const sectionNameCol = document.createElement('div');
                sectionNameCol.classList.add('col-md-6');
                const sectionNameInput = document.createElement('input');
                sectionNameInput.type = 'text';
                sectionNameInput.placeholder = 'Section Name';
                sectionNameInput.classList.add('form-control');
                sectionNameCol.appendChild(sectionNameInput);

                const checkBoxCol = document.createElement('div');
                checkBoxCol.classList.add('col-md-6');
                const checkBoxInput = document.createElement('input');
                checkBoxInput.type = 'checkbox';
                checkBoxInput.name = `sectionCheckBox${sectionContainer.children.length + 1}`;
                checkBoxInput.classList.add('form-check-input', 'me-2');
                checkBoxInput.style.marginTop = '14px';
                const checkBoxLabel = document.createElement('label');
                checkBoxLabel.style.marginTop = '14px';
                checkBoxLabel.textContent = 'Section can repeat';
                checkBoxLabel.classList.add('form-check-label', 'mt-1');
                checkBoxCol.appendChild(checkBoxInput);
                checkBoxCol.appendChild(checkBoxLabel);

                inputRow.appendChild(sectionNameCol);
                inputRow.appendChild(checkBoxCol);
                section.appendChild(inputRow);

                const buttonRow = document.createElement('div');
                buttonRow.classList.add('d-flex', 'align-items-center', 'mb-3');

                const addFieldBtn = document.createElement('button');
                addFieldBtn.classList.add('btn', 'btn-add-field', 'btn-sm', 'me-2');
                addFieldBtn.innerHTML = '<i class="fas fa-plus icon"></i> Add Field';
                addFieldBtn.addEventListener('click', function() {
                    addField(section);
                });

                const duplicateSectionBtn = document.createElement('button');
                duplicateSectionBtn.classList.add('btn', 'btn-duplicate-section', 'btn-sm', 'me-2');
                duplicateSectionBtn.innerHTML = '<i class="fas fa-copy icon"></i> Duplicate Section';
                duplicateSectionBtn.addEventListener('click', function() {
                    const duplicateSection = section.cloneNode(true);
                    sectionContainer.appendChild(duplicateSection);
                    sectionContainer.lastElementChild.scrollIntoView({
                        behavior: 'smooth'
                    });
                    assignEventListeners(duplicateSection);
                });

                const deleteSectionBtn = document.createElement('button');
                deleteSectionBtn.classList.add('btn', 'btn-delete-section', 'btn-sm', 'me-2');
                deleteSectionBtn.innerHTML = '<i class="fas fa-trash-alt icon"></i> Delete Section';
                deleteSectionBtn.addEventListener('click', function() {
                    sectionContainer.removeChild(section);
                });

                buttonRow.appendChild(addFieldBtn);
                buttonRow.appendChild(duplicateSectionBtn);
                buttonRow.appendChild(deleteSectionBtn);

                section.appendChild(buttonRow);

                sectionContainer.appendChild(section);
            }

            function addField(section) {
                const fieldRow = document.createElement('div');
                fieldRow.classList.add('row', 'mb-2', 'field-row');

                const fieldNameCol = document.createElement('div');
                fieldNameCol.classList.add('col-md-3');
                const fieldNameInput = document.createElement('input');
                fieldNameInput.type = 'text';
                fieldNameInput.placeholder = 'Field Name';
                fieldNameInput.classList.add('form-control');
                fieldNameCol.appendChild(fieldNameInput);

                const selectCol = document.createElement('div');
                selectCol.classList.add('col-md-3');
                const selectInput = document.createElement('select');
                selectInput.classList.add('form-control');
                const option1 = document.createElement('option');
                option1.value = 'Option 1';
                option1.textContent = 'Option 1';
                const option2 = document.createElement('option');
                option2.value = 'Option 2';
                option2.textContent = 'Option 2';
                selectInput.appendChild(option1);
                selectInput.appendChild(option2);
                selectCol.appendChild(selectInput);

                const actionCol = document.createElement('div');
                actionCol.classList.add('col-md-6');
                actionCol.style.display = 'flex';
                actionCol.style.gap = '10px';
                actionCol.style.alignItems = 'center';

                // Visibility Button
                const visibilityBtn = document.createElement('button');
                visibilityBtn.classList.add('btn', 'btn-sm');
                visibilityBtn.style.backgroundColor = '#FFA500';
                visibilityBtn.style.color = '#FFFFFF';
                visibilityBtn.style.fontSize = '0.75rem';
                visibilityBtn.style.padding = '0.25rem 0.5rem';
                visibilityBtn.innerHTML = '<i class="fas fa-eye icon"></i> Visibility';
                visibilityBtn.addEventListener('click', function() {
                    alert('Visibility options modal would appear here.');
                });

                const deleteFieldBtn = document.createElement('button');
                deleteFieldBtn.classList.add('btn', 'btn-sm');
                deleteFieldBtn.style.backgroundColor = '#C0C0C0';
                deleteFieldBtn.style.color = '#FFFFFF';
                deleteFieldBtn.style.fontSize = '0.75rem';
                deleteFieldBtn.style.padding = '0.25rem 0.5rem';
                deleteFieldBtn.innerHTML = '<i class="fas fa-trash-alt icon"></i> Delete';
                deleteFieldBtn.addEventListener('click', function() {
                    section.removeChild(fieldRow);
                });

                actionCol.appendChild(visibilityBtn);
                actionCol.appendChild(deleteFieldBtn);

                fieldRow.appendChild(fieldNameCol);
                fieldRow.appendChild(selectCol);
                fieldRow.appendChild(actionCol);

                section.appendChild(fieldRow);
            }

            function assignEventListeners(section) {
                section.querySelector('.btn-add-field').addEventListener('click', function() {
                    addField(section);
                });

                section.querySelector('.btn-duplicate-section').addEventListener('click', function() {
                    const duplicateSection = section.cloneNode(true);
                    sectionContainer.appendChild(duplicateSection);
                    sectionContainer.lastElementChild.scrollIntoView({
                        behavior: 'smooth'
                    });
                    assignEventListeners(duplicateSection);
                });

                section.querySelector('.btn-delete-section').addEventListener('click', function() {
                    sectionContainer.removeChild(section);
                });

                section.querySelectorAll('.field-row .btn-danger').forEach(function(deleteBtn) {
                    deleteBtn.addEventListener('click', function() {
                        section.removeChild(deleteBtn.closest('.field-row'));
                    });
                });
            }

            addSection();
        });


        $("#inspectionInterval").select2({
            width: '100%',
            height: '100%',
        });
    </script>
@endsection
@endsection
