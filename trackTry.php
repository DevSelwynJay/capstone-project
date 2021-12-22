<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="scss/track.css">
</head>
<body>
<div class="tab">
    <button id="tab1" class="tablinks" onclick="openOPV();" >OPV</button>
    <button id="tab2" class="tablinks" onclick="openIPV();">IPV</button>
    <button id="tab3" class="tablinks" onclick="openBCG();">BCG</button>
    <button id="tab4" class="tablinks" onclick="openMMR();">MMR</button>
    <button id="tab5" class="tablinks" onclick="openCovid();">Covid Vaccine</button>
</div>
<div class="gridd">
    <div id="framecont"><iframe id="myframe" src="php/testingCode/opv.php" style="-webkit-transform:scale(0.9);"></iframe></div>
</div>
<script>
    function openOPV() {
        document.getElementById("myframe").src = "php/testingCode/opv.php";
        //document.getElementById("tab1").style.color  = "white";
        //document.getElementById("tab1").style.backgroundColor  = "black";
    }
    function openIPV() {
        document.getElementById("myframe").src = "php/testingCode/ipv.php";
        //document.getElementById("tab2").style.color  = "white";
        //document.getElementById("tab2").style.backgroundColor  = "black";
    }
    function openBCG() {
        document.getElementById("myframe").src = "php/testingCode/bcg.php";
        //document.getElementById("tab3").style.color  = "white";
        //document.getElementById("tab3").style.backgroundColor  = "black";
    }
    function openMMR() {
        document.getElementById("myframe").src = "php/testingCode/mmr.php";
        //document.getElementById("tab4").style.color  = "white";
        //document.getElementById("tab4").style.backgroundColor  = "black";
    }
    function openCovid() {
        document.getElementById("myframe").src = "php/testingCode/covid.php";
        //document.getElementById("tab5").style.color  = "white";
        //document.getElementById("tab5").style.backgroundColor  = "black";
    }

</script>

</body>
</html>