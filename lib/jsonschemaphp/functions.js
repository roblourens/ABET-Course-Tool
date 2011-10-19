function print_r( array, return_val ) {
    // http://kevin.vanzonneveld.net
    // +   original by: Michael White (http://getsprink.com)
    // +   improved by: Ben Bryan
    // *     example 1: print_r(1, true);
    // *     returns 1: 1
    
    var output = "", pad_char = " ", pad_val = 4;
 
    var formatArray = function (obj, cur_depth, pad_val, pad_char) {
        if (cur_depth > 0) {
            cur_depth++;
        }
 
        var base_pad = repeat_char(pad_val*cur_depth, pad_char);
        var thick_pad = repeat_char(pad_val*(cur_depth+1), pad_char);
        var str = "";
 
        if (obj instanceof Array || obj instanceof Object) {
            str += "Array\n" + base_pad + "(\n";
            for (var key in obj) {
                if (obj[key] instanceof Array) {
                    str += thick_pad + "["+key+"] => "+formatArray(obj[key], cur_depth+1, pad_val, pad_char);
                } else {
                    str += thick_pad + "["+key+"] => " + obj[key] + "\n";
                }
            }
            str += base_pad + ")\n";
        } else if(obj == null || obj == undefined) {
            str = '';
        } else {
            str = obj.toString();
        }
 
        return str;
    };
 
    var repeat_char = function (len, pad_char) {
        var str = "";
        for(var i=0; i < len; i++) { 
            str += pad_char; 
        };
        return str;
    };
    output = formatArray(array, 0, pad_val, pad_char);
 
    if (return_val !== true) {
        document.write("<pre>" + output + "</pre>");
        return true;
    } else {
        return output;
    }
}