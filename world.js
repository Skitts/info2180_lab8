

window.onload = function ()
{    // document.getElementById("controls").innerHTML+= <input type= "checkbox">
    getMe();
}

function getMe()
{
    $('lookup').observe('click', function()
    {
        var term = $("term").getValue();
        new Ajax.Request("world.php",
                {
                    method : 'get',
                    parameters : {lookup : term},
                         onSucces: function(transport)
                            {
                                var response = transport.responseText  ||
                                "no response text";
                                $('result').update(response);
                                alert("Success!")
                                
                            },
                            
                 onFailure: function() {alert("An error has occurred!");}
                        
        });
    });
}
        
        
        
        
    }
    
    
    
    
}

