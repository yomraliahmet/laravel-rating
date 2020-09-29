$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-clear").on("click", function(e){
        e.preventDefault();

        var el = $(this);
        var postData = {
            "rate" : 0
        };

        $.ajax({
            method: "POST",
            url: "/rate/" + el.data("user"),
            data: postData,
            success: function(data){
                el.parent().prev().find("input").prop("checked", false);
                $(".totalRate-"+el.data("user")).text(data.total);
                Swal.fire({
                    width: 400,
                    position: 'top-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
            }
        }).fail(function(jqXHR) {
            Swal.fire({
                width: 400,
                position: 'top-end',
                icon: 'error',
                title: jqXHR.responseJSON.message,
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        });
    });

    $('input[type=radio]').on("click", function(e){

        var el = $(this);
        el.attr( "checked", "true" );
        var url = "/rate/"+el.data("user");
        var rate = el.data("rate");
        var postData = {
            "rate" : rate
        };

        var post = $.post(url,postData);
        post.done(function(xhr){
            el.attr("disabled","disabled");
            $(".totalRate-"+el.data("user")).text(xhr.total);
            Swal.fire({
                width: 400,
                position: 'top-end',
                icon: 'success',
                title: xhr.message,
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        });

        post.fail(function(jqXHR){
            Swal.fire({
                width: 400,
                position: 'top-end',
                icon: 'error',
                title: jqXHR.responseJSON.message,
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        });

        setTimeout(function(){
            el.removeAttr("disabled");
        },3000);
    });
});
