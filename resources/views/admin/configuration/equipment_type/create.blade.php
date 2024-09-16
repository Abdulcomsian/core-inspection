@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Equipment Type Details')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="container-fluid">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="form-header">
                                    <h3>Equipment Type Description</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group input-spacing">
                                        <label for="description">Description</label>
                                        <input class="form-control" type="text" name="description" id="description"
                                            placeholder="Description">
                                    </div>
                                    <div class="form-group input-spacing">
                                        <label for="descriptionFormula">Description Formula</label>
                                        <input class="form-control" type="text" name="sale_order_no"
                                            id="descriptionFormula"
                                            placeholder="Description Formula eg <<Height of Lift>>m">
                                    </div>
                                    <div class="form-group input-spacing">
                                        <label for="salesOrderNo">Inspection Interval</label>
                                        <select id="inspectionInterval" class="form-control mb-3">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="form-header">
                                    <h3>Equipment Type Attributes</h3>
                                </div>
                                <div class="card-body">
                                    <div id="section-container"></div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button class="btn btn-sm mt-3 add-section" id="add-section-btn"><i
                                                    class="fas fa-plus icon"></i>Add
                                                Section</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="form-header">
                                    <h3>Reference Documents</h3>
                                </div>
                                <div class="card-body">
                                    <form action="#" class="dropzone" id="my-dropzone">
                                        <div class="dz-message">
                                            <h4>Drag and drop files here or click to upload</h4>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm save-btn"><i class="far fa-save icon"></i>Save
                                Definition</button>
                            <button type="button" class="btn btn-sm delete-btn"><i
                                    class="fa fa-ban icon"></i>Cancel</button>
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

            // Function to add a section
            function addSection() {
                const section = document.createElement('div');
                section.classList.add('section', 'mb-4', 'p-3', 'border');

                // Create input fields
                const inputRow = document.createElement('div');
                inputRow.classList.add('row', 'mb-3');

                const sectionNameCol = document.createElement('div');
                sectionNameCol.classList.add('col-md-6');
                const sectionNameInput = document.createElement('input');
                sectionNameInput.type = 'text';
                sectionNameInput.placeholder = 'Section Name';
                sectionNameInput.classList.add('form-control');
                sectionNameCol.appendChild(sectionNameInput);

                const radioButtonCol = document.createElement('div');
                radioButtonCol.classList.add('col-md-6');
                const radioInput = document.createElement('input');
                radioInput.type = 'radio';
                radioInput.name = `sectionRadio${sectionContainer.children.length + 1}`;
                radioInput.classList.add('form-check-input', 'me-2', 'mt-2');
                const radioLabel = document.createElement('label');
                radioLabel.textContent = 'Radio Button';
                radioLabel.classList.add('form-check-label', 'mt-3');
                radioButtonCol.appendChild(radioInput);
                radioButtonCol.appendChild(radioLabel);

                inputRow.appendChild(sectionNameCol);
                inputRow.appendChild(radioButtonCol);
                section.appendChild(inputRow);

                // Create buttons
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

            // Function to add a field row
            function addField(section) {
                const fieldRow = document.createElement('div');
                fieldRow.classList.add('row', 'mb-2', 'field-row');

                // Field Name Column
                const fieldNameCol = document.createElement('div');
                fieldNameCol.classList.add('col-md-3');
                const fieldNameInput = document.createElement('input');
                fieldNameInput.type = 'text';
                fieldNameInput.placeholder = 'Field Name';
                fieldNameInput.classList.add('form-control');
                fieldNameCol.appendChild(fieldNameInput);

                // Select Column
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

                // Action Buttons Column
                const actionCol = document.createElement('div');
                actionCol.classList.add('col-md-6'); // Adjust width as needed
                actionCol.style.display = 'flex'; // Use flexbox for horizontal alignment
                actionCol.style.gap = '10px'; // Space between buttons
                actionCol.style.alignItems = 'center'; // Vertically center buttons

                // Visibility Button
                const visibilityBtn = document.createElement('button');
                visibilityBtn.classList.add('btn', 'btn-sm'); // Ensure small button size
                visibilityBtn.style.backgroundColor = '#FFA500'; // Orange
                visibilityBtn.style.color = '#FFFFFF'; // White
                visibilityBtn.style.fontSize = '0.75rem'; // Adjust font size for small buttons
                visibilityBtn.style.padding = '0.25rem 0.5rem'; // Adjust padding for small size
                visibilityBtn.innerHTML = '<i class="fas fa-eye icon"></i> Visibility';
                visibilityBtn.addEventListener('click', function() {
                    // Code to show the modal (you can use Bootstrap's modal)
                    alert('Visibility options modal would appear here.');
                });

                // Delete Button
                const deleteFieldBtn = document.createElement('button');
                deleteFieldBtn.classList.add('btn', 'btn-sm'); // Ensure small button size
                deleteFieldBtn.style.backgroundColor = '#C0C0C0'; // Light Silver
                deleteFieldBtn.style.color = '#FFFFFF'; // White
                deleteFieldBtn.style.fontSize = '0.75rem'; // Adjust font size for small buttons
                deleteFieldBtn.style.padding = '0.25rem 0.5rem'; // Adjust padding for small size
                deleteFieldBtn.innerHTML = '<i class="fas fa-trash-alt icon"></i> Delete';
                deleteFieldBtn.addEventListener('click', function() {
                    section.removeChild(fieldRow);
                });

                // Append buttons to action column
                actionCol.appendChild(visibilityBtn);
                actionCol.appendChild(deleteFieldBtn);

                // Append columns to row
                fieldRow.appendChild(fieldNameCol);
                fieldRow.appendChild(selectCol);
                fieldRow.appendChild(actionCol);

                // Append row to section
                section.appendChild(fieldRow);
            }


            // Function to assign event listeners to a section
            function assignEventListeners(section) {
                section.querySelector('.btn-success').addEventListener('click', function() {
                    addField(section);
                });

                section.querySelector('.btn-info').addEventListener('click', function() {
                    const duplicateSection = section.cloneNode(true);
                    sectionContainer.appendChild(duplicateSection);
                    sectionContainer.lastElementChild.scrollIntoView({
                        behavior: 'smooth'
                    });
                    assignEventListeners(duplicateSection);
                });

                section.querySelector('.btn-danger').addEventListener('click', function() {
                    sectionContainer.removeChild(section);
                });

                // Reassign delete listeners for each field row
                section.querySelectorAll('.field-row .btn-danger').forEach(function(deleteBtn) {
                    deleteBtn.addEventListener('click', function() {
                        section.removeChild(deleteBtn.closest('.field-row'));
                    });
                });
            }

            // Add the first section
            addSection();
        });

        $('#inspectionInterval').select2();
    </script>
@endsection
@endsection
