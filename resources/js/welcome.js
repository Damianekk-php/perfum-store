$(function (){

    $('a#filter-button').click(function(){
        const form = $('form.sidebar-filter').serialize();
        $.ajax({
            method: "GET",
            url: "/",
            data: form
        })
            .done(function (data){
                alert("SUCCESS");
            })
            .fail(function (data){
                alert("ERROR");
            });
    });
});
