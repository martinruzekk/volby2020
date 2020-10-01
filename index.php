<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volby 2020</title>

    <link rel="stylesheet" href="./styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <div class="header-wrapper">
            <h1 class="nadpis">Volby 2020 - Karlovarský kraj</h1>

            <div class="warn">
                <h1>!</h1>
                <p class="warning">Tato aplikace je zaměřená hlavně na osobní účel.
                    Její fungování není zcela správné a dobré. Prosím, berte na to při jejím používání
                    ohled. Díky.</p>
            </div>
        </div>
    </header>
    <main>
        <?php
        $xml = simplexml_load_file('https://volby.cz/pls/kz2020/vysledky');
        $xmlKan = simplexml_load_file('https://volby.cz/pls/kz2020/vysledky_kandid');
        echo $xml->KRZAST[0]->STRANA[0]['HLASY'];
        //print_r($xml->KRZAST[3]['POCMANDATU']);
        $sectenoOkrsku = $xml->KRZAST[3]->UCAST['OKRSKY_ZPRAC'];
        $sectenoPrc = $xml->KRZAST[3]->UCAST['OKRSKY_ZPRAC_PROC'];
        $okrskuCelkem = $xml->KRZAST[3]->UCAST['OKRSKY_CELKEM'];
        $ucast = $xml->KRZAST[3]->UCAST['UCAST_PROC'];
        $platneHlasy = $xml->KRZAST[3]->UCAST['PLATNE_HLASY'];
        ?>
        <section class="celkem">
            <h1>Sečteno: </h1>
            <div class="progressBar">
                <p><?php echo $sectenoOkrsku . '/' . $okrskuCelkem . ' (' . $sectenoPrc . '%)' ?></p>
                <div class="progress" <?php echo 'style="width: ' . $sectenoPrc . '%"' ?>>
                </div>
            </div>
            <h1>Účast: </h1>
            <div class="progressBar">
                <p><?php echo $ucast . '%' ?>
                    <div class="progress" <?php echo 'style="width: ' . $ucast . '%"' ?>>
                    </div>
            </div>
            <h1>Počet platných hlasů: <?php echo $platneHlasy ?></h1>
        </section>


        <?php
        $ruzek = 0;
        $hnykova = 0;
        $picinger = 0;
        $vojta = 0;
        $egrt = 0;

        $maruzanova = 0;
        $kulhanek = 0;
        $zahradnicek = 0;
        $zemla = 0;
        $knadidatiSTAN = array();


        for ($i = 0; $i < 9999; $i++) {
            $kan = $xmlKan->KRZAST[3]->KANDIDATI->KANDIDAT[$i];
            if ($kan['KSTRANA'] == 49 && $kan['PORCISLO'] == 14) {
                // táta
                $ruzek = $kan['HLASY'];
            } elseif ($kan['KSTRANA'] == 49 && $kan['PORCISLO'] == 1) {
                // picingr
                $picinger = $kan['HLASY'];
            } elseif ($kan['KSTRANA'] == 49 && $kan['PORCISLO'] == 6) {
                // hnykova
                $hnykova = $kan['HLASY'];
            } elseif ($kan['KSTRANA'] == 49 && $kan['PORCISLO'] == 3) {
                // egrt
                $egrt = $kan['HLASY'];
            } elseif ($kan['KSTRANA'] == 49 && $kan['PORCISLO'] == 37) {
                // vojta
                $vojta = $kan['HLASY'];
            } elseif ($kan['KSTRANA'] == 62 && $kan['PORCISLO'] == 43) {
                // maruzanova
                $maruzanova = $kan['HLASY'];
            } elseif ($kan['KSTRANA'] == 62 && $kan['PORCISLO'] == 1) {
                // kulhanek
                $kulhanek = $kan['HLASY'];
            } elseif ($kan['KSTRANA'] == 62 && $kan['PORCISLO'] == 4) {
                // zahradnicek
                $zahradnicek = $kan['HLASY'];
            } elseif ($kan['KSTRANA'] == 62 && $kan['PORCISLO'] == 20) {
                // zemla
                $zemla = $kan['HLASY'];
            }
        }
        for ($i = 0; $i < 17; $i++) {
            $strana = $xml->KRZAST[3]->STRANA[$i];

            echo '
                <section class="strana">
            <h1 class="strana-name">' . $strana['NAZ_STR'] . '</h1>
            <div class="progressBar">
                <p>' . $strana->HODNOTY_STRANA['PROC_HLASU'] . '% (' . $strana->HODNOTY_STRANA['HLASY'] . ')</p>
                <div class="progress" style="width: ' . $strana->HODNOTY_STRANA['PROC_HLASU'] . '%">
                </div>
            </div>';
            if ($strana['KSTRANA'] == 62) {
                echo '<div class="pref">
                <div class="kandidat">
                    <h1>Kateřina Maružánová</h1>
                    <h2>' . $maruzanova . '</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
                <div class="kandidat">
                    <h1>Petr Zahradníček</h1>
                    <h2>' . $zahradnicek . '</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
                <div class="kandidat">
                    <h1>Petr Kulhánek</h1>
                    <h2>' . $kulhanek . '</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
                <div class="kandidat">
                    <h1>Pavel Žemlička</h1>
                    <h2>' . $zemla . '</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
                </div>';
            } elseif ($strana['KSTRANA'] == 49) {
                echo '
                <div class="pref">
                <div class="kandidat">
                    <h1>Jaroslav Růžek</h1>
                    <h2>' . $ruzek . '</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
                <div class="kandidat">
                    <h1>Hana Hnyková</h1>
                    <h2>' . $hnykova . '</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
                <div class="kandidat">
                    <h1>Miroslav Egrt</h1>
                    <h2>' . $egrt . '</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
                <div class="kandidat">
                    <h1>Jaroslav Vojta</h1>
                    <h2>' . $vojta . '</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
                </div>
                ';
            }
            echo '</section>';
        }
        ?>

        <!--<section class="strana">
            <h1 class="strana-name">HNHRM</h1>
            <div class="progressBar">
                <p>0.00% (0 hlasů)</p>
                <div class="progress">

                </div>
            </div>
            <div class="pref">
                <div class="kandidat">
                    <h1>Jaroslav Růžek</h1>
                    <h2>0</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
                <div class="kandidat">
                    <h1>Hana Hnyková</h1>
                    <h2>0</h2>
                    <h4>preferenčních hlasů</h4>
                </div>
            </div>
        </section>-->
    </main>

    <footer>
        <p>Zdroj: Český statistický úřad (<a href="https://www.volby.cz">www.volby.cz</a>)</p>
        <p>&copy; Martin Růžek 2020</p>
    </footer>
</body>

</html>