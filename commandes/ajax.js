
var http; // Notre objet XMLHttpRequest


function gestionClic()
{
    http = createRequestObject();
    http.open('GET', './func/read_write_all_orders.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}

function gestionClic_2()
{
    http = createRequestObject();
    http.open('GET', './func/read_and_write_customers.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}



function createRequestObject()   // adaptation au browser
{
    var http;
    if (window.XMLHttpRequest)
    { // Mozilla, Safari, IE7 ...
        http = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    { // Internet Explorer 6
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return http;
}


function handleAJAXReturn()   // retour ajax
{
    if (http.readyState == 4)
    {
        if (http.status == 200)
        {
            
            document.getElementById('resultat').innerHTML = http.responseText;
        }
        else
        {
            alert('Erreur 345');
        }
    }
}