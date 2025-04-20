$(function (){


    $('a#filter-button').click(function(){
        const form = $('form.sidebar-filter').serialize();
        $.ajax({
            method: "GET",
            url: "/",
            data: form
        })
            .done(function (response){
                $('div#products-wrapper').empty();
                $.each(response.data, function (index, product){
                   const html = '<div class="col-6 col-md-6 col-lg-4 mb-3">\n' +
                       '                                <div class="card h-100 border-0">\n' +
                       '                                    <div class="card-img-top">\n' +
                       '                                            <img src="' + getImage(product) + '" class="img-fluid mx-auto d-block" alt="Zdjęcie produktu">\n' +
                       '                                     </div>' +
                       '                                    <div class="card-body text-center">\n' +
                       '                                        <h4 class="card-title">\n' +
                        product.name                                        +
                       '                                        </h4>\n' +
                       '                                        <h5 class="card-price small">\n' +
                       '                                            <i>PLN ' + product.price + ' </i>\n' +
                       '                                        </h5>\n' +
                       '                                    </div>\n' +
                       '                                </div>\n' +
                       '                            </div>';
                    $('div#products-wrapper').append(html);
                });
            })
            .fail(function (data){
                alert("ERROR");
            });
    });

    function getImage(product) {
        if (!!product.image_path) {
            return storagePath + product.image_path;
        }
        return defaultImage;
    }
});
