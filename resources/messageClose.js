$(function () {
    var closeButton = $("<div class='o-pack__item'><i class='fa fas fa-times-circle fa-lg c-messages__close-btn' style='width: 1rem; cursor: pointer; float: right;'></i></div>")
        .click(function () {
            $(this).parent().remove();
        });

    $(".c-messages__message").append(closeButton);
});
