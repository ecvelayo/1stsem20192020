

$('#userName').autocomplete({
    source: users,
    
    select: function ( event, ui ) {
        event.preventDefault();
        $("input#userName").val(ui.item.label);
        $("input#userID").val(ui.item.value);
    },
    focus: function(event, ui) {
        event.preventDefault();
        $("#userName").val(ui.item.label);
    },
});

$(function () {
    $('input#userName').keyup(function (e) {
        if (e.key === "Escape") {
            $(this).val("");
            // alert('keyup');
        }
    });
});