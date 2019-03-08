$(function () {
    var closeButton = $("<div class='o-pack__item'><i class='fa fas fa-times-circle fa-lg c-messages__close-btn' style='width: 1rem; cursor: pointer; float: right;'></i></div>");

    $(".c-messages__message").append(closeButton);

    $(".c-messages").on("click", ".c-messages__close-btn", function () {
        $(this).parent().parent().remove();
    });
});
