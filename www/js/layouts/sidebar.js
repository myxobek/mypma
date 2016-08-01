$(document).ready(
    function()
    {
        $('#sidebar').on(
            'click',
            'a.js-get-tables',
            function()
            {
                var link = $(this);

                if ( link.hasClass('collapsed') )
                {
                    var dbname = link.closest('.js-has-dbname').data('db');

                    if ( !link.hasClass('is-has-tables') )
                    {
                        $.ajax(
                            {
                                'dataType'  : 'json',
                                'method'    : 'post',
                                'data'      :
                                {
                                    'db_name'   : dbname,
                                    'csrftoken' : getCsrfToken()
                                },
                                'timeout'   : 60000,
                                'url'       : '/db/ajax/get/tables',
                                'success'   : function( data, textStatus, jqXHR )
                                {
                                    setCsrfToken( data['csrftoken'] );

                                    addTables( link, data['tables_list'] );

                                    if ( typeof showTables === 'function' )
                                    {
                                        showTables( dbname, data['tables_list_view'] );
                                    }
                                },
                                'error'     : function( jqXHR, textStatus, errorThrown )
                                {

                                }
                            }
                        );

                        $(this).addClass('is-has-tables');
                    }
                    else
                    {
                        showTables( dbname, [] );
                    }
                }
            }
        );

        $('#page').on(
            'click',
            '.js-table-open',
            function()
            {
                showTableInfo( $(this).closest('.js-has-dbname').data('db'), $(this).data('table') );
            }
        )
    }
);

/**
 * Adds tables to database panel
 *
 * @param   {Object}    $jqObj
 * @param   {Array}     data
 */
function addTables( $jqObj, data )
{
    // add tables list
    var tmp =
        '<ul class="list-group">';
    for( var i = 0, n = data.length; i < n; ++i )
    {
        var item = data[i];
        tmp +=
            '<li class="list-group-item">' +
                '<a href="#" class="js-table-open" data-table="' + item['table_name'] + '">' +
                    item['table_name']  +
                '</a>' +
            '</li>';
    }
    tmp +=
        '</ul>';

    $jqObj
        .closest('.panel-heading')
        .siblings('.panel-collapse').first()
        .children('.panel-body').first().append( tmp );
}

/**
 *
 * @param db_name
 * @param table_name
 */
function showTableInfo( db_name, table_name )
{
    $.ajax(
        {
            'dataType'  : 'json',
            'method'    : 'post',
            'data'      :
            {
                'db_name'       : db_name,
                'table_name'    : table_name,
                'csrftoken'     : getCsrfToken()
            },
            'timeout'   : 60000,
            'url'       : '/table/ajax/get',
            'success'   : function( data, textStatus, jqXHR )
            {
                console.log( data );
                setCsrfToken( data['csrftoken'] );
                alert('//TODO');
            },
            'error'     : function( jqXHR, textStatus, errorThrown )
            {

            }
        }
    );
}