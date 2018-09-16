/**
 * Created by Asus- on 16.01.2015.
 */
$(document).ready(function () {
    $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        altField: "#alternate",
        altFormat: "d.mm.yy"
    });

    $('.getlenta').click(function () {
        var datastr = $(this).attr('atr');
        $.ajax({
            type: "POST",
            url: "include/mainpage.php",
            data: datastr,
            success: function (msg) {
                $('.mlentanews').html(msg);
            }

        })
    })
});