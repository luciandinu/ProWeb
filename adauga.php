<?php
	require_once("functii.php");

    if (isset($_POST["frm_add"])) var_dump($_POST["frm_add"]);
?>

<?php echo scrie_header("Adauga producator"); ?>
<body>
<!-- adaugare meniu -->
<?php echo scrie_meniu("adauga"); ?>
<!-- continutul vine aici -->
<article class="continut">
<h1 class='titlu'>Adauga producator <span>Completati formularul</span></h1>
<div class='dashboard'>
<!-- form-ul de adaugare -->
<form method="POST" name="frm_add" action="adauga.php" id="form_prod">
    <div id="info_producator">
        <input type="text" name="nume" id="den_producator" placeholder="Denumire producator"/>
        <input type="TEXT" name="data" readonly id="data_producator" placeholder="Alege data infiintarii"/>
        <div id="continut_calendar"></div>
    </div>
<div>
    <textarea name="descriere" id="desc_producator" placeholder="Descriere"></textarea>
</div>
<div id="info_detalii">
    <button class="buton" type="submit">Reseteaza</button>
    <button class="buton" type="reset" onclick="infoNeimplementat(this)">Adauga</button>
    <p id="desc">Completati formularul cu datele producatorului<br/><span>Selectati din calendar data de infiintare a producatorului</span></p>
</div>

</form>
</div>
</article>
 <?php echo scrie_footer(); ?>
<script src="moment.js"></script>
<script src="pikaday.js"></script>
 <script>

        var picker = new Pikaday(
    {
        field: document.getElementById('data_producator'),
        firstDay: 1,
        minDate: new Date('1900-01-01'),
        maxDate: new Date('2015-12-31'),
        yearRange: [1900, 2015],
        format: 'DD-MM-YYYY',
        bound: false,
        container: document.getElementById('continut_calendar'),
        i18n: {
                previousMonth : 'Luna anterioara',
                nextMonth     : 'Luna urmatoare',
                months        : ['Ianuarie','Februarie','Martie','Aprilie','Mai','Iunie','Julie','August','Septembrie','Octobrie','Noiembrie','Decembrie'],
                weekdays      : ['Duminica','Luni','Marti','Miercuri','Joi','Vineri','Sambata'],
                weekdaysShort : ['Du','Lu','Ma','Mi','Jo','Vi','Sa']
                }
    });
</script>
 <!-- adaug JS la sfarsit -->
<script type="text/javascript" src="app.js"></script>
 <!-- inchidere body -->
</body>
<!-- inchidere tag tml -->
</html>