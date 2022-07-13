$(document).ready(function () {
    //Reset input file
    $('input[type="file"][name="evidence_image"]').val('');
    //Image preview
    $('input[type="file"][name="evidence_image"]').on('change', function () {
        var img_path = $(this)[0].value;
        var img_holder = $('.img-holder');
        var extension = img_path.substring(img_path.lastIndexOf('.') + 1).toLowerCase();
        if (extension == 'jpeg' || extension == 'jpg' || extension == 'png' || extension == 'gif') {
            if (typeof (FileReader) != 'undefined') {
                img_holder.empty();
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('<img/>', {
                        'src': e.target.result,
                        'class': 'img-fluid',
                        'style': 'width:250;margin-bottom:10px;height:100;border: 1px solid #686262;'
                    }).appendTo(img_holder);
                }
                img_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
                $('.old_image').empty();
            } else {
                $(img_holder).html('This browser does not support FileReader');
            }
        } else {
            $(img_holder).empty();
        }
    })

    //add-timesheet date
    $('#dateAddTimesheet').datepicker({
        format: 'yyyy-mm-dd',
        orientation: "bottom left"
    });

    $('#datepicker,#datepicker-end').datepicker({
        format: 'yyyy-mm-dd',
        orientation: "bottom left"
    });

    //check all
    $('#checkboxAll').change(function () {
        var ischeck = $(this).prop('checked');
        $(".checkboxItem").prop('checked', ischeck);
        if ($(this).is(":checked")) {
            $('.btn-complete').attr('disabled', false);
            $('.btn-delete').attr('disabled', false);
        } else {
            $('.btn-complete').attr('disabled', true);
            $('.btn-delete').attr('disabled', true);
        }
    });

    //check each item
    $('.checkboxItem').change(function () {
        let isExistCheck = false;
        $('.checkboxItem').each(function () {
            if ($(this).is(":checked")) {
                isExistCheck = true;
            }
        })
        if (isExistCheck) {
            $('.btn-complete').attr('disabled', false);
            $('.btn-delete').attr('disabled', false);
        } else {
            $('.btn-complete').attr('disabled', true);
            $('.btn-delete').attr('disabled', true);
        }
        if ($(this).prop('checked') == false) {
            $('#checkboxAll').prop('checked', false);
        }
        if ($('.checkboxItem:checked').length == $('.checkboxItem').length) {
            $('#checkboxAll').prop('checked', true);
        }
    });

    //
    $('.datepicker-end').datepicker({
        format: 'yyyy-mm-dd'
    });
    var i = 1;
    let selectLocation = $('#selectLocation').html();
    let selectUser = $('.selectUser').html();
    $('body').on('click', '#add_input', function () {
        i++;
        $('#dynamic_input').append(
            '<tr id="row' + i + '">' +
            ' <td> ' +
            '<div class="row pb-4"> ' +
                '<div class="col-sm-2"> ' +
                    '<div class="header-search__text-date "> ' +
                    '<select class="form-control text-sm selectUser"  name="userID[]" id="selectUser'+i+'"> '
                        + selectUser +
                    '</select> ' +
                    '</div> ' +
                '</div>' +
                '<div class="col-sm-2"> ' +
                    '<div class="header-search__text-date "> ' +
                    '<select class="form-control text-sm" name="locationID[]"> '
                        + selectLocation +
                    '</select>' +
                    '</div> ' +
                '</div> ' +
                '<div class="col-sm-2"> <' +
                    'div class="header-search__date"> ' +
                    '<section> ' +
                    '<div class="input-group date datepicker-start" > ' +
                    '<input class="form-control" name="startDateUser[]" readonly style="background-color: #fff"> ' +
                    '<span class="input-group-append"> <span class="input-group-text bg-white"> <i class="fa fa-calendar"></i> </span> </span> ' +
                    '</div>' +
                    ' </section>' +
                '</div> ' +
                '</div> ' +
                '<div class="col-sm-2"> ' +
                    '<div class="header-search__text-date"> ' +
                    '<section> ' +
                    '<div class="input-group date datepicker-end" id="datepicker-end' + i + '"> ' +
                    '<input class="form-control" name="endDateUser[]" readonly style="background-color: #fff"> ' +
                    '<span class="input-group-append"> <span class="input-group-text bg-white"> <i class="fa fa-calendar"></i> </span> </span> ' +
                    '</div> </section>' +
                '</div> ' + '</div> ' +
                '<div class="col-sm-1"> ' +
                    '<div class="header-search__text-date "> ' +
                    '<input class="form-control" name="effort[]"> </div> </div>' +
                    '<div class="col-sm-1 flex items-end"> ' +
                    '<div class="mt-[3px]"> <button type="button" class="text-xs btn btn-outline-danger mt-0.5 input_remove" name="js-remove-input" id="' + i + '">X</button> ' +
                        '<input type="hidden" value="" name="userHasIDOld[]">' +
                    '</div>' +
                    ' </div> ' +
                '</div>' +
            ' </td> ' +
            '</tr>')
        $('.datepicker-end,.datepicker-start').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.selectUser').select2({
            theme: "bootstrap"
        });
    });
    $('.selectUser').select2({
        theme: "bootstrap"
    });
    $(document).on('click', '.input_remove', function (e) {
        e.preventDefault();
        $(this).parents( "tr" ).remove();
        var values = $("input[name='userHasIDOld[]']").map(function(){return $(this).val();}).get();
        console.log(values)
    });


})
