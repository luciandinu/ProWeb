<?php
	require_once("functii.php");
?>

<?php echo scrie_header(); ?>
<body>
<!-- adaugare meniu -->
<?php echo scrie_meniu("index"); ?>
<!-- continutul vine aici -->
<article class="continut">
<?php
$baza_producatori = conectare_db();
    try {
        //incercam sa aducem rezultatele din tabela
        $rezultat = $baza_producatori->query('SELECT * FROM Producatori ORDER BY date(data) DESC LIMIT 5');

        if (!$rezultat) {
            $mesaj.="<div class='notificare'>"
                ."<p><b>Nu exista</b> producatori in baza de date.</p>"
                ."<p><a href='adauga.php'><i class='fa fa-plus'></i>$nbsp Adauga</a> un producator nou.</p>"
                ."</div>";
            echo $mesaj;
        } else {
            //initializez array pentru grafic
            $graficdata = [];
            $graficnume = [];
            //construiesc lista
            $mesaj.="<h1 class='titlu'>Ultimi producatori infiintati <span>Ordonare in functie de anul infintarii</span></h1>"
                ."<div class='dashboard'>"
                ."<div class='graficprod'>"
                ."<canvas id='grafic'></canvas>"
                ."</div>"
                ."<ul class='rezultate'>";
              foreach ( $rezultat as $rand) {
            $mesaj.="<li class='rezultate-item' style='cursor:default;'>"
                ."<span class='info_nume'>".$rand['nume']."</span>"
                ."<span class='info_data'>".$rand['data']."</span>"
                ."<span class='info_desc'>".substr($rand['descriere'],0,25)." ..."."</span>"
                .'</li>';
                $graficdata[] = $rand['data'];
                $graficnume[] = $rand['nume'];
            }
           $mesaj.="</ul>"
           ."</div>";
           echo $mesaj;

       }

    }
	catch(PDOException $e) {
	    //  arunca o exceptie daca tabela nu exista (sau altceva)
	    print 'Exceptie : '.$e->getMessage();
	}
?>
</article>
<?php echo scrie_footer(); ?>
<script type="text/javascript">
//Crearea graficului pe elementul Canvas
var ctx = document.getElementById("grafic").getContext("2d");
Chart.defaults.global.responsive = true;

//exemplu de date pentru grafic
var data = {
    labels: [<?php
            foreach ( $graficdata as $rand) {
                echo '"'.$rand.'"'.",";
            }
             ?>],
    datasets: [
        {
            label: "Producatori",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(117,221,43,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data:[<?php
            foreach ( $graficnume as $rand) {
                echo '"'.$rand.'"'.",";
            }
             ?>]
        }

    ]
};
//creare grafic
var graficprod = new Chart(ctx).Line(data);
</script>
<!-- adaug JS la sfarsit -->
<script type="text/javascript" src="app.js"></script>
<!-- inchidere body -->
</body>
<!-- inchidere tag html -->
</html>