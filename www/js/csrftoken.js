// csrftoken
// http://www.javascriptobfuscator.com/Javascript-Obfuscator.aspx
/* Name Mangling, Encode Strings, Compressor: Auto, Move Strings Into Array, Move Members */
eval((function(){var b=[79,94,82,85,60,76,65,86,89,72,74,80,88,70,75,87,90,71,66,81];var c=[];for(var h=0;h<b.length;h++)c[b[h]]=h+1;var l=[];for(var y=0;y<arguments.length;y++){var q=arguments[y].split('~');for(var d=q.length-1;d>=0;d--){var z=null;var o=q[d];var r=null;var x=0;var v=o.length;var m;for(var w=0;w<v;w++){var p=o.charCodeAt(w);var u=c[p];if(u){z=(u-1)*94+o.charCodeAt(w+1)-32;m=w;w++;}else if(p==96){z=94*(b.length-32+o.charCodeAt(w+1))+o.charCodeAt(w+2)-32;m=w;w+=2;}else{continue;}if(r==null)r=[];if(m>x)r.push(o.substring(x,m));r.push(q[z+1]);x=w+1;}if(r!=null){if(x<v)r.push(o.substring(x));q[d]=r.join('');}}l.push(q[0]);}var g=l.join('');var a='abcdefghijklmnopqrstuvwxyz';var k=[126,96,10,39,42,92].concat(b);var n=String.fromCharCode(64);for(var h=0;h<k.length;h++)g=g.split(n+a.charAt(h)).join(String.fromCharCode(k[h]));return g.split(n+'!').join(n);})('O*_$_5fa5=["csrftoken","data","remove","each","input[name=@f"","@f"]","find","length","decrypt","appendTo","@kinput />","hidden"O%O+"O%Direction","atob","base64","","charCode@mt","to@lowerO+","char@mt","to@jpperO+"];O*csrftoken={"initO#dO)a=O\'0],b=d[O&]](a);d[O\'6]](O\'4]+a+O\'5]O$3]](function(e,f){$(fO$2]]()});if(bO!>32O)c=O 8]](b);if(cO!==32){$(O&0],{type:O&1],name:a,value:c}O$9]](d)O(true}}O(false},"decryptO#g){return (O 13]]($[O&5]][O&4]](O 13]](O 12]](g)))))}O%O+O#lO)k=O&6];O*h=O&6];for(O*e=0,j=lO!-1;e@k=j;e++){hO"7O,);if(h>=65&&h@k=90){k+O"9O,O$18]]()}else {if(h>=97&&h@k=122){k+O"9O,O$20]]()}else {k+O"9O,)}}}O(k}O%DirectionO#nO)m=O&6];for(O*e=nO!-1;e>=0;e--){m+=n[e]}O(m}}~this[O\'~[O\'7]]~=l[O&~":function(~)[O\'~,"_reverse~O\'1~_$_5fa5[~;return ~){O*~var ~Case~]](e'));

/*
var csrftoken =
{
    'init'          : function( obj )
    {
        var csrftoken_data_fieldname = 'csrftoken',
            csrftoken_data_value     = obj.data(csrftoken_data_fieldname);

        // destroy all previous input.csrftoken
        obj.find('input[name="'+csrftoken_data_fieldname+'"]').each(
            function( i, v )
            {
                $(v).remove();
            }
        );

        // get token
        if( csrftoken_data_value.length>32 )
        {
            var csrftoken_data_value_decrypted = this.decrypt( csrftoken_data_value );

            if( csrftoken_data_value_decrypted.length==32 )
            {
                // create new input.csrftoken
                $('<input />',
                    {
                        type    : 'hidden',
                        name    : csrftoken_data_fieldname,
                        value   : csrftoken_data_value_decrypted
                    }).appendTo( obj );

                return true;      // ALL OK
            }
        }

        return false;
    },

    'decrypt'       : function( token )
    {
        return (
            this._reverseDirection(
                $.base64.atob(
                    this._reverseDirection(
                        this._reverseCase(
                            token
                        )
                    )
                )
            )
        );
    },

    '_reverseCase' : function(str)
    {
        var output = '';
        var code = '';

        for (var i=0,len=str.length-1; i<=len; i++)
        {
            code = str.charCodeAt(i);

            if(code >= 65 && code <= 90)
            {
                output+=str.charAt(i).toLowerCase();
            }
            else if(code >=97 && code <= 122)
            {
                output+=str.charAt(i).toUpperCase();
            }
            else
            {
                output+=str.charAt(i);
            }
        }

        return output;
    },

    '_reverseDirection' : function(s)
    {
        var o = '';

        for( var i = s.length - 1; i >= 0; i-- )
        {
            o += s[i];
        }

        return o;
    }
};
*/
