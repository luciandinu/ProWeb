<?php
	require_once("functii.php");
?>

<?php echo scrie_header("Lista producatorilor"); ?>
<body>
<!-- adaugare meniu -->
<?php echo scrie_meniu("lista"); ?>
<!-- continutul vine aici -->
<article class="continut">
<?php
$baza_producatori = conectare_db();
    try {
        //incercam sa aducem rezultatele din tabela
        $rezultat = $baza_producatori->query('SELECT * FROM Producatori ORDER BY nume ASC');

        if (!$rezultat) {
            $mesaj.="<div class='notificare'>"
                ."<p><b>Nu exista</b> producatori in baza de date.</p>"
                ."<p><a href='adauga.php'><i class='fa fa-plus'></i>$nbsp Adauga</a> un producator nou.</p>"
                ."</div>";
            echo $mesaj;
        } else {
            $mesaj.="<h1 class='titlu'>Lista producatorilor <span>Ordonare alfabetica</span></h1>"
                ."<div class='dashboard'>"
                ."<ul class='rezultate'>";
              foreach ( $rezultat as $index=>$rand) {
              $mesaj.="<li class='rezultate-item' onclick='afiseazaDetaliiProducator(event,this,"
                    .$rand['id'].")' onmouseenter='arataHint(this)' onmouseleave='ascundeHint(this)'>"
                    ."<span class='info_nr'>".($index+1)."</span>"
                    ."<span class='info_nume'>".$rand['nume']."</span>"
                    ."<span class='info_data'>".$rand['data']."</span>"
                    ."<span class='info_desc'>".substr($rand['descriere'],0,25)." ..."."</span>"
                    ."<button class='buton-item' onclick='infoNeimplementat(this)'>Sterge</button>"
                    ."<button class='buton-item' onclick='infoNeimplementat(this)'>Editeaza</button>"
                   // ."<button class='buton-item' onclick='stergeProducator(this,".$rand['id'].")'>Sterge</button>"
                   // ."<button class='buton-item' onclick='editeazaProducator(this,".$rand['id'].")'>Editeaza</button>"
                   ."<p class='info_click'>Click pentru detalii</p>"
                    ."</li>";
            }
           $mesaj.="</ul>"
           ."</div>";
           echo $mesaj;
       }

        //var_dump($rezultat);
    }
	catch(PDOException $e) {
	    //  arunca o exceptie daca tabela nu exista (sau altceva)
	    print 'Exceptie : '.$e->getMessage();
	}
?>
</article>
 <?php echo scrie_footer(); ?>
 <!-- adaug JS la sfarsit -->
<script type="text/javascript" src="app.js"></script>
<!-- inchidere body -->
</body>
<!-- inchidere tag tml -->
</html>