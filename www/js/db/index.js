var cache = {};

function showTables( dbname, data )
{
    $('#main').remove();

    if ( cache.hasOwnProperty( dbname ) )
    {
        $('#page').append( cache[dbname] );
    }
    else
    {
        $('#page').append( data );

        cache[ dbname ] = data;
    }
}