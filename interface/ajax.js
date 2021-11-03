var http; // Notre objet XMLHttpRequest




function gestionClic()
{
    http = createRequestObject();
    //http.open('GET', './connection/interface/function/function_recheck_refused_prod_2.php', true);
    http.open('GET', './function/read_write_all_orders.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}


function gestionClic_2()
{
    http = createRequestObject();
    http.open('GET', './function/read_and_write_customers.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}

function gestionClic_8()
{
    http = createRequestObject();
    http.open('GET', '../function/prepare_list.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}



function gestionClic_3()
{
    http = createRequestObject();
    http.open('GET', '../../connection/maj_cron/maj_stock.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}



function gestionClic_test()
{
    http = createRequestObject();
    http.open('GET', '../function/test_ajax.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}



function gestionClic_4()
{
    http = createRequestObject();
    http.open('GET', '../preparation_products.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}

function gestionClic_5()
{
    http = createRequestObject();
    http.open('GET', '../../connection/interface/function/function_recheck_refused_prod_2.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}


function gestionClicVerif()
{
    http = createRequestObject();
    http.open('GET', '../maj_cron/page_images_auto.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}

function gestionClicSeo()
{
    http = createRequestObject();
    http.open('GET', '../../connection/maj_cron/auto_seo_cron.php', true);
    http.onreadystatechange = handleAJAXReturn;
    http.send(null);
}




function gestionClic_6()
{
    http = createRequestObject();
    http.open('GET', '../../connection/maj_cron/maj_special_price.php', true);
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
            alert(http.responseText);
            document.getElementById('resultat').innerHTML = http.responseText;
        }
        else
        {
            alert('Erreur 345');
        }
    }
}



// function handleAJAXReturn2()   // retour ajax
// {
//     if (http.readyState == 4)
//     {
//         if (http.status == 200)
//         {
//             alert(http.responseText);
//             document.getElementById('resultat_2').innerHTML = http.responseText;
//         }
//         else
//         {
//             alert('Erreur 345');
//         }
//     }