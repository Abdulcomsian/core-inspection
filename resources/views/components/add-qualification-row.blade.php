<div class="row qualification-row my-3">
    <div class="col-3">
        <div class="form-group">
            <label>Degree/Certificate <span class="text-danger">*</span></label>
            <input type="input" class="form-control" name="degree" aria-describedby="emailHelp"
                placeholder="Enter degree">
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label>From Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control " name="from_date" aria-describedby="emailHelp"
                placeholder="From Date">
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label>To Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control " width="40" name="to_date" aria-describedby="emailHelp"
                placeholder="To Date">
        </div>
    </div>
    <div class="col-4">
        <div class="form-group certificate-image-section d-flex flex-column position-relative">
            <label>Add Certificate Image <span class="text-danger">*</span></label>
            <div class="d-flex">
                <input type="file" class="form-control w-75" name="qualification_certificate"
                    aria-describedby="emailHelp">
                <img src="" alt="" width="50" height="50" class="qualification-image d-none"
                    style="
                margin-right: -66px;
                margin-bottom: -5px;
                width: 70px;
                height: 50px;
            " />
            </div>
        </div>
    </div>
    <div class="col-1">
        <div class="form-group">
            <i class="fa fa-trash fa-xl text-danger mt-5 delete-row" aria-hidden="true"></i>
        </div>
    </div>
</div>
