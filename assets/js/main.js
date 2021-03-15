/* Preloader */
$(window).on("load", function () {
    $("#confirmation")
        .delay(2550)
        .fadeOut("slow");
});



$(document).ready(function () {
    $("#myInput").on("keyup", function () {
        var value = $(this)
            .val()
            .toLowerCase();
        $("#myTable tr").filter(function () {
            $(this).toggle(
                $(this)
                .text()
                .toLowerCase()
                .indexOf(value) > -1
            );
        });
    });
});