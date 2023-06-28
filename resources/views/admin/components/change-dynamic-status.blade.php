<script type="text/javascript"> 
    function {{ $title_function }} (id){ 
        var element = $("#"+id+"{{ $element_name }}");
        var url = element.attr('data-url');
        var elementValue = !element.prop('checked');

        $.ajax({
            url : url,
            type : "GET",
            success : function(response){
                if(response.{{ $element_name }}){
                    if(response.checked){
                        element.prop('checked', true);
                        successToast("{{ $error_msg }}"+' با موفقیت فعال شد')
                        var warningStatus = $(".{{ $element_name }}"+id).addClass('d-none');
                    }
                    else{
                        element.prop('checked', false);
                        successToast("{{ $error_msg }}"+' با موفقیت غیر فعال شد')
                        var warningStatus = $(".{{ $element_name }}"+id).removeClass('d-none'); 
                    }
                }
                else{
                    element.prop('checked', elementValue);
                    errorToast('هنگام ویرایش مشکلی بوجود امده است')
                }
            },
            error : function(){
                element.prop('checked', elementValue);
                errorToast('ارتباط برقرار نشد')
            }
        }); 
        
    }

            function successToast(message){

            var successToastTag = '<section class="toast" data-delay="5000">\n' +
            '<section class="toast-body py-3 d-flex bg-success text-white">\n' +
            '<strong class="ml-auto">' + message + '</strong>\n' +
            '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
            '<span aria-hidden="true">&times;</span>\n' +
            '</button>\n' +
            '</section>\n' +
            '</section>';

            $('.toast-wrapper').append(successToastTag);
            $('.toast').toast('show').delay(5500).queue(function() {
                $(this).remove();
            })
}

            function errorToast(message){

            var errorToastTag = '<section class="toast" data-delay="5000">\n' +
            '<section class="toast-body py-3 d-flex bg-danger text-white">\n' +
            '<strong class="ml-auto">' + message + '</strong>\n' +
            '<button type="button" class="mr-2 close" data-dismiss="toast" aria-label="Close">\n' +
            '<span aria-hidden="true">&times;</span>\n' +
            '</button>\n' +
            '</section>\n' +
            '</section>';

            $('.toast-wrapper').append(errorToastTag);
            $('.toast').toast('show').delay(5500).queue(function() {
                $(this).remove();
            })
}
</script>