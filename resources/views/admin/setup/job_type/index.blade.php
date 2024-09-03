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
                        <li class="breadcrumb-item text-muted">Equipment Type Details</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <form action="#">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="form-header">
                                        <h3>Equipment Type Description</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group input-spacing">
                                            <label for="description">Description</label>
                                            <input class="form-control" type="text" name="description"
                                                id="description" placeholder="Description">
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
                                                <button class="btn btn-primary btn-sm mt-3" id="add-section-btn"><i
                                                        class="fas fa-plus"></i>Add
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
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="/upload" class="dropzone" id="my-dropzone">
                                                    <div class="dz-message">
                                                        <h4>Drag and drop files here or click to upload</h4>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm"><i
                                        class="far fa-save"></i>Save Definition</button>
                                <button type="button" class="btn btn-danger btn-sm"><i
                                        class="fa fa-ban"></i>Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    </div>

@section('scripts')
    @parent
    <script>
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
                addFieldBtn.classList.add('btn', 'btn-success', 'btn-sm', 'me-2');
                addFieldBtn.innerHTML = '<i class="fas fa-plus"></i> Add Field';
                addFieldBtn.addEventListener('click', function() {
                    addField(section);
                });

                const duplicateSectionBtn = document.createElement('button');
                duplicateSectionBtn.classList.add('btn', 'btn-info', 'btn-sm', 'me-2');
                duplicateSectionBtn.innerHTML = '<i class="fas fa-copy"></i> Duplicate Section';
                duplicateSectionBtn.addEventListener('click', function() {
                    const duplicateSection = section.cloneNode(true);
                    sectionContainer.appendChild(duplicateSection);
                    sectionContainer.lastElementChild.scrollIntoView({
                        behavior: 'smooth'
                    });
                    assignEventListeners(duplicateSection);
                });

                const deleteSectionBtn = document.createElement('button');
                deleteSectionBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'me-2');
                deleteSectionBtn.innerHTML = '<i class="fas fa-trash-alt"></i> Delete Section';
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

                const visibilityCol = document.createElement('div');
                visibilityCol.classList.add('col-md-3');
                const visibilityBtn = document.createElement('button');
                visibilityBtn.classList.add('btn', 'btn-warning', 'btn-sm', 'me-2');
                visibilityBtn.innerHTML = '<i class="fas fa-eye"></i> Visibility';
                visibilityBtn.addEventListener('click', function() {
                    // Code to show the modal (you can use Bootstrap's modal)
                    alert('Visibility options modal would appear here.');
                });
                visibilityCol.appendChild(visibilityBtn);

                const deleteFieldBtnCol = document.createElement('div');
                deleteFieldBtnCol.classList.add('col-md-3');
                const deleteFieldBtn = document.createElement('button');
                deleteFieldBtn.classList.add('btn', 'btn-danger', 'btn-sm');
                deleteFieldBtn.innerHTML = '<i class="fas fa-trash-alt"></i> Delete';
                deleteFieldBtn.addEventListener('click', function() {
                    section.removeChild(fieldRow);
                });
                deleteFieldBtnCol.appendChild(deleteFieldBtn);

                fieldRow.appendChild(fieldNameCol);
                fieldRow.appendChild(selectCol);
                fieldRow.appendChild(visibilityCol);
                fieldRow.appendChild(deleteFieldBtnCol);

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
