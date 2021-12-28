<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="scss/track.css">
    <!--Jquery-->
    <script src="js/jquery-3.6.0.js"></script>
    <!--Jquery UI css and js-->
    <link rel="stylesheet" href="jquery-ui/jquery-ui.css">
    <script src="jquery-ui/jquery-ui.js"></script>
</head>
<body>
<div class="tab">
    <button id="tab1" class="tablinks" onclick="openOPV();">OPV</button>
    <button id="tab2" class="tablinks" onclick="openIPV();">IPV</button>
    <button id="tab3" class="tablinks" onclick="openBCG();">BCG</button>
    <button id="tab4" class="tablinks" onclick="openMMR();">MMR</button>
    <button id="tab5" class="tablinks" onclick="openCovid();">Covid Vaccine</button>
</div>
<div class="gridd">
    <div id="framecont"><iframe id="myframe" src="php/testingCode/opv.php" style="-webkit-transform:scale(0.9);"></iframe></div>
</div>
<script>
    document.getElementById("tab1").focus();

    function openOPV() {
        document.getElementById("myframe").src = "php/testingCode/opv.php";

    }
    function openIPV() {
        document.getElementById("myframe").src = "php/testingCode/ipv.php";

    }
    function openBCG() {
        document.getElementById("myframe").src = "php/testingCode/bcg.php";

    }
    function openMMR() {
        document.getElementById("myframe").src = "php/testingCode/mmr.php";

    }
    function openCovid() {
        document.getElementById("myframe").src = "php/testingCode/covid.php";

    }

</script>

</body>
</html>