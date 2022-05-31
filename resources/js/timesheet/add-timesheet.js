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
        format: 'yyyy-mm-dd'
    });

    //check all
    $('#checkboxAll').change(function () {
        var ischeck = $(this).prop('checked');
        $(".checkboxItem").prop('checked', ischeck);
    });

    //check each item
    $('.checkboxItem').change(function () {
        let isExistCheck = false;
        $('.checkboxItem').each(function () {
            if ($(this).is(":checked")) {
                isExistCheck = true;
            }
        })
        if ($(this).prop('checked') == false) {
            $('#checkboxAll').prop('checked', false);
        }
        if ($('.checkboxItem:checked').length == $('.checkboxItem').length) {
            $('#checkboxAll').prop('checked', true);
        }
    });


})
