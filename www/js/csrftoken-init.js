$(document).ready(
    function()
    {
        $('body form').on(
            'submit',
            function( e )
            {
                return csrftoken.init( $(this) )
            });
    }
);

function getCsrfToken()
{
    return csrftoken.decrypt( $('#csrftoken').data('csrftoken') );
}

function setCsrfToken( token )
{
    $('#csrftoken').data('csrftoken', token );
}