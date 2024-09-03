@extends('layouts.admin')
@section('styles')
    <style>
        .switch.ios,
        .switch-on.ios,
        .switch-off.ios {
            border-radius: 20rem;
        }

        .switch.ios .switch-handle {
            border-radius: 20rem;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .switch {
            position: relative;
            display: inline-block;
            align-items: center;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .switch .custom-control {
            margin-right: 15px;
        }

        .actions {
            white-space: nowrap;
        }

        .actions button {
            margin-left: 5px;
        }

        .upload-icon {
            display: block;
            font-size: 2rem;
            color: #007FFF;
            margin-bottom: 10px;
        }

        .dz-message {
            text-align: center;
        }

        .ridge {
            border-style: ridge;
            border-width: 2px;
            border-color: lightgray;
            padding: 10px;
            height: 200px;
            max-height: 200px;
            overflow-y: auto;
        }

        #editVariantDropzone {
            border-width: 1px;
            height: 200px;
            overflow-y: auto;
        }

        .note-text {
            background-color: #FFF9C4;
            padding: 4px;
        }
    </style>
@endsection

@section('content')

    {{-- Product Section --}}
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.product.title') }}
        </div>
        <div class="card-body">
            <p class="mb-4"><strong>{{ trans('cruds.product.title') }} {{ trans('global.details') }}</strong></p>
            <div class="form-group">
                <div class="row">
                    <div class="col-5">
                        <label for="title" class="required">{{ trans('global.upload_multiple_images') }}</label>
                        <form action="/upload" class="dropzone" id="productDropzone" enctype="multipart/form-data">
                            <div class="dz-message">
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <span>{{ trans('global.drop_your_files') }}</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col">
                    <label for="title" class="required">{{ trans('global.title') }}:</label>
                    <input type="text" class="form-control" id="productTitle" name="product_title">
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="productSku" class="required">{{ trans('cruds.product.fields.sku') }}:</label>

                        @if ($taxSetting && $taxSetting->fill_sku_no === 'on')
                            <input type="text" class="form-control" id="productSku" name="product_sku"
                                placeholder="Enter SKU" value="{{ old('sku') }}">
                        @else
                            <input type="text" class="form-control" id="productSku" placeholder="Enter SKU">
                            <div id="skuHint" style="font-size: 12px; color: #999;"></div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-4">
                    <label for="selling-price">{{ trans('cruds.product.fields.minimum_selling') }}
                        {{ trans('global.price') }}:</label>
                    <input type="number" class="form-control" id="productSellingPrice">
                </div>
                <div class="col-4">
                    <label for="default-price" class="required">{{ trans('global.default') }}
                        {{ trans('global.price') }}:</label>
                    <input type="number" class="form-control" id="productDefaultPrice">
                </div>
                <div class="col-4 d-flex align-items-center mt-4">
                    <label for="sellableToggle" class="mr-2">{{ trans('cruds.product.fields.sellable') }}</label>
                    <label class="switch">
                        <input type="checkbox" id="sellableToggle" checked>
                        <span class="slider round"></span>
                    </label>
                    <label for="nonSellableToggle" class="ml-2">{{ trans('cruds.product.fields.non_sellable') }}</label>
                </div>
            </div>

            <div class="form-group">
                <label for="editor" class="required">{{ trans('cruds.product.title') }}
                    {{ trans('global.fields.description') }}:</label>
                <textarea class="form-control" id="productDetail" name="productDetail"></textarea>
            </div>

            <div class="form-group row">
                <div class="col">
                    <label for="brand">{{ trans('global.fields.brand') }}:</label>
                    <select class="form-control" id="productBrand" name="product_brand">
                        <option value="">{{ trans('global.select') }} {{ trans('global.fields.brand') }}
                        </option>
                        @if (isset($brands))
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col">
                    <label for="unit-type" class="required">{{ trans('global.fields.unit_type') }}:</label>
                    <select class="form-control" id="productUnitType" name="product_unittype">
                        <option value="">{{ trans('global.select') }} {{ trans('global.fields.unit_type') }}
                        </option>
                        @if (isset($unit_types))
                            @foreach ($unit_types as $unit_type)
                                <option value="{{ $unit_type->id }}">{{ $unit_type->abbreviation }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col">
                    <label for="category">{{ trans('global.fields.category') }}:</label>
                    <select class="form-control" id="category" name="product_category">
                        <option value="">{{ trans('global.select') }} {{ trans('global.fields.category') }}
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="subcategory">{{ trans('global.fields.subcategory') }}:</label>
                    <select class="form-control" id="subcategory" name="product_subcategory">
                        <option value="">{{ trans('global.select') }}
                            {{ trans('global.fields.subcategory') }}
                        </option>
                    </select>
                </div>
            </div>
            <p class="mb-4">
                <strong>{{ trans('cruds.product.fields.tax_calculation_option') }}</strong>
            </p>
            <div class="col-4 d-flex align-items-center mt-4">
                <div>
                    <label for="taxToggle" class="mr-2">{{ trans('global.add') }} {{ $taxSetting->tax }}%
                        {{ trans('global.tax') }}</label>
                    <label class="switch">
                        <input type="checkbox" id="taxToggle" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
                <div style="margin-left: 20px;">
                    <label for="isQtyInfinite">{{ trans('global.is_infinite') }}</label>
                    <label class="switch">
                        <input type="checkbox" id="isQtyInfinite" checked>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-4">
                    <label for="product-cost">{{ trans('cruds.product.title') }}
                        {{ trans('cruds.product.fields.cost') }}:</label>
                    <input type="number" class="form-control" id="productCost">
                </div>
                <div class="col-4">
                    <label for="adjust-quantity">{{ trans('global.adjust') }}
                        {{ trans('global.fields.quantity') }}:</label>
                    <div class="input-group">
                        <input type="number" class="form-control mr-2" id="adjust-quantity" disabled>
                        <div class="input-group-append">
                            <button class="btn btn-info" id="addBtn">{{ trans('global.add') }}</button>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <label for="currentQuantity">{{ trans('global.current') }}
                        {{ trans('global.fields.quantity') }}:</label>
                    <input type="number" class="form-control" id="currentQuantity" readonly>
                </div>
            </div>

            <div class="form-group row align-items-center">
                <div class="col mt-4">
                    <p><strong>{{ trans('global.fields.supplier') }} {{ trans('global.information') }}</strong>
                    </p>
                </div>
            </div>

            <div class="form-group row">
                <div class="col">
                    <label for="supplier-name">{{ trans('global.name') }}:</label>
                    <input type="text" class="form-control" id="supplier-name">
                </div>
                <div class="col">
                    <label for="contact-no">{{ trans('global.contact') }} {{ trans('global.number') }}:</label>
                    <input type="number" class="form-control" id="contact-no">
                </div>
            </div>
            <div class="form-group">
                <label for="detail">{{ trans('global.detail') }}:</label>
                <textarea class="form-control" id="supplierDetail"></textarea>
            </div>

            <div class="form-group">
                <button class="submit btn btn btn-success" id="saveProductBtnForm">{{ trans('global.save') }}</button>
            </div>

            <div class="note-text">
                <p><strong>{{ trans('global.note') }}:</strong> {{ trans('global.after_saving_product') }}.</p>
            </div>
        </div>
    </div>
    {{-- End Product Section --}}

    {{-- Variant Section --}}
    <div id="variantsSection" style="display: none;">
        <div class="card">
            <div class="card-header">
                {{ trans('global.create') }} {{ trans('cruds.variant.title_plural') }}
            </div>
            <div class="form-group ml-3 mt-3">
                <button type="button" class="btn btn-primary btn-success" data-toggle="modal"
                    data-target="#variantModal">
                    {{ trans('global.add') }} {{ trans('cruds.variant.title') }}
                </button>
            </div>
            <div class="card-body">
                <!--Create Variant Modal -->
                <div class="modal fade" id="variantModal" tabindex="-1" role="dialog"
                    aria-labelledby="variantModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="variantModalLabel">{{ trans('global.add') }}
                                    {{ trans('cruds.variant.title') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-4"><strong>{{ trans('cruds.variant.title') }}
                                        {{ trans('global.details') }}</strong></p>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="title"
                                                class="required">{{ trans('global.upload_multiple_images') }}</label>
                                            <form action="/upload" class="dropzone" id="variantDropzone"
                                                enctype="multipart/form-data">
                                                <div class="dz-message">
                                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                                    <span>{{ trans('global.drop_your_files') }}</span>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-3">
                                        <label for="variant-type" class="required">{{ trans('cruds.variant.title') }}
                                            {{ trans('global.type') }}:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="variant-type">
                                                <option value="">{{ trans('global.select') }}
                                                    {{ trans('cruds.variant.title') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="title">{{ trans('global.add') }}
                                            {{ trans('global.new') }}
                                            {{ trans('global.type') }}:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control ml-2" id="newVariantType">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="title" class="required">{{ trans('global.title') }}:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="variantTitle">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="variant_sku">{{ trans('cruds.product.fields.sku') }}:</label>
                                        <div class="input-group">
                                            @if ($taxSetting && $taxSetting->fill_sku_no === 'on')
                                                <input type="text" class="form-control" id="variant_sku"
                                                    name="variant_sku" placeholder="Enter SKU"
                                                    value="{{ old('variant_sku') }}">
                                            @else
                                                <input type="text" class="form-control" id="variant_sku"
                                                    placeholder="Enter SKU">
                                                <div id="variantSkuHint" style="font-size: 12px; color: #999;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="selling-price">{{ trans('cruds.product.fields.minimum_selling') }}
                                            {{ trans('global.price') }}:</label>
                                        <input type="number" class="form-control" id="variantSellingPrice">
                                    </div>
                                    <div class="col-4">
                                        <label for="default-price" class="required">{{ trans('global.default') }}
                                            {{ trans('global.price') }}:</label>
                                        <input type="number" class="form-control" id="variantDefaultPrice">
                                    </div>
                                    <div class="col-4 d-flex align-items-center mt-4">
                                        <div class="d-flex align-items-center">
                                            <p class="mr-3">
                                                <strong>{{ trans('cruds.product.fields.sellable') }}</strong>
                                            </p>
                                            <label class="switch">
                                                <input type="checkbox" id="isSellableCheckbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                            <p class="ml-3">
                                                <strong>{{ trans('cruds.product.fields.non_sellable') }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editor3" class="required">{{ trans('cruds.variant.title') }}
                                        {{ trans('global.fields.description') }}:</label>
                                    <textarea class="form-control" name="variantDetail" id="variantDetail"></textarea>
                                </div>

                                <div class="col-4 d-flex align-items-center mt-4">
                                    <div>
                                        <label for="isVariantQtyInfinite">{{ trans('global.is_infinite') }}</label>
                                        <label class="switch">
                                            <input type="checkbox" id="isVariantQtyInfinite" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="variant-cost">{{ trans('cruds.variant.title') }}
                                            {{ trans('cruds.product.fields.cost') }}:</label>
                                        <input type="number" class="form-control" id="variant-cost">
                                    </div>
                                    <div class="col-4">
                                        <label for="adjust-quantity">{{ trans('global.adjust') }}
                                            {{ trans('global.fields.quantity') }}:</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control mr-2" id="adjust-variant-quantity">
                                            <div class="input-group-append">
                                                <button class="btn btn-info"
                                                    id="addVariantBtn">{{ trans('global.add') }}</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label for="currentQuantity">{{ trans('global.current') }}
                                            {{ trans('global.fields.quantity') }}:</label>
                                        <input type="number" class="form-control" id="currentVariantQuantity" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-success"
                                    id="saveVariantBtn">{{ trans('global.save') }}</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-dismiss="modal">{{ trans('global.close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Create Variant Modal -->
                <div class="table-responsive mt-3">
                    <table id="variantsTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('global.sno') }}</th>
                                <th>{{ trans('global.title') }}</th>
                                <th>{{ trans('cruds.variant.title') }} {{ trans('global.type') }}</th>
                                <th>{{ trans('cruds.product.fields.sku') }}</th>
                                <th>{{ trans('global.fields.quantity') }}</th>
                                <th>{{ trans('global.default') }} {{ trans('global.price') }}</th>
                                <th>{{ trans('global.fields.minimum') }} {{ trans('global.price') }}</th>
                                <th>{{ trans('cruds.product.fields.sellable') }}</th>
                                <th>{{ trans('global.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <!-- Edit Variant Modal -->
                <div class="modal fade" id="editVariantModal" tabindex="-1" role="dialog"
                    aria-labelledby="editVariantModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editVariantModalLabel">{{ trans('global.edit') }}
                                    {{ trans('cruds.variant.title') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="editVariantId">
                                <p class="mb-4"><strong>{{ trans('cruds.variant.title') }}
                                        {{ trans('global.details') }}</strong></p>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="/upload" class="dropzone" id="editVariantDropzone"
                                                enctype="multipart/form-data">
                                                <div class="dz-message">
                                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                                    <span>{{ trans('global.drop_your_files') }}</span>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-6 ridge">
                                            <div class="row" id="editVariantImages">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-3">
                                        <label for="variant-type" class="required">{{ trans('cruds.variant.title') }}
                                            {{ trans('global.type') }}:</label>
                                        <div class="input-group">
                                            <select class="form-control" id="edit-variant-type">
                                                <option value="">{{ trans('global.select') }}
                                                    {{ trans('cruds.variant.title') }}</option>
                                                <option value="">{{ trans('global.select') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="title">{{ trans('global.add') }}
                                            {{ trans('global.new') }}
                                            {{ trans('global.type') }}:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control ml-2" id="editNewVariantType">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="title" class="required">{{ trans('global.title') }}:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="editVariantTitle">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="variant_sku">{{ trans('cruds.product.fields.sku') }}:</label>
                                        <div class="input-group">
                                            @if ($taxSetting && $taxSetting->fill_sku_no === 'on')
                                                <input type="text" class="form-control" id="edit_variant_sku"
                                                    name="variant_sku" placeholder="Enter SKU"
                                                    value="{{ old('variant_sku') }}" readonly>
                                            @else
                                                <input type="text" class="form-control" id="edit_variant_sku"
                                                    placeholder="Enter SKU" readonly>
                                                <div id="variantSkuHint" style="font-size: 12px; color: #999;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="selling-price">{{ trans('cruds.product.fields.minimum_selling') }}
                                            {{ trans('global.price') }}:</label>
                                        <input type="number" class="form-control" id="editVariantSellingPrice">
                                    </div>
                                    <div class="col-4">
                                        <label for="default-price" class="required">{{ trans('global.default') }}
                                            {{ trans('global.price') }}:</label>
                                        <input type="number" class="form-control" id="editVariantDefaultPrice">
                                    </div>
                                    <div class="col-4 d-flex align-items-center mt-4">
                                        <div class="d-flex align-items-center">
                                            <p class="mr-3">
                                                <strong>{{ trans('cruds.product.fields.sellable') }}</strong>
                                            </p>
                                            <label class="switch">
                                                <input type="checkbox" id="editIsSellableCheckbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                            <p class="ml-3">
                                                <strong>{{ trans('cruds.product.fields.non_sellable') }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editor3" class="required">{{ trans('cruds.variant.title') }}
                                        {{ trans('global.fields.description') }}:</label>
                                    <textarea class="form-control" id="editVariantDetail"></textarea>
                                </div>
                                <div class="col-4 d-flex align-items-center mt-4">
                                    <div>
                                        <label for="isEditVariantQtyInfinite">{{ trans('global.is_infinite') }}</label>
                                        <label class="switch">
                                            <input type="checkbox" id="isEditVariantQtyInfinite" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-4">
                                        <label for="variant-cost">{{ trans('cruds.variant.title') }}
                                            {{ trans('cruds.product.fields.cost') }}:</label>
                                        <input type="number" class="form-control" id="editVariantCost">
                                    </div>
                                    <div class="col-4">
                                        <label for="edit-adjust-quantity">{{ trans('global.adjust') }}
                                            {{ trans('global.fields.quantity') }}:</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control mr-2" id="editAdjustVariantQty">
                                            <div class="input-group-append">
                                                <button class="btn btn-info"
                                                    id="editVariantQtyBtn">{{ trans('global.add') }}</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label for="currentQuantity">{{ trans('global.current') }}
                                            {{ trans('global.fields.quantity') }}:</label>
                                        <input type="number" class="form-control" id="editCurrentVariantQuantity"
                                            readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-success"
                                    id="editVariantBtn">{{ trans('global.update') }}</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-dismiss="modal">{{ trans('global.close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Edit Variant Modal -->
            </div>
        </div>
    </div>
    {{-- End Variant Section --}}

    {{-- Hidden Inputs --}}
    <input type="hidden" id="imagePaths" name="imagePaths" value="">
    <input type="hidden" id="variantImagePaths" name="variantImagePath" value="">
    <input type="hidden" id="productFormData" name="productFormData" value="">
    <input type="hidden" id="variantDatabaseImages" name="variantDatabaseImages">
    {{-- End Hidden Inputs --}}
@endsection

@section('scripts')
    @parent
    <script>
        var subcategories = {!! json_encode($subcategories) !!};
        document.getElementById('category').addEventListener('change', function() {
            var categoryId = this.value;
            var subcategoryDropdown = document.getElementById('subcategory');

            subcategoryDropdown.innerHTML =
                '<option value="">{{ trans('global.select') }} {{ trans('global.fields.subcategory') }}</option>';

            subcategories.forEach(function(subcategory) {
                if (subcategory.category_id == categoryId) {
                    var option = document.createElement('option');
                    option.value = subcategory.id;
                    option.text = subcategory.name;
                    subcategoryDropdown.appendChild(option);
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const variantTypeSelect = document.getElementById('variant-type');
            const newVariantTypeInput = document.getElementById('newVariantType');

            newVariantTypeInput.addEventListener('blur', function() {
                addNewVariantType();
            });

            newVariantTypeInput.addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    addNewVariantType();
                }
            });

            function addNewVariantType() {
                const newVariantType = newVariantTypeInput.value.trim();
                if (newVariantType !== '' && !variantTypeSelect.querySelector(
                        `option[value="${newVariantType}"]`)) {
                    const option = document.createElement('option');
                    option.value = newVariantType;
                    option.textContent = newVariantType;

                    variantTypeSelect.insertBefore(option, variantTypeSelect.children[1]);

                    newVariantTypeInput.value = '';
                }
            }

            const editVariantTypeSelect = document.getElementById('edit-variant-type');
            const editNewVariantTypeInput = document.getElementById('editNewVariantType');

            editNewVariantTypeInput.addEventListener('blur', function() {
                editNewVariantType();
            });

            editNewVariantTypeInput.addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    editNewVariantType();
                }
            });

            function editNewVariantType() {
                const editNewVariantType = editNewVariantTypeInput.value.trim();
                if (editNewVariantType !== '' && !editVariantTypeSelect.querySelector(
                        `option[value="${editNewVariantType}"]`)) {
                    const option = document.createElement('option');
                    option.value = editNewVariantType;
                    option.textContent = editNewVariantType;

                    editVariantTypeSelect.insertBefore(option, editVariantTypeSelect.children[1]);

                    editNewVariantTypeInput.value = '';
                }
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            generateSKUNumbers();
        });

        $('#variantModal').on('shown.bs.modal', function(e) {
            generateSKUNumbers();

            var variantDropzone = Dropzone.forElement("#variantDropzone");
            if (variantDropzone !== null) {
                variantDropzone.removeAllFiles();
            }

        });

        $('.edit-variant').on('shown.bs.modal', function(e) {
            generateSKUNumbers();

            var editVariantDropzone = Dropzone.forElement("#editVariantDropzone");
            if (editVariantDropzone !== null) {
                editVariantDropzone.removeAllFiles();
            }
        });

        function generateSKUNumbers() {
            var fill_sku_no = '{{ $taxSetting && $taxSetting->fill_sku_no === 'on' ? 'on' : 'off' }}';

            $.ajax({
                url: '{{ route('admin.product.next_sku') }}',
                type: 'GET',
                success: function(response) {
                    if (fill_sku_no === 'on') {
                        $('#productSku').val(response);
                        $('#productSku').prop('readonly', true);
                    }
                },
                error: function(error) {
                    console.error('Error fetching next SKU for productSku:', error);
                }
            });

            $.ajax({
                url: '{{ route('admin.variant.next_sku') }}',
                type: 'GET',
                success: function(response) {
                    if (fill_sku_no === 'on') {
                        $('#variant_sku').val(response);
                        $('#variant_sku').prop('readonly', true);
                    }
                },
                error: function(error) {
                    console.error('Error fetching next SKU for variantSku:', error);
                }
            });

            if (fill_sku_no === 'off') {
                $.ajax({
                    url: '{{ route('admin.product.last_sku') }}',
                    type: 'GET',
                    success: function(response) {
                        $('#skuHint').text('You should start SKU from: ' + response);
                    },
                    error: function(error) {
                        console.error('Error fetching last SKU for productSku:', error);
                    }
                });

                $.ajax({
                    url: '{{ route('admin.variant.last_sku') }}',
                    type: 'GET',
                    success: function(response) {
                        $('#variantSkuHint').text('You should start SKU from: ' + response);
                    },
                    error: function(error) {
                        console.error('Error fetching last SKU for variantSku:', error);
                    }
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            $.ajax({
                url: '{{ route('admin.variant.variant_types') }}',
                type: 'GET',
                success: function(response) {
                    $('#variant-type, #edit-variant-type').empty();
                    response.forEach(function(type) {
                        $('#variant-type, #edit-variant-type').append($('<option>', {
                            value: type,
                            text: type
                        }));
                    });
                },
                error: function(error) {
                    console.error('Error fetching variant types:', error);
                }
            });
        });

        $(document).ready(function() {
            updateCurrentQuantity();

            $('#isQtyInfinite').change(function() {
                updateCurrentQuantity();
            });

            $('#addBtn').click(function() {
                var adjustQuantity = parseInt($('#adjust-quantity').val());
                var currentQuantity = parseInt($('#currentQuantity').val());

                $('#adjust-quantity').val('');

                if (isNaN(currentQuantity)) {
                    currentQuantity = 0;
                }

                if (!isNaN(adjustQuantity)) {
                    if (adjustQuantity < 0 && Math.abs(adjustQuantity) > currentQuantity) {
                        alert('Adjust quantity cannot be greater than current quantity.');
                        return;
                    }

                    var newQuantity = currentQuantity + adjustQuantity;
                    newQuantity = Math.max(newQuantity, 0);

                    $('#currentQuantity').val(newQuantity);
                } else {
                    alert('Please enter a valid quantity.');
                }
            });

            function updateCurrentQuantity() {
                if ($('#isQtyInfinite').prop('checked')) {
                    $('#currentQuantity').val(0);
                    $('#adjust-quantity').prop('disabled', true).val('');
                } else {
                    $('#adjust-quantity').prop('disabled', false);
                }
            }
        });


        $(document).ready(function() {
            updateVariantCurrentQuantity();

            $('#isVariantQtyInfinite').change(function() {
                updateVariantCurrentQuantity();
            });

            $('#addVariantBtn').click(function() {
                var adjustVariantQuantity = parseInt($('#adjust-variant-quantity').val());
                var currentVariantQuantity = parseInt($('#currentVariantQuantity').val());

                $('#adjust-variant-quantity').val('');

                if (isNaN(currentVariantQuantity)) {
                    currentVariantQuantity = 0;
                }

                if (!isNaN(adjustVariantQuantity)) {
                    if (adjustVariantQuantity < 0 && Math.abs(adjustVariantQuantity) >
                        currentVariantQuantity) {
                        alert('Adjust variant quantity cannot be greater than current variant quantity.');
                        return;
                    }

                    var newVariantQuantity = currentVariantQuantity + adjustVariantQuantity;
                    newVariantQuantity = Math.max(newVariantQuantity, 0);

                    $('#currentVariantQuantity').val(newVariantQuantity);
                } else {
                    alert('Please enter a valid quantity.');
                }
            });

            function updateVariantCurrentQuantity() {
                if ($('#isVariantQtyInfinite').prop('checked')) {
                    $('#currentVariantQuantity').val(0);
                    $('#adjust-variant-quantity').prop('disabled', true).val('');
                } else {
                    $('#adjust-variant-quantity').prop('disabled', false);
                }
            }
        });


        $(document).ready(function() {
            $('#isEditVariantQtyInfinite').change(function() {
                updateEditVariantCurrentQuantity();
            });
            $('#editVariantQtyBtn').click(function() {
                var adjustVariantQuantity = parseInt($('#editAdjustVariantQty').val());
                var currentVariantQuantity = parseInt($('#editCurrentVariantQuantity').val());

                $('#editAdjustVariantQty').val('');

                if (isNaN(currentVariantQuantity)) {
                    currentVariantQuantity = 0;
                }

                if (!isNaN(adjustVariantQuantity)) {
                    if (adjustVariantQuantity < 0 && Math.abs(adjustVariantQuantity) >
                        currentVariantQuantity) {
                        alert('Adjust variant quantity cannot be greater than current variant quantity.');
                        return;
                    }

                    var newVariantQuantity = currentVariantQuantity + adjustVariantQuantity;
                    newVariantQuantity = Math.max(newVariantQuantity, 0);

                    $('#editCurrentVariantQuantity').val(newVariantQuantity);
                } else {
                    alert('Please enter a valid quantity.');
                }
            });

            function updateEditVariantCurrentQuantity() {
                if ($('#isEditVariantQtyInfinite').prop('checked')) {
                    $('#editCurrentVariantQuantity').val(0);
                    $('#editAdjustVariantQty').prop('disabled', true).val('');
                } else {
                    $('#editAdjustVariantQty').prop('disabled', false);
                }
            }
        });

        // Save Product Section

        $(document).ready(function() {
            let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            let fileMappings = [];
            let imagePaths = [];
            let tempFilesArr = [];

            Dropzone.options.imageUpload = {
                maxFilesize: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif"
            };

            let productDropzone = new Dropzone("#productDropzone", {
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
                        let index = tempFilesArr.findIndex(tempFile => tempFile.name === file
                            .name);
                        if (index !== -1) {
                            tempFilesArr.splice(index, 1);
                        }
                    });
                }
            });

            $('#saveProductBtnForm').on('click', function() {

                var errorMessages = [];

                if ($('#productDropzone .dz-preview').length === 0) {
                    errorMessages.push("At least one image is required.");
                }

                var productDefaultPrice = $('#productDefaultPrice').val();
                if (!productDefaultPrice) {
                    errorMessages.push("Default price is required.");
                }

                var productDetail = productDataEditor.getData();
                if (!productDetail) {
                    errorMessages.push("product Description is required.");
                }

                var productUnitType = $('#productUnitType').val();
                if (!productUnitType) {
                    errorMessages.push("Unit type is required.");
                }

                if (errorMessages.length > 0) {
                    var errorMessage = errorMessages.join("<br>");
                    toastr.error(errorMessage);
                    return;
                }

                let url = "{{ route('admin.product.image.upload') }}";

                const formObj = new FormData();
                tempFilesArr.forEach((file) => {
                    formObj.append('files[]', file);
                });

                fetch(url, {
                        method: 'POST',
                        body: formObj,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then((resp) => resp.json())
                    .then((res) => {
                        var productData = {
                            productId: $('#productId').val(),
                            productImages: res,
                            title: $('#productTitle').val(),
                            sku: $('#productSku').val() || $('#product-sku').val(),
                            sellingPrice: $('#productSellingPrice').val(),
                            defaultPrice: $('#productDefaultPrice').val(),
                            productDetail: productDataEditor.getData(),
                            productBrand: $('#productBrand').val(),
                            productUnitType: $('#productUnitType').val(),
                            productCategory: $('#category').val(),
                            productSubcategory: $('#subcategory').val(),
                            sellableToggle: $('#sellableToggle').is(':checked') ? 'on' : 'off',
                            taxToggle: $('#taxToggle').is(':checked') ? 'on' : 'off',
                            isQtyInfinite: $('#isQtyInfinite').is(':checked') ? 'on' : 'off',
                            productCost: $('#productCost').val(),
                            adjustQuantity: $('#adjust-quantity').val(),
                            currentQuantity: $('#currentQuantity').val(),
                            supplierName: $('#supplier-name').val(),
                            contactNumber: $('#contact-no').val(),
                            supplierDetail: $('#supplierDetail').val()
                        };

                        $.ajax({
                            url: '{{ route('admin.product.save') }}',
                            type: 'POST',
                            data: {
                                productData,
                                _token: '{{ csrf_token() }}'
                            },

                            success: function(response) {
                                if (response.success) {
                                    toastr.success('Product saved successfully!');
                                    $('#productFormData').val(JSON.stringify(response
                                        .product));

                                    $('#saveProductBtnForm').prop('disabled', true).css(
                                        'cursor', 'not-allowed');
                                    $('#variantsSection').show();
                                } else {
                                    toastr.error(response.message ||
                                        'SKU should start from' + response.lastSKU);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error('Error saving product: ' + error);
                            }
                        });
                    });
            });
        });

        // End Save Product Section

        // Save Variant Section

        $(document).ready(function() {
            let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            let fileMappings = [];
            let variantImagePaths = [];
            let tempFilesArr = [];

            Dropzone.options.imageUpload = {
                maxFilesize: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif"
            };

            let variantDropzone = new Dropzone("#variantDropzone", {
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
                        let index = tempFilesArr.findIndex(tempFile => tempFile.name === file
                            .name);
                        if (index !== -1) {
                            tempFilesArr.splice(index, 1);
                        }
                    });
                }
            });

            $('#saveVariantBtn').on('click', function() {
                var errorMessages = [];

                if ($('#variantDropzone .dz-preview').length === 0) {
                    errorMessages.push("At least one image is required.");
                }

                var variantType = $('#variant-type').val();
                var newVariantType = $('#newVariantType').val();
                if (!variantType && !newVariantType) {
                    errorMessages.push("Variant type is required.");
                }

                var variantDefaultPrice = $('#variantDefaultPrice').val();
                if (!variantDefaultPrice) {
                    errorMessages.push("Default price is required.");
                }

                var variantDescription = variantDataEditor.getData();
                if (!variantDescription) {
                    errorMessages.push("Variant description is required.");
                }

                if (errorMessages.length > 0) {
                    var errorMessage = errorMessages.join("<br>");
                    toastr.error(errorMessage);
                    return;
                }

                let url = "{{ route('admin.variant.image.upload') }}";

                const formObj = new FormData();
                tempFilesArr.forEach((file) => {
                    formObj.append('files[]', file);
                });

                fetch(url, {
                        method: 'POST',
                        body: formObj,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then((resp) => resp.json())
                    .then((res) => {
                        var productDataId = JSON.parse($('#productFormData').val());
                        var variantData = {
                            productDataId: productDataId.id,
                            variantImages: res,
                            variantType: $('#variant-type').val(),
                            variantTitle: $('#variantTitle').val(),
                            variantSku: $('#variant_sku').val(),
                            variantSellingPrice: $('#variantSellingPrice').val(),
                            variantDefaultPrice: $('#variantDefaultPrice').val(),
                            isSellable: $('#isSellableCheckbox').prop('checked'),
                            variantDescription: variantDataEditor.getData(),
                            isVariantQtyInfinite: $('#isVariantQtyInfinite').is(':checked') ? 'on' :
                                'off',
                            variantCost: $('#variant-cost').val(),
                            currentVariantQuantity: $('#currentVariantQuantity').val(),
                        };

                        $.ajax({
                            url: '{{ route('admin.variant.save') }}',
                            type: 'POST',
                            data: {
                                variantData,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('#variantModal').modal('hide');
                                    toastr.success('Variants saved successfully!');
                                    clearVariantFormFields();
                                    fetchAndDisplayVariants(response.variant
                                        .product_id);
                                } else {
                                    toastr.error(response.message ||
                                        'SKU should start from' + response.lastSKU);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error('Error saving product: ' + error);
                            }
                        });

                    });
            });
        });

        // End Save Variant Section

        // Edit Variant Section

        var currentPaths = [];
        var editVariantDropzone;

        $(document).on('click', '.edit-variant', function() {
            $('#editVariantImages').empty();
            if (editVariantDropzone) {
                editVariantDropzone.removeAllFiles();
            }

            var row = $(this).closest('tr');
            var variantId = row.data('id');
            let editVariantImagePaths = [];

            $.ajax({
                url: '{{ route('admin.variant.edit') }}',
                type: 'GET',
                data: {
                    variantId: variantId
                },
                success: function(response) {
                    if (response.success) {
                        var variantData = response.variantData;
                        $('#editVariantId').val(variantData.id);
                        $('#edit-variant-type').val(variantData.type);
                        $('#editVariantTitle').val(variantData.title);
                        $('#edit_variant_sku').val(variantData.sku);
                        $('#editVariantSellingPrice').val(variantData
                            .minimum_selling_price);
                        $('#editVariantDefaultPrice').val(variantData.default_price);
                        $('#editIsSellableCheckbox').prop('checked', variantData
                            .is_sellable);
                        editVariantDataEditor.setData(variantData.description);
                        $('#isEditVariantQtyInfinite').prop('checked', variantData
                            .is_infinite);
                        $('#editVariantCost').val(variantData.cost);
                        $('#editAdjustVariantQty').prop('disabled', variantData
                            .is_infinite);
                        $('#editCurrentVariantQuantity').val(variantData.quantity);

                        $('#editVariantImages').empty();

                        var baseUrl = window.location.origin + '/' + 'storage' + '/';

                        variantData.medias.forEach(function(media) {
                            var imageUrl = baseUrl + media.path;
                            var containerHtml =
                                '<div class="col-4 mb-3 text-center" style="width: 100px; height: 100px;">' +
                                '<a href="' + imageUrl + '" target="_blank">' +
                                '<img src="' + imageUrl +
                                '" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">' +
                                '</a>' +
                                '<a href="#" class="remove-variant-image" data-id="' + media
                                .id + '" data-path="' + media.path +
                                '" style="font-size: 12px;">Remove</a></div>';
                            $('#editVariantImages').append(containerHtml);

                            var hiddenInput = $(
                                '<input type="hidden" name="variantDatabaseImages[]" value="' +
                                media.id + '">');
                            $('#variantDatabaseImages').append(hiddenInput);

                            hiddenInput.val(hiddenInput.val() + media.path + ',');
                        });

                        $('#editVariantModal').modal('show');

                    } else {
                        console.error('Error fetching variant data');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching variant data:', error);
                }
            });

            let csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            let fileMappings = [];
            let variantImagePaths = [];
            let tempFilesArr = [];

            Dropzone.options.imageUpload = {
                maxFilesize: 1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif"
            };

            editVariantDropzone = new Dropzone("#editVariantDropzone", {
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
                        let index = tempFilesArr.findIndex(tempFile => tempFile.name === file
                            .name);
                        if (index !== -1) {
                            tempFilesArr.splice(index, 1);
                        }
                    });
                }
            });

            $('#editVariantBtn').on('click', function() {
                var errorMessages = [];

                var variantType = $('#edit-variant-type').val();
                var newVariantType = $('#newVariantType').val();
                if (!variantType && !newVariantType) {
                    errorMessages.push("Variant type is required.");
                }

                var variantDefaultPrice = $('#editVariantDefaultPrice').val();
                if (!variantDefaultPrice) {
                    errorMessages.push("Default price is required.");
                }

                var variantDescription = editVariantDataEditor.getData();
                if (!variantDescription) {
                    errorMessages.push("Variant description is required.");
                }

                if (errorMessages.length > 0) {
                    var errorMessage = errorMessages.join("<br>");
                    toastr.error(errorMessage);
                    return;
                }

                let url = "{{ route('admin.variant.image.upload') }}";

                const formObj = new FormData();
                tempFilesArr.forEach((file) => {
                    formObj.append('files[]', file);
                });

                fetch(url, {
                        method: 'POST',
                        body: formObj,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then((resp) => resp.json())
                    .then((res) => {
                        var editedVariantTitle = $('#editVariantTitle').val();
                        var editedVariantImages = res;
                        var editedVariantid = $('#editVariantId').val();
                        var editedVariantType = $('#edit-variant-type').val();
                        var editedVariantSku = $('#edit_variant_sku').val();
                        var editedVariantSellingPrice = $('#editVariantSellingPrice').val();
                        var editedVariantDefaultPrice = $('#editVariantDefaultPrice').val();
                        var editedIsSellable = $('#editIsSellableCheckbox').prop('checked');
                        var editedVariantDetail = editVariantDataEditor.getData();
                        var editedVariantCost = $('#editVariantCost').val();
                        var isEditVariantQtyInfinite = $('#isEditVariantQtyInfinite').is(':checked') ?
                            'on' : 'off';
                        var editedCurrentVariantQuantity = $('#editCurrentVariantQuantity').val();
                        var variantData = {
                            id: editedVariantid,
                            title: editedVariantTitle,
                            editedVariantImages: editedVariantImages,
                            currentPaths: currentPaths ?? [],
                            type: editedVariantType,
                            sku: editedVariantSku,
                            selling_price: editedVariantSellingPrice,
                            default_price: editedVariantDefaultPrice,
                            is_sellable: editedIsSellable,
                            description: editedVariantDetail,
                            cost: editedVariantCost,
                            isEditVariantQtyInfinite: isEditVariantQtyInfinite,
                            quantity: editedCurrentVariantQuantity
                        };

                        $.ajax({
                            url: '{{ route('admin.variant.update') }}',
                            type: 'POST',
                            data: {
                                variantData: variantData,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success('Variant updated successfully!');
                                    $('#editVariantModal').modal('hide');
                                    fetchAndDisplayVariants(response.variant.product_id);
                                } else {
                                    toastr.error(response.message ||
                                        'SKU should start from' + response.lastSKU);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error updating variant:', error);
                            }
                        });
                    });
            });
        });


        $(document).on('click', '.remove-variant-image', function(e) {
            e.preventDefault();
            var imagePathToRemove = $(this).data('path');
            $(this).parent().remove();

            currentPaths.push(imagePathToRemove);

            var hiddenInput = $('#variantDatabaseImages');
            var currentPathsString = hiddenInput.val();
            currentPathsString = currentPathsString.replace(imagePathToRemove + ',', '');
            hiddenInput.val(currentPathsString);

            console.log('Image path to remove:', imagePathToRemove);
            console.log('Current paths:', currentPaths);
        });

        // End Edit Variant Section

        function fetchAndDisplayVariants(productId) {
            $.ajax({
                url: '{{ route('admin.variant.product_variants') }}',
                type: 'GET',
                data: {
                    productId: productId
                },
                success: function(response) {
                    displayVariants(response);
                },
                error: function(error) {
                    console.error('Error fetching variant types:', error);
                }
            });
        }

        function displayVariants(variants) {
            let tableBody = $('#variantsTable tbody');
            tableBody.empty();

            variants.forEach((variant, index) => {
                let sellableStatus = variant.is_sellable === 0 ? 'No' : 'Yes';
                let row = `
            <tr data-id="${variant.id}">
                <td>${index + 1 || ''}</td>
                <td>${variant.title || ''}</td>
                <td>${variant.type || 'N/A'}</td>
                <td>${variant.sku || ''}</td>
                <td>${variant.quantity || 0}</td>
                <td>${variant.default_price || 0}</td>
                <td>${variant.minimum_selling_price || 0}</td>
                <td>${sellableStatus || 'N/A'}</td>
                <td class="actions">
                    <button class="btn btn-sm btn-info edit-variant">{{ trans('global.edit') }}</button>
                    <button class="btn btn-sm btn-danger delete-variant ml-2">{{ trans('global.delete') }}</button>
                </td>
            </tr>
        `;
                tableBody.append(row);
            });

        }

        $(document).on('click', '.delete-variant', function() {
            var row = $(this).closest('tr');
            var variantId = row.data('id');

            $.ajax({
                url: '{{ route('admin.variant.delete') }}',
                type: 'DELETE',
                data: {
                    variantId: variantId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        row.remove();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error deleting variant:', error);
                }
            });
        });

        function clearVariantFormFields() {

            $('#variantTitle').val('');
            $('#variant-type').val('');
            $('#variant_sku').val('');
            $('#adjust-variant-quantity').val('');
            $('#variantSellingPrice').val('');
            $('#variantDefaultPrice').val('');
            variantDataEditor.setData('');
            $('#variant-cost').val('');
            $('#currentVariantQuantity').val('');
            $('#isSellableCheckbox').prop('checked', true);

            var variantDropzone = Dropzone.forElement("#variantDropzone");
            if (variantDropzone !== null) {
                variantDropzone.removeAllFiles();
            }
        }

        try {
            ClassicEditor.defaultConfig = {
                toolbar: {
                    items: [
                        'heading',
                        '|',
                        'bold',
                        'italic',
                        '|',
                        'bulletedList',
                        'numberedList',
                        '|',
                        'insertTable',
                        '|',
                        'undo',
                        'redo'
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                language: 'en'
            };

            var productDataEditor;
            var variantDataEditor;
            var editVariantDataEditor;

            ClassicEditor
                .create(document.querySelector('#productDetail'))
                .then(editor => {
                    productDataEditor = editor;
                })
                .catch(err => {
                    console.error(err.stack);
                });

            ClassicEditor
                .create(document.querySelector('#variantDetail'))
                .then(editor => {
                    variantDataEditor = editor;
                })
                .catch(err => {
                    console.error(err.stack);
                });

            ClassicEditor
                .create(document.querySelector('#editVariantDetail'))
                .then(editor => {
                    editVariantDataEditor = editor;
                })
                .catch(err => {
                    console.error(err.stack);
                });

        } catch (error) {
            console.error("Error creating CKEditor:", error);
        }

        $(document).ready(function() {
            $(".btn-add-variant").click(function() {
                var clone = $(".variant-details").first().clone();
                clone.find("input[type='text'], input[type='number'], input[type='file']")
                    .val(
                        '');
                clone.toggle();

                var saveButton = $(
                    '<button type="button" class="btn btn-success btn-sm btn-save-variant">Save</button>'
                );
                var removeButton = $(
                    '<button type="button" class="btn btn-danger btn-sm btn-remove-variant ml-2">Close</button>'
                );

                saveButton.click(function() {
                    alert("Variant saved!");
                });

                removeButton.click(function() {
                    $(this).parent().parent().remove();
                });

                var buttonGroup = $('<div class="d-flex justify-content-end mt-2"></div>');
                buttonGroup.append(saveButton).append(removeButton);

                clone.append(buttonGroup);

                $(".variants-container").append(clone);
            });

            $(document).on("click", ".btn-remove-variant", function() {
                $(this).parent().parent().remove();
            });
        });

        Dropzone.autoDiscover = false;
    </script>
@endsection