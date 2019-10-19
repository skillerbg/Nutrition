function cambiar_login() {
    window.open("login", "_self");
}

function cambiar_sign_up(at) {
    window.open("register", "_self");


}
$(function () {
    $(document).on('click', '.new-week', function () {
        window.open("week/view", "_self");

    });
    $('.new-week').css('cursor', 'pointer');

});
$(function () {
    $(document).on('click', '.filter', function () {
        window.open("week/filter", "_self");

    });
    $('.filter').css('cursor', 'pointer');

});
$(function () {
    $(document).on('click', '.new-recipe', function () {
        window.open("recipe/create", "_self");

    });
    $('.new-recipe').css('cursor', 'pointer');

});
$(function () {
    $(document).on('click', '.shoping_list', function () {
        window.open("cart/view", "_self");

    });
    $('.shoping_list').css('cursor', 'pointer');

});
$(function () {
    $(document).on('click', '.today', function () {
        window.open("day/today", "_self");

    });
    $('.today').css('cursor', 'pointer');

});
$(function () {
    $(document).on('click', '.no-user', function () {
        window.open("login", "_self");

    });
    $('.no-user').css('cursor', 'pointer');

});