$(".todolist-save").on("click", function () {
    var title = $("#todolistTitle").val();
    var url = $(this).data("url");
    $.ajax({
        url: url,
        type: "POST",
        data: {title: title},
        success: function (data) {
            $("ul.todo-list").html(data);
            $('#todolistModal').modal('hide');
        }

    });
})
$('input').on('ifChecked', function (event) {
    var ischecked = event.type;
    var url = $(".todolist-save").data("url");
    //alert(event.type + ' callback');
    if (ischecked == 'ifChecked') {
        $.ajax({
            url: url,
            type: "POST",
            data: {id: $(this).val()},
            success: function (data) {
                //$("ul.todo-list").html(data);
            }

        });
    }
});
$("#todolistPasive").on("click", function () {
    var url = $(".todolist-save").data("url");
    $.ajax({
            url: url,
            type: "POST",
            data: {type: 1},
            success: function (data) {
                $("ul.todo-list").html(data);
            }

        });
})
$("#todolistActive").on("click", function () {
    var url = $(".todolist-save").data("url");
    $.ajax({
            url: url,
            type: "POST",
            data: {type: 0},
            success: function (data) {
                $("ul.todo-list").html(data);
            }

        });
})