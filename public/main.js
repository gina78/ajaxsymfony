$(document).ready(function () {
    $('.addToCart').click(function () {
        var id = $(this).data('id');
            $.ajax({
               url: "/cart/add/" + id,
                type: "GET",
                cache: false,
                success: function (response) {
                    console.log(id)
                     $(".message").html(response)
                    $("#getCodeModal").modal('show')
                },
                error: function(response){
                    $(".message").html(response)
                },
            });
    });
});
