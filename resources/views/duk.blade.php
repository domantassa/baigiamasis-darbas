@extends('layouts.layout', ['user' => $user, 'users' => $users, 'notif' => $notif])

@section('content')

<!-- Hero -->
<div class="bg-body-light">
        <div class="content content-full pt-2" >
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h2 my-2 invisible" data-toggle="appear"
                data-class="animated fadeInUp"
                data-timeout="250"
                data-offset="-100">
                {{__('Dažnai užduodami klausimai')}}   </h1>
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
                            {{__('Kaip vyksta užsakymo procesas?')}}  
                            </div>
                            <div class='acor-body'>
                            1. {{__('Pasirenkate ar sukuriate sau tinkamą ekosistemos planą.')}} <br>
                            2. {{__('Pasirinkus tinkamiausią ekosistemą apmokate vieną mėnesį į priekį.')}}  <br>
                            3. {{__('Sėkminga Reklamos Ekosistemos auginimo pradžia.')}}  <br>
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Kaip vyksta darbo procesas?')}}  
                            </div>
                            <div class='acor-body'>
                            1. {{__('Pateikiate grafikos dizaino darbo užklausą mūsų platformoje.')}}   <br>
                            2. {{__('Per 24 valandas pateikiame pirmini darbo rezultatą. Juos rasite skiltyje “Mano failai”.')}}   <br>
                            3. {{__('Jei yra poreikis - pateikiate pataisymus, pasiekus norimą rezultatą darbas yra fiksuojamas užbaigtas. Pataisymus atliekame kuo įmanoma greičiau, vėliausiai pirmųjų pataisymų sulauksite per 12 valandų.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Per kiek laiko yra įvykdoma mano dizaino užklausa?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Pirmieji darbo rezultatai yra pateikiami per 24 valandas nuo užsakymo pateikimo.')}}  

                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Ar reikės pasirašyti sutartį?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Ne, jokių sutarčių pasirašyti nereikės. Į Jūsų el. paštą bus išsiųstas laiškas su visomis ekosistemos sąlygomis ir jei su jomis sutiksite, tuomet darbus pradėsime nuo išankstinės sąskaitos apmokėjimo.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Ką daryti, jei paslaugos netenkina mano lūkesčių?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Darbai turi neribotus pataisymus, todėl visuomet galime pataisyti nepatikusias dizaino detales.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Kiek pataisymų galiu tikėtis?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Tiek, kiek Jums prireiks. Pataisymus atliekame kuo įmanoma greičiau, vėliausiai pirmųjų pataisymų sulauksite per 12 valandų.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Kiek atliktų dizaino darbų gausiu per mėnesį?')}}
                            </div>
                            <div class='acor-body'>
                            {{__('Dizaino darbų kiekis priklauso nuo Jūsų pasirinkitos Ekosistemos.')}}   
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Kokiu būdu galiu sumokėti už paslaugas?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Už paslaugas galite sumokėti bankiniu pavedimu į MB “Reklamos ekosistema” banko sąskaitą.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Kaip sužinosiu, kad mano planas baigiasi?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Jūsų paskyroje yra nurodoma iki kada Jūsų planas galioja. Prieš pasibaigiant Jūsų planui, gausite pranešimą į el. paštą su išankstinę sąskaitą faktūrą. Norėdami pratęsti planą, Jūs sumokate plano mokesti. Jei nei vieno iš planų nenorite pratęsti, tuomet galite ignoruoti gauta pranešimą.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Ar suteikiate pinigų grąžinimą jei esu nepatenkintas jūsų paslaugomis?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Ne, prieš pradedant darbus, Jūs sutinkate su Terminais ir Sąlygomis.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Kiek pirminių dizaino variantų gausiu pradėjus projektą?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Norėdami gauti daugiau variantų, užsakymo užklausoje parašykite, jog norite gauti kelis dizaino variantus. Nepamirškite, jog daugiau variantų yra tolygu ilgesniam darbo laikui (projekto trukmė gali ilgėti).')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Ar galite atlikti daugiau dizaino darbų?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Jei viršijote savo dizaino darbų kiekį per mėnesį, Jūs galite užsisakyti pavienius darbus už papildomai sutartą kainą. Jei taip nutinka, rekomenduojame kreiptis mūsų nurodytais kontaktais arba pokalbių sistemoje.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Kodėl mano projektas vyksta ilgiau, nei buvo numatyta?')}}
                            </div>
                            <div class='acor-body'>
                            {{__('Tai gali įvykti dėl kelių priežasčių:')}} <br>
                            1. {{__('Projekto užklausa buvo pateikta neaiškiai, todėl buvo įvykdytas pakartotinis kontaktas.')}}   <br>
                            2. {{__('Klientas pateikė prašymą atlikti projekto detalių pataisymus.')}}  <br>
                            3. {{__('Dizaineriui prireikus papildomos informacijos/detalių darbui atlikti, klientas užtruko atsakyti į užduotus klausimus.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Ar galiu redaguoti pateiktą užklausą?')}}
                            </div>
                            <div class='acor-body'>
                            {{__('Ne, tačiau norėdami pateikti papildomą komentarą, prašome susisiekti su mūsų atstovu.')}}  
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Ar man priklauso teisės į dizaino darbus?')}}
                            </div>
                            <div class='acor-body'>
                            {{__('Taip, Jums priklauso visos teisės ir licencijos į pateiktą darbą. Tačiau, jei Jūs pateikiate nelicencijuotą medžiagą, mes negalime prisiimti atsakomybės už galutinį dizaino produktą.')}}   
                            </div>
                        </div>
                        <div class="acor btn-primary">
                            <div class='acor-title'>
                            {{__('Ką daryti jei pamiršau užklausoje prisegti failus arba pateikti tam tikrą informaciją?')}}  
                            </div>
                            <div class='acor-body'>
                            {{__('Jei taip įvyko, prašome netrukus susisiekti naudojantis pokalbių sistema arba kitais nurodytais kontaktais.')}}  
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