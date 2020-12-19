
var hostName = document.getElementById('hostName').getAttribute('hostName');

var flag_var = false;
function pageCleanup()
{
    if (!flag_var)
    {
        $.ajax({
            type: 'GET',
            async: false,
            url: 'http://'+hostName+'/login_system/pages/islogout',
            success: function ()
            {
                flag_var = true;
            }
        });
    }
}

$(window).keydown(function(event) {
    if (event.keyCode == 116) {
        flag_var = true;
    }
});

$('document').bind('keypress', function(e) {
    if (e.keyCode == 116){
        flag_var = true;
    }
});

$("a").bind("click", function() {
    flag_var = true;
});

$("form").bind("submit", function() {
    flag_var = true;
});

    
    
    

$(window).on('beforeunload unload', function ()
{
    // if (flag_var == false) { // If F5 is not pressed
        pageCleanup();
    // }
});