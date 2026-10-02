<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-body">
            <div class="components-preview wide-xl mx-auto">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title"><?= getlang('manual'); ?></h3>
                                    <div class="nk-block-des text-soft">
                                    </div>
                                </div>
                                <div class="nk-block-head-content">
                                    <div class="toggle-wrap nk-block-tools-toggle">
                                        <!-- <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                            data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                                        <div class="toggle-expand-content" data-content="pageMenu">
                                            <ul class="nk-block-tools g-3">

                                                <li class="nk-block-tools-opt d-block d-sm-none">
                                                    <a href="#" class="btn btn-icon btn-primary"><em
                                                            class="icon ni ni-plus"></em></a>
                                                </li>
                                            </ul>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner cooke_manl">
                            <h2>Belangerijke informatie</h2>
                            <p>Voor elke website / webshop eigenaar is kennis van de AVG / GDPR vereist.</p>
                            <h3>Algemene informatie</h3>
                            <p>Het is niet toegestaan om persoonlijke gegevens van bezoekers te verzamelen alsvorens zij
                                hiervoor
                                toestemming hebben gegeven via bijvoorbeeld een cookie acceptatie popup. Veel diensten
                                verzamelen
                                bijvoorbeeld ipaddressen (Denk bv. aan Youtube, Zendesk chat, Google Analytics, Facebook
                                pixels, etc.)
                                en deze data wordt gezien als persoonsgegevens. Voor sommige diensten zoals Google
                                Analytics is het
                                mogelijk ipaddressen te masken m.b.v. een ip anonymizer tag, waardoor de laatse cijfers
                                van het ipadres
                                niet worden meegestuurd. Zo is het mogelijk correcte analytische data te verzamelen
                                zonder dat het
                                persoonsgebonden data verstuurd naar de desbetreffende dienst. De meeste diensten
                                ondersteunen dit niet
                                standaard, wel zijn er diensten zoals Zendesk die aanvullende apps of instellingen
                                aanbieden voor hun
                                diensten. Deze instellingen of apps moet je vaak wel zelf activeren, iets wat veel
                                gebruikers niet
                                weten. Controleer daarom altijd het privacybeleid / cookiebeleid van third-party
                                diensten. Voor alle
                                andere third-party diensten die data verzamelen is toestemming noodzakelijk via bv. een
                                acceptatie
                                popup. Via de cookie instellingen (Script manager) is het mogelijk om deze third-party
                                plugins / scripts
                                pas in te laden wanneer de bezoeker toestemming heeft gegeven in de acceptatie popup.
                            </p>
                            <h3>iFrames correct inladen</h3>
                            <p>iFrames kunnen cookies plaatsen. Denk bijvoorbeeld aan Youtube of andere ingeladen
                                snippets zoals een
                                timeline van Facebook. Deze partijen verzamelen (vaak analytische data) van gebruikers
                                die hun diensten
                                gebruiken (ook via iFrames). Deze frames kunnen mogelijk het ipadres opslaan van de
                                gebruiker en mogen
                                daarom enkel ingeladen worden wanneer de bezoeker deze cookies accepteert. Om deze
                                iframes pas in te
                                laden wanneer de gebruiker de cookies heeft geaccepteerd, is het noodzakelijk een
                                aanvullende div class
                                voor en na de iframe te plaatsen. Hieronder vind je een voorbeeld van zo'n iFrame. Weet
                                je niet zeker of
                                jouw iFrame voldoet aan de regelgeving? Raadpleeg dan de privacy policy van de
                                (third-party) aanbieder
                                van de desbetreffende dienst / iframe (ook wel insluitcodes genoemt).</p>
                            <p><b>Voorbeeld code:</b></p>
                            <p>Deze code wordt enkel ingeladen wanneer de cookies geaccepteerd zijn in de acceptatie
                                popup. Deze
                                codes worden 'inline' gebruikt. Dat betekend dat je deze op elke type pagina zelf
                                kunt inladen,
                                bijvoorbeeld op een tekstuele pagina of lander.</p>
                            <div>
                                <pre>
                             <&zwj;div class="casts_img">
                             <&zwj;iframe class="vid" src="https://www.youtube.com/embed/....." width="" height="" frameborder="0"
                              allowfullscreen="allowfullscreen"><&zwj;/iframe>
                             <&zwj;/div>
                           </pre>
                            </div>
                            <h3>Correct scripts inladen / informatie voor marketiers</h3>
                            <p>Zoals eerder op deze pagina uitgelegd is het inladen van bepaalde scripts voor
                                acceptatie toegestaan
                                als deze gebruik maken van bv. ip anonymize. Third-party scripts die hier geen
                                gebruik van maken
                                moeten ingeladen worden via de script manager zodat deze enkel ingeladen worden na
                                het accepteren
                                van cookies. Veel marketiers maken gebruik van Google tagmanager om dit te doen.
                                Google tagmanager
                                functioneert dan als script manager. Het inladen van third-party scripts die niet
                                gebruik maken van
                                ip anonymize maar wel ingeladen worden via tag manager zullen dus wel ingeladen
                                worden zonder
                                acceptatie van de cookies. Dit kan tegen de regels zijn. Om de cookie acceptatie
                                popup te laten
                                werken met tagmanager is een aanvullende maatwerk integratie noodzakelijk.</p>

                            <h3>Cookies documenteren</h3>
                            <p>Het is verplicht de cookies te documenteren en te vertellen aan je bezoekers welke
                                diensten je inlaad
                                op je website. Op het internet zijn veel cookie-scanners die je website kunnen
                                scannen op cookies en
                                een lijst aanbieden van de gevonden cookies met documentatie. Hoewel deze cookie
                                scanners vaak niet
                                alle cookies vinden, wordt er vaak wel een groot deel gevonden waardoor het veel
                                documentatie werk
                                uit handen kan nemen. Via het menu cookies documenteren kun je per cookie een tab
                                aanmaken en de
                                informatie over de cookies plaatsen. Mocht je niet weten wat een cookie precies
                                doet, dan kun je de
                                werking van de cookie vaak opvragen via <a href="https://cookiedatabase.org"
                                    target="_blank">cookiedatabase.org</a> of via de developer.</p>

                            <h3>Cookiebeleid opstellen</h3>
                            <p>Via het menu Cookiebeleid pagina kan er een cookiebeleid worden aangemaakt die direct
                                gekoppeld is
                                met de acceptatie popup. Let op dat je zowel een privacy policy pagina nodig hebt en
                                een
                                cookiebeleid wanneer je een website runt. Webshops dienen ook algemene voorwaarden
                                op hun website te
                                plaatsen. Veel website eigenaren maken gebruik van kant-en-klare templates voor deze
                                pagina's. Dat
                                hoeft niet perse fout te zijn, laat echter altijd je pagina's goed controleren door
                                iemand die de
                                wet kent (Bijvoorbeeld een jurist). De cookiebeleid pagina bevat al een standaard
                                basistekst die
                                automatisch wordt aangevuld met de gedocumenteerde cookies in een tabweergave.</p>

                            <h3>Verzamelen gegevens via formulieren</h3>
                            <p>Wanneer een bezoeker een formulier invult of zich aanmeld voor bijvoorbeeld een
                                dienst of account,
                                dient de bezoeker akkoord te gaan met de privacy policy van de website. Vermeld deze
                                daarom altijd
                                bij aanmeldformulieren, contactformulieren, etc. de privacy policy die in een nieuw
                                venster linkt
                                naar het desbetreffende document. (Het is aan te raden dat de gebruiker ook moet
                                aanvinken dat
                                hij/zij het beleid gelezen is alsvorens de bezoeker het formulier kan indienen).</p>

                            <h3>Acceptatie popup wijzigen</h3>
                            <p>Via het menu cookie melding is het mogelijk je cookie acceptatie popup te voorzien
                                van een eigen
                                tekst. De styling van deze melding kan alleen aangepast worden door ontwikkelaars.
                            </p>

                            <h3>Tot slot</h3>
                            <p>Veel website eigenaren laden toch scripts in voor acceptatie omdat het voor hun
                                strikt noodzakelijk
                                is voor hun dienstverlening of omdat ze anders geen correcte data kunnen toepassen
                                op bv.
                                advertenties. Het advies is toch te kiezen voor het correct inladen van de scripts.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>