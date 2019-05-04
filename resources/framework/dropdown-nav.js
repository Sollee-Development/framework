/* From w3schools */

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
$(function () {
    $('.c-site-nav').on('click', '.c-dropdown__btn', function (event) {
        event.preventDefault();
        $(this).parent().nextAll(".c-dropdown__cont").toggleClass('c-dropdown__cont--hide');
        $(this).parent().nextAll(".mean-expand").click();
    });
});

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.c-dropdown__btn')) {
        $(".c-dropdown__cont").addClass('c-dropdown__cont--hide');
    }
}