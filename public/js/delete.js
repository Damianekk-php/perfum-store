
$(function() {
    $('.delete').click(function() {
        Swal.fire({
            title: 'Czy na pewno chcesz usunąć rekord?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "DELETE",
                    url: deleteUrl + $(this).data("id")
                })
                    .done(function (response) {
                        window.location.reload();
                    })
                    .fail(function (response) {
                        Swal.fire('Oops...', data.responseJSON.message, );
                    });
            }
        })
    });
});
