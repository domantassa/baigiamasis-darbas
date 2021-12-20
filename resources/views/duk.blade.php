@extends('layouts.backend', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')
<!-- Hero -->
<div class="bg-body-light">
        <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                Dažnai užduodami klausimai </h1>
            </div>
                
            
       </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->

    <div class="contentShadowInset">
        
        <div class="row justify-content-center dashboardas">
            
            <div class="col-md-12 col-xl-12">
                <div class="col-12 " style="padding-left:1.875rem">
                   <div class="acordion">
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Kaip vyksta užsakymo procesas?
                            </div>
                            <div class='acor-body'>
                            1. Pasirenkate ar sukuriate sau tinkamą ekosistemos planą.<br>
                            2. Pasirinkus tinkamiausią ekosistemą apmokate vieną mėnesį į priekį.<br>
                            3. Sėkminga Reklamos Ekosistemos auginimo pradžia.<br>
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Kaip vyksta darbo procesas?
                            </div>
                            <div class='acor-body'>
                            1. Pateikiate grafikos dizaino darbo užklausą mūsų platformoje. <br>
                            2. Per 24 valandas pateikiame pirmini darbo rezultatą. Juos rasite skiltyje “Mano failai”. <br>
                            3. Jei yra poreikis - pateikiate pataisymus, pasiekus norimą rezultatą darbas yra fiksuojamas užbaigtas. Pataisymus atliekame kuo įmanoma greičiau, vėliausiai pirmųjų pataisymų sulauksite per 12 valandų.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Per kiek laiko yra įvykdoma mano dizaino užklausa?
                            </div>
                            <div class='acor-body'>
                            Pirmieji darbo rezultatai yra pateikiami per 24 valandas nuo užsakymo pateikimo.

                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Ar reikės pasirašyti sutartį?
                            </div>
                            <div class='acor-body'>
                            Ne, jokių sutarčių pasirašyti nereikės. Į Jūsų el. paštą bus išsiųstas laiškas su visomis ekosistemos sąlygomis ir jei su jomis sutiksite, tuomet darbus pradėsime nuo išankstinės sąskaitos apmokėjimo.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Ką daryti, jei paslaugos netenkina mano lūkesčių?
                            </div>
                            <div class='acor-body'>
                            Darbai turi neribotus pataisymus, todėl visuomet galime pataisyti nepatikusias dizaino detales.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Kiek pataisymų galiu tikėtis?
                            </div>
                            <div class='acor-body'>
                            Tiek, kiek Jums prireiks. Pataisymus atliekame kuo įmanoma greičiau, vėliausiai pirmųjų pataisymų sulauksite per 12 valandų.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Kiek atliktų dizaino darbų gausiu per mėnesį?
                            </div>
                            <div class='acor-body'>
                            Dizaino darbų kiekis priklauso nuo Jūsų pasirinkitos Ekosistemos. 
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Kokiu būdu galiu sumokėti už paslaugas?
                            </div>
                            <div class='acor-body'>
                            Už paslaugas galite sumokėti bankiniu pavedimu į MB “Reklamos ekosistema” banko sąskaitą.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Kaip sužinosiu, kad mano planas baigiasi?
                            </div>
                            <div class='acor-body'>
                            Jūsų paskyroje yra nurodoma iki kada Jūsų planas galioja. Prieš pasibaigiant Jūsų planui, gausite pranešimą į el. paštą su išankstinę sąskaitą faktūrą. Norėdami pratęsti planą, Jūs sumokate plano mokesti. Jei nei vieno iš planų nenorite pratęsti, tuomet galite ignoruoti gauta pranešimą.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Ar suteikiate pinigų grąžinimą jei esu nepatenkintas jūsų paslaugomis?
                            </div>
                            <div class='acor-body'>
                            Ne, prieš pradedant darbus, Jūs sutinkate su Terminais ir Sąlygomis.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Kiek pirminių dizaino variantų gausiu pradėjus projektą?
                            </div>
                            <div class='acor-body'>
                            Norėdami gauti daugiau variantų, užsakymo užklausoje parašykite, jog norite gauti kelis dizaino variantus. Nepamirškite, jog daugiau variantų yra tolygu ilgesniam darbo laikui (projekto trukmė gali ilgėti).
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Ar galite atlikti daugiau dizaino darbų?
                            </div>
                            <div class='acor-body'>
                            Jei viršijote savo dizaino darbų kiekį per mėnesį, Jūs galite užsisakyti pavienius darbus už papildomai sutartą kainą. Jei taip nutinka, rekomenduojame kreiptis mūsų nurodytais kontaktais arba pokalbių sistemoje.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Kodėl mano projektas vyksta ilgiau, nei buvo numatyta?
                            </div>
                            <div class='acor-body'>
                            Tai gali įvykti dėl kelių priežasčių: <br>
                            1. Projekto užklausa buvo pateikta neaiškiai, todėl buvo įvykdytas pakartotinis kontaktas. <br>
                            2. Klientas pateikė prašymą atlikti projekto detalių pataisymus.<br>
                            3. Dizaineriui prireikus papildomos informacijos/detalių darbui atlikti, klientas užtruko atsakyti į užduotus klausimus.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Ar galiu redaguoti pateiktą užklausą? 
                            </div>
                            <div class='acor-body'>
                            Ne, tačiau norėdami pateikti papildomą komentarą, prašome susisiekti su mūsų atstovu.
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Ar man priklauso teisės į dizaino darbus?
                            </div>
                            <div class='acor-body'>
                            Taip, Jums priklauso visos teisės ir licencijos į pateiktą darbą. Tačiau, jei Jūs pateikiate nelicencijuotą medžiagą, mes negalime prisiimti atsakomybės už galutinį dizaino produktą. 
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            Ką daryti jei pamiršau užklausoje prisegti failus arba pateikti tam tikrą informaciją?
                            </div>
                            <div class='acor-body'>
                            Jei taip įvyko, prašome netrukus susisiekti naudojantis pokalbių sistema arba kitais nurodytais kontaktais.  
                            </div>
                        </div>
                   </div>     
                    <script>
                        $('.acor').click(function(){
                            if($(this).hasClass('active') == false)
                            {
                            $('.acor.active').removeClass('active');
                            $(this).addClass('active');
                            }
                            else{
                                $(this).removeClass('active'); 
                            }
                        });

                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@stop