/* From w3schools */

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
$(function () {
    $('.c-dropdown__btn').click(function (event) {
        event.preventDefault();
        $(this).nextAll(".c-dropdown__cont").toggle();
    });
});

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.c-dropdown__btn')) {
        $(".c-dropdown__cont").hide();
    }
}