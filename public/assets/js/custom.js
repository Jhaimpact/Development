$(document).ready(function(){
   
    console.log(base_url);

    $('body').on('click', '.delete_detail_container', function() {
        $(this).parents('.detail_container').remove();
    });


    $('body').on('click', '.delete_meta_row', function() {
        $(this).parents('.meta_row').remove();
    });

    $('body').on('click', '.add_row', function() {

        let meta_row = $(this).parents('.detail_container').first().find('.meta_row').first().clone(true);

        $(meta_row).find('input , select').val('');

        let total_count_container = $('.detail_container').first().find('.meta_row').length;

        $(meta_row).find('input,select').map(function(index, element) {

            let name_attribute = $(element).attr('name');

            let last_index = name_attribute.lastIndexOf('0');

            name_attribute = name_attribute.substring(0, last_index) + total_count_container + name_attribute.substring(last_index + 1)

            $(element).attr('name', name_attribute);
        });

        meta_row.append(` <div class="col-md-1 col-sm-12 form-group mt-2"><i class="fas fa-trash delete_meta_row"></i></div>`);

        $(this).parents('.card-body').find('.meta_row_container').append(meta_row);

    });

    $('.add_meta_btn').click(function() {

        let detail_container = $('.detail_container').first().clone(true);

        detail_container.find('.button_box').append(`<i class="fas fa-trash btn-circle btn-sm btn-info delete_detail_container"></i>`);

        let total_count_container = $('.detail_container').length;

        $(detail_container).find('input,select').map(function(index, element) {

            let name_attribute = $(element).attr('name');

            name_attribute = name_attribute.replace('0', total_count_container);

            $(element).attr('name', name_attribute);
        });

        $('#form_container').append(detail_container);

    });

    $(".delete-item").click(function() {
        let name = $(this).attr('c-name');
        let id = $(this).attr('c-index');
        let context = $(this);
        !swal({
            title: "Are you sure?",
            text: `${name} will be deleted permanently`,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then(function(agree) {
            if (agree) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'Accept' : 'Application/json'
                    },
                    url: window.location.href + '/' + id,
                    method: "DELETE",
                    success: function(result) {
                        let parsed = JSON.parse(result);
                        if (parsed.code) {
                            showMessage('Your entry has been deleted successfully');
                            $(context).parents('tr').remove();

                        } else {
                            showMessage('Some error occured');
                        }
                    }
                })
            }
        })
    })

    $(".product-parent-category").change(function(){
        let context  = $(this);
        $.ajax({
            url : `${base_url}get-child-category/${$(context).val()}`,
            success:function(result){
                let child_category_str = '';
                if(result.status){
                    result.result.forEach(function (data , key ) {
                        child_category_str += `<option value = "${data.id}">${data.category_name}</option>`;
                    })
                }
                
                $('.category_id').html(child_category_str);
            }
        });
    })

    $('.parent-size-class').change(function(){
        let context = $(this);
        $.ajax({
            url:`${base_url}get-child-size-attribute/${$(context).val()}`,
            success:function(result){
                result.forEach(function(data , index){
                    `<div class="row justify-content-center " >
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Choose Color">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Color Description">
                    </div>
                    <div class="col-3">
                        <i class="btn-circle btn-sm btn-danger fa fa-trash delete-size-attribute-box"></i>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-3">
                        <input type="text" readonly value ="XL" class="form-control">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Quntity">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Description If Any">
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-3">
                        <input type="text" readonly value ="XL" class="form-control">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Quntity">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Description If Any">
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-3">
                        <input type="text" readonly value ="XL" class="form-control">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Quntity">
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" placeholder="Description If Any">
                    </div>
                </div>`
                })
            }
        })
    })

})



function showMessage(message) {
    $('#notification').show();
    $('#notification').text(message);
    setTimeout(() => {
        $('#notification').hide();
    }, 3000);
}