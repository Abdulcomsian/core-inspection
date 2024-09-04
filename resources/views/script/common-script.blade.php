<script>
    function updateInformation(url, form, type, position = null, html = null, modal = null, cb = null) {
        form.append("_token", '{{ csrf_token() }}');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    switch (type) {
                        case 1:
                            toastr.success(res.msg);
                            if (cb) {
                                cb();
                            }
                            break;
                        case 2:
                            if (position) {
                                html.insertAdjacentHTML(position, res.html);
                            } else {
                                let newHtml = res.html;
                                html.innerHTML = res.html;
                            }
                            // location.reload();
                            break;
                        case 3:
                            break;
                    }
                } else {
                    if (res.errors && res.errors.length > 0) {
                        res.errors.forEach(function(error) {
                            toastr.error(error);
                        });
                    } else {
                        toastr.error(res.msg);
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                toastr.error('An error occurred. Please try again later.');
            }
        });
    }

    function updateQualificationInformation(url, form, type, position = null, html = null, modal = null, cb = null) {
        form.append("_token", '{{ csrf_token() }}');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    switch (type) {
                        case 1:
                            toastr.success(res.msg);
                            if (cb) {
                                cb();
                            }
                            break;
                        case 2:
                            if (position) {
                                html.insertAdjacentHTML(position, res.html);
                            } else {
                                let newHtml = res.html;
                                html.innerHTML = res.html;
                            }
                            break;
                        case 3:
                            location.reload();
                            break;
                    }
                }
            }
        })
    }

    function deleteQualificationInformation(url, form, type, position = null, html = null, modal = null, cb = null) {
        form.append("_token", '{{ csrf_token() }}');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    switch (type) {
                        case 1:
                            toastr.success(res.msg);
                            if (cb) {
                                cb();
                            }
                            break;
                        case 2:
                            if (position) {
                                html.insertAdjacentHTML(position, res.html);
                            } else {
                                let newHtml = res.html;
                                html.innerHTML = res.html;
                            }
                            break;
                        case 3:
                            location.reload();
                            break;
                    }
                }
            }
        })
    }

    function updateBiography(url, form, type, position = null, html = null, modal = null, cb = null) {
        form.append("_token", '{{ csrf_token() }}');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    switch (type) {
                        case 1:
                            toastr.success(res.msg);
                            if (cb) {
                                cb();
                            }
                            break;
                        case 2:
                            if (position) {
                                html.insertAdjacentHTML(position, res.html);
                            } else {
                                let newHtml = res.html;
                                html.innerHTML = res.html;
                            }
                            break;
                        case 3:
                            break;
                    }
                    location.reload();
                }
            }
        })
    }

    function updateServiceType(url, form, type, position = null, html = null, modal = null, cb = null) {
        form.append("_token", '{{ csrf_token() }}');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    switch (type) {
                        case 1:
                            toastr.success(res.msg);
                            if (cb) {
                                cb();
                            }
                            break;
                        case 2:
                            if (position) {
                                html.insertAdjacentHTML(position, res.html);
                            } else {
                                let newHtml = res.html;
                                html.innerHTML = res.html;
                            }
                            break;
                        case 3:
                            break;
                    }
                    location.reload();
                }
            }
        })
    }

    function updateCompanyContact(url, form, type, position = null, html = null, modal = null, cb = null) {
        form.append("_token", '{{ csrf_token() }}');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    switch (type) {
                        case 1:
                            toastr.success(res.msg);
                            if (cb) {
                                cb();
                            }
                            break;
                        case 2:
                            if (position) {
                                html.insertAdjacentHTML(position, res.html);
                            } else {
                                let newHtml = res.html;
                                html.innerHTML = res.html;
                            }
                            break;
                        case 3:
                            break;
                    }
                    location.reload();
                }
            }
        })
    }

    function updateAppointmentSchedule(url, form, type, position = null, html = null, modal = null, cb = null) {
        form.append("_token", '{{ csrf_token() }}');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    switch (type) {
                        case 1:
                            toastr.success(res.msg);
                            if (cb) {
                                cb();
                            }
                            break;
                        case 2:
                            if (position) {
                                html.insertAdjacentHTML(position, res.html);
                            } else {
                                let newHtml = res.html;
                                html.innerHTML = res.html;
                            }
                            break;
                        case 3:
                            break;
                    }
                    location.reload();
                }
            }
        })
    }

    function updateCompanyLocation(url, form, type, position = null, html = null, modal = null, cb = null) {
        form.append("_token", '{{ csrf_token() }}');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    switch (type) {
                        case 1:
                            toastr.success(res.msg);
                            if (cb) {
                                cb();
                            }
                            break;
                        case 2:
                            if (position) {
                                html.insertAdjacentHTML(position, res.html);
                            } else {
                                let newHtml = res.html;
                                html.innerHTML = res.html;
                            }
                            break;
                        case 3:
                            break;
                    }
                    location.reload();
                }
            }
        })
    }

    function updateInfoForm(url, form, type, position = null, html = null, modal = null, cb = null) {
        form.append("_token", '{{ csrf_token() }}');
        $.ajax({
            type: 'POST',
            url: url,
            data: form,
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    switch (type) {
                        case 1:
                            toastr.success(res.msg);
                            if (cb) {
                                cb();
                            }
                            break;
                        case 2:
                            if (position) {
                                html.insertAdjacentHTML(position, res.html);
                            } else {
                                let newHtml = res.html;
                                html.innerHTML = res.html;
                            }
                            break;
                        case 3:
                            break;
                    }
                    location.reload();
                }
            }
        })
    }
</script>
