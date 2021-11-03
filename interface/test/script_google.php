<?php
ini_set('display_errors','on');
require __DIR__ . '/vendor/autoload.php';



$client = new GoogleSearchResults("your secret key");

$query = ["q" => "coffee","location"=>"Austin,Texas"];

$json_results = $client->get_json($query);

print_r($json_results);