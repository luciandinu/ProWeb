<?php
/*******************************************/
/*   API pentru preluare XMLHttpRequests   */
/*   ----------------------------------    */
/*   Dinu Lucian UTM ID Grupa:208          */
/*******************************************/

/* Includem functiile si stabilim conexiunea la baza de date */
require_once("functii.php");
// Setam header raspuns
header('Content-Type: application/json');
//Metoda
$methoda = $_SERVER['REQUEST_METHOD'];

switch ($methoda) {
  case 'PUT':
    // Ceva aici
    break;
  case 'POST':
    // Ceva aici
    break;
  case 'GET':
    if (isset($_GET["id"])) detaliuProducator(); //aducem detaliile
    break;
  case 'DELETE':
    if (isset($_GET["id"])) stergeProducator(); //stergem producatorul
    break;
}

//functia care returneaza detalii producator
function detaliuProducator(){
    $baza_producatori = conectare_db();
    try {
        //incercam sa aducem rezultatele din tabela
        $id_cautat = $_GET["id"];
        $rezultat = $baza_producatori->prepare("SELECT * FROM Producatori WHERE id='$id_cautat'");
        $rezultat->execute();
        $rezultat = $rezultat->fetch(PDO::FETCH_NAMED);
       if ($rezultat)  {
                echo json_encode($rezultat);
           } else {
                 echo json_encode(array(
                            'Eroare' => true,
                            'Mesaj' => 'Eroare! nu exista acest element in baza'
                            ));
           };
        }
	catch(PDOException $e) {
	    //  arunca o exceptie daca tabela nu exista (sau altceva)
	    print 'Exceptie : '.$e->getMessage();
	}
}

//functia care sterge producatorul
function stergeProducator(){
    echo json_encode(array(
                        'Eroare' => false,
                        'Mesaj' => 'Merge! id='. $_GET["id"]
                        ));
}
?>