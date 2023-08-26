/*form control validator*/


$(function () {

    $('#importForm').validate({
        rules: {
            importFile: {
                required: true,
                extension: "xlsx|xsl|csv"
            },
        },
        messages: {
            importFile: {
                required: "Please enter a email address",
                extension: "Please enter a valid email address"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });

    $.validator.addMethod( "accept", function( value, element, param ) {

        if (typeof param === "string" && !/.+\/.+/.test(param)) {
            //Parameter does not have a single MIME.
            //This rule might have been included by an accept tag that contains extensions instead.
            return true;
        }

        // Split mime on commas in case we have multiple types we can accept
        var typeParam = typeof param === "string" ? param.replace( /\s/g, "" ) : "image/*",
            optionalValue = this.optional( element ),
            i, file, regex;

        // Element is optional
        if ( optionalValue ) {
            return optionalValue;
        }

        if ( $( element ).attr( "type" ) === "file" ) {

            // Escape string to be used in the regex
            // see: https://stackoverflow.com/questions/3446170/escape-string-for-use-in-javascript-regex
            // Escape also "/*" as "/.*" as a wildcard
            typeParam = typeParam
                .replace( /[\-\[\]\/\{\}\(\)\+\?\.\\\^\$\|]/g, "\\$&" )
                .replace( /,/g, "|" )
                .replace( /\/\*/g, "/.*" );

            // Check if the element has a FileList before checking each file
            if ( element.files && element.files.length ) {
                regex = new RegExp( ".?(" + typeParam + ")$", "i" );
                for ( i = 0; i < element.files.length; i++ ) {
                    file = element.files[ i ];

                    // Grab the mimetype from the loaded file, verify it matches
                    if ( !file.type.match( regex ) ) {
                        return false;
                    }
                }
            }
        }

        // Either return true because we've validated each file, or because the
        // browser does not support element.files and the FileList feature
        return true;
    }, $.validator.format( "Please enter a value with a valid mimetype." ) );
});

/*run sweetalert*/
$(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
})
$('.remove-category').on('click', function () {
    let id=$(this).data('id')
        element=$(this).closest('li');
    console.log(element);
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $.ajax({
        url: 'category/delete/'+id,
        method: 'delete',
        data:{'category': id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (res) {
            if (res.status){
                console.log('success');
               /* Toast.fire({
                    icon: 'success',
                    title: 'Успіх! Категорія '+res.title+' видалена.'
                });*/
                toastr.success('Успіх! Категорія "'+res.title+'" видалена.');
                element.remove();
            }else{
                console.log('error');
                /*Toast.fire({
                    icon: 'error',
                    title: 'Помилка! Категорія '+res.title+' має підкатегоріЇ.'
                });*/
                toastr.error('Помилка! Категорія "'+res.title+'" має підкатегоріЇ.');
            }
        }
    });
})

/*show preview product*/

function showProduct(id) {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $.ajax({
        url: 'product/show/'+id,
        method: 'get',
        dataType:'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (res) {
            console.log(res);
            var test = '<p>hello</p>';
            Swal.fire({
                position: 'top',
                width: '100%',
                showCloseButton: true,
                showConfirmButton: false,
                focusClose: false,
                returnFocus: false,
                html: res.view,
            })
        }
    });
}

/*delete product*/
function deleteProduct(id) {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    element=$(this).closest('td');
    $.ajax({
        url: 'product/delete/'+id,
        data:{'product': id},
        method: 'delete',
        dataType:'json',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (res) {
            if(res.status){
                toastr.success('Успіх! Продукт "'+res.title+'" видалений.');
                $('#products-table').DataTable().ajax.reload();
            }else{
                toastr.error('Помилка! Продукт не видалений.');
            }

        }
    });
}

//bootstrap switch
var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch({
        onSwitchChange: function (e, state) {
            let id = $(this).data('id');
            $.ajax({
                url: "/admin/main-slider/update-status/"+id,
                type: 'post',
                data: {slide: id, status: state},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success(res){
                    toastr.info(res);
                }
            })
        }
    }, $(this).prop('checked'));
})

//destroy slide
$('.slide-destroy').on('click', function (event) {
    let id = $(this).data('id');
    let el = $(this).parents('tr');

    $.ajax({
        url: "/admin/main-slider/destroy/"+id,
        type: 'post',
        data: {slide: id},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success(res){
            toastr.error(res);
            el.remove();
            console.log();
        }
    })
})


