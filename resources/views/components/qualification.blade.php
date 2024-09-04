@foreach ($qualifications as $index => $qualification)
    <div class="row qualification-row my-2" data-qualification-id="{{ $qualification->id }}">
        <div class="col-3">
            <div class="form-group">
                <label>Degree/Certificate <span class="text-danger">*</span></label>
                <input type="input" class="form-control" name="degree" value="{{ $qualification->degree }}"
                    placeholder="Enter degree">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>From Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="from_date" value="{{ $qualification->from }}"
                    placeholder="Enter from date">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
                <label>To Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="to_date" value="{{ $qualification->to }}"
                    placeholder="Enter to date">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group certificate-image-section d-flex flex-column position-relative">
                <label>Add Certificate Image <span class="text-danger">*</span></label>
                <div class="d-flex">
                    <input type="file" class="form-control w-75" name="qualification_certificate"
                        aria-describedby="emailHelp">
                    @if ($qualification->image)
                        @if (pathinfo($qualification->image, PATHINFO_EXTENSION) === 'pdf')
                            <a href="{{ asset('uploads/' . $qualification->image) }}" target="_blank"
                                class="qualification-pdf link-primary" style="display: block; margin-top: 5px;">
                                View PDF
                            </a>
                        @else
                            <img src="{{ asset('uploads/' . $qualification->image) }}" alt="" width="50"
                                height="50" class="qualification-image"
                                style="margin-right: -66px; margin-bottom: -5px; width: 70px; height: 50px;" />
                        @endif
                    @else
                        <img src="" alt="" width="50" height="50"
                            class="qualification-image d-none"
                            style="margin-right: -66px; margin-bottom: -5px; width: 70px; height: 50px;" />
                    @endif
                </div>
            </div>
        </div>
        <div class="col-1">
            <div class="form-group">
                @if ($index != 0)
                    <i class="fa fa-trash fa-xl text-danger mt-5 delete-row" aria-hidden="true"></i>
                @endif
            </div>
        </div>
    </div>
@endforeach
