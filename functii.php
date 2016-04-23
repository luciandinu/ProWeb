<?php
/************************************/
/*   Setare parametri aplicatie     */
/*   ---------------------------    */
/*   Dinu Lucian UTM ID Grupa:208   */
/************************************/

	//afisare erori pt. debug

	//error_reporting(E_ALL);
    error_reporting(E_ERROR | E_WARNING | E_PARSE); //fara NOTICE
	ini_set('display_errors', 1);

//Denumire aplicatie
$titlu = "Evidenta producatori";
// baza de date este SQLite
$db ="aplicatie.db";


/**************************************/
/*   Functii utilizate in aplicatie   */
/*   ------------------------------   */
/**************************************/

// scriere header
function scrie_header($pagina=null){
	// verificam daca suntem pe o pagina
	if ($pagina != null) $titlu_pagina = $pagina." | ".$GLOBALS["titlu"];
	else
	$titlu_pagina = $GLOBALS["titlu"];
	// continutul de scris
	return $continut = "
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta name='description' content='Proiect Dinu Lucian UTM ID Grupa: 208'>
    <meta name='HandheldFriendly' content='True'>
    <meta name='MobileOptimized' content='320'>
    <meta name='viewport' content='width=device-width, initial-scale=1, minimal-ui'>
    <meta http-equiv='cleartype' content='on'>
    <meta name='author' content='Dinu Lucian'>
    <!-- Folosim Open Sans direct din CDN-ul Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' type='text/css' href='pikaday.css' />
    <link rel='stylesheet' type='text/css' href='font-awesome.css' />
    <link rel='stylesheet' type='text/css' href='stil.css' />
    <script src='chart.js'></script>
    <link rel='icon' href='favicon.ico' type='image/x-icon' />
    <link rel='shortcut icon' href='favicon.png' />
    <title>$titlu_pagina</title>
</head>
";
}

// scriere meniu
function scrie_meniu($pagina){
	switch($pagina){
		case "index":
		$index_activ=" activ";
		break;
		case "lista":
		$lista_activ=" activ";
		break;
		case "adauga":
		$adauga_activ=" activ";
		break;
		}
return $continut ="
<nav class='meniu'>
  <a class='meniu-item$index_activ' href='index.php'><i class='fa fa-home fa-fw'></i>Acasa</a>
  <a class='meniu-item$lista_activ' href='lista.php'><i class='fa fa-list fa-fw'></i>Lista</a>
  <a class='meniu-item$adauga_activ' href='adauga.php'><i class='fa fa-plus fa-fw'></i>Adauga</a>
</nav>
";
}
// scriere footer
function scrie_footer(){
    return "<footer><p class='copyright'>Copyright Dinu Lucian 2015</p></footer>";
}

// conectare la baza folosind PHP Data Objects
function conectare_db(){
    $data  = new PDO("sqlite:".$GLOBALS["db"]) or die("Nu pot sa ma conectez la baza!");
    return $data;
}
?>