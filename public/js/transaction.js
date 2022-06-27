var script = document.createElement('script');
script.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js';

$(function () {

    $(document).on('click', '.btn-add', function (e)
    {
        e.preventDefault();
        var controlForm = $(this).parents('.add-cart-section .cart-section-form:first'),
                currentEntry = $(this).parents('.cart:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.cart:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-primary').addClass('btn-danger')
                .html('<i class="fas fa-lg fa-minus"></i>');
    }).on('click', '.btn-remove', function (e)
    {
        $(this).parents('.cart:first').remove();
        e.preventDefault();
        return false;
    });
});