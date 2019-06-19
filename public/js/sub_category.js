$(document).ready(function () {
   $("#subcategory_field").hide();
    $('#parentcategory').on('change', e => {
    var category = $('#parentcategory').val();
    if(category == '-1')
    {
        $("#subcategory_field").hide();        
    }
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="new-csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'get_sub_category',
        data: {category: category},
        dataType: 'json',
        success: function (response) 
        {
            var len = response.length;
            for (var i = 0; i < len; i++) 
            {
                $("#subcategory").empty();

                var id = response[i]['id'];
                var sub_category = response[i]['category'];
                $("#subcategory_field").show();
                $("#subcategory").append('<option class="active" value=' + id + '>' + sub_category +'</option>');
            }
        }
    });
});
});


