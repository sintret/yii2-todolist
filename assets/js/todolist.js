$(".todolist-save").on("click", function () {
    var title = $("#todolistTitle").val();
    var url = $(this).data("url");
    $.ajax({
        url: url,
        type: "POST",
        data: {title: title},
        success: function (data) {
            $("ul.todo-list").html(data);
        }

    });
})
$('.todolistCheck').on('change', function () {
    if (this.checked) {
        $.ajax({
            url: url,
            type: "POST",
            data: {id: $(this).val()},
            success: function (data) {
                $("ul.todo-list").html(data);
            }

        });
    }
});