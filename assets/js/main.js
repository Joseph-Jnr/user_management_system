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

$(document).ready(function () {
    $("#myInput1").on("keyup", function () {
        var value = $(this)
            .val()
            .toLowerCase();
        $("#myTable1 tr").filter(function () {
            $(this).toggle(
                $(this)
                .text()
                .toLowerCase()
                .indexOf(value) > -1
            );
        });
    });
});