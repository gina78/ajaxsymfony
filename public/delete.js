$(document).ready(function () {
    $('.deleteProduct').click(function () {
        var id = $(this).data('id');

        $.ajax({
            url: "/cart/deleteBasket/" + id,
            type: "GET",
            cache: false,
            success: function (response) {
                console.log(id)
                $(".message").html(response)
                $("#getCodeModal").modal('show')
               // $("#basket").load(location.href + " #basket")
            }
        });
    });
});
