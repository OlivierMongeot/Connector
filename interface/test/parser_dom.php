<?php
include_once ('simplehtmldom/simple_html_dom.php'); 
include 'menu.php';
?>



<html lanf="fr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<!-- <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
<?php

//$html = file_get_html('http://www.centrecommercial.cc/fr/product/homme/marques/avnier/avnbtee,black,t+shirt+basique.html');
$context = stream_context_create(
    array(
        "http" => array(
            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
        )
    )
);


$first = 'avnier';
$deux  = 'sweat';
$url = 'https://www.google.fr/search?q='.$first.'+'.$deux.'';

//$url = 'https://avnier.com/products/basic-black-tee-shirt';


$html = file_get_html($url, false , $context);

//foreach ($html->find('.product_cms') as $num) 
/*
foreach ($html->find('.p-info-tabs__content--0') as $num) 
{
echo $num->plaintext.' '; 
}
echo '</br>';
foreach ($html->find('.p-info-tabs__content--1') as $num1) 
{
echo $num1->plaintext.' '; 
}
echo '<br />';
*/
var_dump($html);



/*
foreach ($html->find('.data-hveid') as $num1) 
{
echo $num1->plaintext.' '; 
}
echo '<br />';
// extract text from table
//echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';

// extract text from HTML
//echo $html->plaintext;


// find all image
foreach($html->find('img') as $e){


    echo $e->src . '<br>';
	//echo $e->outertext . '<br>';
}
// find all image with full tag
//foreach($html->find('img') as $e)
 //   





/*
$in = "Beautiful Bangladesh";
$in = str_replace(' ','+',$in); // space is a +
$url  = 'http://www.google.com/search?hl=en&tbo=d&site=&source=hp&q='.$in.'&oq='.$in.'';

// https://www.google.fr/search?rlz=1C2CHBF_frFR862FR863&sxsrf=ACYBGNRwUec8TrF9b5I16cGxfFrsUtRnwQ%3A1577149234851&source=hp&ei=MmMBXoLhMYuOlwSe25PIBA&q=avnier+sweat&oq=avnier+seat&gs_l=psy-ab.1.1.35i304i39j0i13l2j0i13i30l2j0i8i13i30l5.2530.9226..12277...2.0..0.71.685.11......0....1..gws-wiz.....10..35i362i39j35i39j0i131j0j0i131i67j0i67j0i20i263j0i13i5i30.PrvsVLR3PIA

print $url."<br>";

$html = file_get_html($url);

$i=0;
$linkObjs = $html->find('h3.r a'); 
foreach ($linkObjs as $linkObj)


 {
    $title = trim($linkObj->plaintext);
    $link  = trim($linkObj->href);

    // if it is not a direct link but url reference found inside it, then extract
    if (!preg_match('/^https?/', $link) && preg_match('/q=(.+)&amp;sa=/U', $link, $matches) && preg_match('/^https?/', $matches[1])) {
        $link = $matches[1];
    } else if (!preg_match('/^https?/', $link)) { // skip if it is not a valid link
        continue;
    }

    $descr = $html->find('span.st',$i); // description is not a child element of H3 thereforce we use a counter and recheck.
    $i++;   
    echo '<p>Title: ' . $title . '<br />';
    echo 'Link: ' . $link . '<br />';
    echo 'Description: ' . $descr . '</p>';
}
*/
//$first = 'avnier';
//$deux  = 'hoodie';
$url = 'https://www.google.fr/search?q='.$first.'+'.$deux.'';

//echo $url;

  echo '<br>';

//$codesource = file_get_contents($url);

//var_dump($codesource);
//echo $codesource;
//preg_match_all("#<a class=\"C8nzq.BmP5tf\" href=\"/url\?q=.+\">(.+)#iU", $codesource, $tableau_resultat);

echo "<pre>";
//print_r($tableau_resultat);
echo "</pre>";
































?>
</body>
</html>
