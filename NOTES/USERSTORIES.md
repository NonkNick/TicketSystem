## cards

Gebruiker registratie en bevestigingsmail
Omschrijving:

User Story: Als gebruiker wil ik mezelf kunnen registreren, zodat ik gebruik kan maken van het systeem.

Context: Voor toegang tot het systeem is het noodzakelijk dat gebruikers zich kunnen registreren. Dit zorgt ervoor dat we een beveiligde omgeving kunnen handhaven en alleen geautoriseerde personen toegang krijgen.

Acceptatiecriteria:

    Er is een registratiepagina beschikbaar voor gebruikers;

    Na succesvolle registratie ontvangt de gebruiker een bevestigingsmail.

Verwijderen van gebruikers door administrators
Omschrijving:

User Story: Als administrator wil ik gebruikers kunnen verwijderen, zodat de lijst up-to-date blijft.

Context: Er kunnen verschillende redenen zijn om een gebruiker te verwijderen, zoals beëindiging van het contract of een inactief account. Het is belangrijk om dit te kunnen doen om de gebruikerslijst actueel te houden.

Acceptatiecriteria:

    Een gebruiker moet verwijderd kunne worden vanaf de pagina met het overzicht van alle gebruikers;

    Het verwijderen moet worden bevestigd door de administrator;

    Als er nog niet afgehandelde tickets aan de gebruiker gekoppeld zijn, krijgt de administrator een melding en kan het account niet worden verwijderd.


Aanpassen van gebruikersinformatie door administrators
Omschrijving:

User Story: Als administrator wil ik een gebruiker aan kunnen passen, zodat ik eventuele fouten aan kan passen of onduidelijkheden kan wijzigen.

Context: Gegevens van gebruikers kunnen veranderen of er kunnen fouten zijn ingeslopen. Het is essentieel dat een administrator deze gegevens kan corrigeren.

Acceptatiecriteria:

    Er is een pagina beschikbaar waar een administrator de gegevens van een gebruiker kan aanpassen.



Inzicht in gebruikers van het systeem voor administrators
Omschrijving:

User Story: Als administrator wil ik graag weten wie er van mijn systeem gebruik maakt, zodat ik goed op de hoogte blijf.

Context: Voor beheer en controle is het noodzakelijk om te weten welke gebruikers toegang hebben tot het systeem. Deze informatie is enkel toegankelijk voor administrators.

Acceptatiecriteria:

    Er is een knop die leidt naar een pagina met een overzicht van alle gebruikers;

    De pagina met het overzicht van alle gebruikers is alleen toegankelijk voor administrators;

    Op de pagina staat een tabel met alle geregistreerde gebruikers van het systeem;

    Kolommen binnen de tabel zijn: Voornaam, Achternaam, E-mailadres, Rol, Telefoonnummer.


Verwijderen van notities door administrators
Omschrijving:

User Story: Als administrator wil ik een notitie kunnen verwijderen om irrelevante of foutieve informatie uit het systeem te halen.

Context: Er kunnen situaties zijn waarin een notitie niet langer relevant of correct is en daarom verwijderd moet worden. Alleen administrators hebben deze bevoegdheid.

Acceptatiecriteria:

    Alleen administrators kunnen een notitie verwijderen;

    Er is een mogelijkheid tot verwijderen naast elke notitie op de 'Weergeven'-pagina van een ticket;

    Na bevestiging van het verwijderen wordt de notitie uit het systeem verwijderd.


Aanpassen van notities door administrators
Omschrijving:

User Story: Als administrator wil ik een notitie kunnen aanpassen om eventuele fouten aan te passen of updates door te voeren.

Context: Het kan voorkomen dat er na het maken van een notitie aanvullende informatie of correcties nodig zijn. Daarom moet een administrator de mogelijkheid hebben om notities te bewerken.

Acceptatiecriteria:

    Het aanpassen van notities is alleen mogelijk voor administrators;

    Er is een mogelijkheid tot bewerken naast elke notitie op de 'Weergeven'-pagina van een ticket;

    Na het bewerken van de notitie wordt de aangepaste versie direct weergegeven.



Lezen van notities op tickets door administrators
Omschrijving:

User Story: Als administrator wil ik notities kunnen lezen, zodat ik weet wat er door andere administrators of mezelf genoteerd is.

Context: Om een compleet beeld te hebben van wat er speelt rond een ticket, is het belangrijk dat administrators de notities die bij dat ticket horen, kunnen lezen.

Acceptatiecriteria:

    Notities zijn alleen zichtbaar voor administrators;

    Notities zijn alleen te zien op de 'Weergeven'-pagina van een ticket;

    Notities zijn chronologisch gesorteerd op basis van het veld created_at.


Toevoegen van notities aan tickets door administrator
Omschrijving:

User Story: Als administrator wil ik graag notities aan een ticket kunnen toevoegen, zodat ik niks vergeet.

Context: Het is handig voor administrators om notities aan tickets toe te kunnen voegen. Dit is nuttig om belangrijke informatie of actiepunten te noteren en niets te vergeten tijdens het afhandelen van het ticket.

Acceptatiecriteria:

    Een notitie moet gekoppeld zijn aan een specifiek ticket en een specifieke gebruiker;

    Notities kunnen alleen worden aangemaakt door een administrator.


Tonen van reacties op ticket show-pagina
Omschrijving:

User Story: Als gebruiker wil ik de reacties kunnen lezen, zodat ik mijn probleem kan oplossen.

Context: Voor de gebruiker is het handig om zowel het ticket als de bijbehorende reacties op één plek in de applicatie te hebben, zodat deze het makkelijk kan vinden en opvolgen.

Acceptatiecriteria:

    De reacties worden getoond op de informatiepagina van het betreffende ticket.


Aanpassen van reacties door administrators
Omschrijving:

User Story: Als administrator wil ik een ticket kunnen aanpassen, zodat eventuele fouten er later uitgehaald kunnen worden.

Context: Het kan gebeuren dat een administrator na het toevoegen van een reactie een fout ontdekt. In dergelijke gevallen moet het mogelijk zijn om de reactie te corrigeren.

Acceptatiecriteria:

    Administrators moeten de mogelijkheid hebben om bestaande reacties  aan te passen.


Ticketbehandeling en notificaties door administrators
Omschrijving:

User Story: Als administrator wil ik een ticket kunnen afhandelen, zodat problemen bij de gebruikers opgelost kunnen worden.

Context: Een administrator moet in staat zijn om te reageren op tickets die zijn ingediend door gebruikers. Het is ook van belang dat de gebruiker op de hoogte wordt gebracht als er een antwoord is gegeven op diens ticket.

Acceptatiecriteria:

    Administrators moeten een reactie kunnen toevoegen aan elk ticket;

    De reactie wordt toegevoegd op de informatiepagina van het desbetreffende ticket;

    Zodra een reactie is toegevoegd, ontvangt de gebruiker een e-mailnotificatie.


Verwijderen van categorieën door administrators
Omschrijving:

User Story: Als administrator wil ik een categorie kunnen verwijderen, zodat ik categorieën die niet meer van toepassing zijn uit de lijst kan halen.

Context: Administrators moeten in staat zijn om onnodige of verouderde categorieën te verwijderen om het systeem overzichtelijk te houden.

Acceptatiecriteria:

    De optie om een categorie te verwijderen is beschikbaar vanaf de categorie-overzichtspagina;

    Een bevestigingsprompt verschijnt voordat de categorie daadwerkelijk wordt verwijderd;

    Als er nog tickets zijn die aan de te verwijderen categorie zijn gekoppeld, verschijnt er een melding en kan de categorie niet worden verwijderd.


Categorie aanpassen voor administrators
Omschrijving:

User Story: Als administrator wil ik een categorie aan kunnen passen, zodat ik eventuele fouten of onduidelijkheden kan wijzigen.

Context: Administrators moeten in staat zijn om bestaande categorieën te wijzigen voor een duidelijkere of meer accurate categorisering van tickets.

Acceptatiecriteria:

    Er is een aparte pagina waar een bestaande categorie kan worden aangepast;

    Deze pagina is alleen toegankelijk voor administrators.


Categorie aanmaken voor administrators
Omschrijving:

User Story: Als gebruiker wil ik een categorie aan kunnen maken, zodat ik een ticket kan categoriseren.

Context: Om het ticketbeheer zo efficiënt mogelijk te maken, moeten administrators in staat zijn om nieuwe categorieën toe te voegen wanneer dat nodig is.

Acceptatiecriteria:

    Er is een aparte pagina waar een nieuwe categorie kan worden aangemaakt;

    Deze pagina is alleen toegankelijk voor administrators.


Overzicht van alle categorieën voor administrators
Omschrijving:

User Story: Als administrator wil ik een overzicht van alle categorieën, zodat ik ze goed kan beheren.

Context: Voor efficiënt ticketbeheer is het nuttig om een overzicht te hebben van alle beschikbare categorieën. Dit helpt bij het categoriseren en het kiezen van wat prioriteit heeft.

Acceptatiecriteria:

    Er is een tabel aanwezig die alle categorieën toont, gesorteerd op alfabetische volgorde;

    De tabel heeft een kolom voor de titel van de categorie;

    Deze pagina is alleen toegankelijk voor administrators.


Wijzigen van ticket status door administrators
Omschrijving:

User Story: Als administrator wil ik de status van een ticket kunnen wijzigen.

Context: Het bijhouden van de ticketstatus is essentieel voor een efficiënte workflow. Er zijn drie mogelijke statussen: 'In afwachting', 'In behandeling', en 'Afgehandeld'.

Acceptatiecriteria:

    Op de informatiepagina van het ticket moet er een optie zijn om de status van het ticket te wijzigen;

    Alleen een administrator heeft de mogelijkheid om de status van een ticket te wijzigen.


Toewijzen van tickets aan administrators
Omschrijving:

User Story: Als administrator wil ik een ticket aan iemand kunnen toewijzen, zodat duidelijk is wie welke taak oppakt.

Context: Om te voorkomen dat meerdere mensen aan hetzelfde ticket werken, is het belangrijk dat tickets kunnen worden toegewezen aan een specifieke administrator.

Acceptatiecriteria:

    Op de detailpagina van het ticket is er een optie om het ticket toe te wijzen aan een administrator;

    Alleen administrators hebben de mogelijkheid om een ticket toe te wijzen;

    Administrators hebben ook de mogelijkheid om tickets aan zichzelf toe te wijzen;

    Tickets kunnen alleen worden toegewezen aan administrators.



Inzichtelijk maken van volledige ticketgegevens op één pagina
Omschrijving:

User Story: Als gebruiker wil ik alle gegevens met betrekking tot mijn ticket op één pagina inzichtelijk hebben, zodat ik hem goed kan volgen.

Context: Voor een goed overzicht en om een ticket en de bijbehorende antwoorden te kunnen beoordelen, is het belangrijk dat gebruikers en administrators de volledige informatie op één pagina kunnen zien.

Acceptatiecriteria:

    De mogelijkheid om vanaf de ticket-overzichtspagina door te klikken naar een pagina met informatie over een specifiek ticket;

    De hierboven genoemde specifieke pagina toont alle relevante informatie over het ticket, inclusief eventuele antwoorden en statusupdates.


Wijzigen van eigen tickets door gebruikers en administrators
Omschrijving:

User Story: Als gebruiker wil ik mijn ticket aan kunnen passen, zodat ik eventuele fouten of onduidelijkheden kan wijzigen.

Context: Het komt vaak voor dat gebruikers na het indienen van een ticket realiseren dat er fouten of onduidelijkheden in staan. Het is dus essentieel dat ze de mogelijkheid hebben om hun eigen tickets te wijzigen, tenzij het een administrator is die alle tickets kan wijzigen.

Acceptatiecriteria:

    Een aparte pagina binnen de applicatie waar het ticket kan worden aangepast;

    Alleen de gebruiker die het ticket heeft aangemaakt kan het aanpassen, tenzij het een administrator is die alle tickets kan wijzigen.


Aanmaken van nieuwe tickets door gebruikers
Omschrijving:

User Story: Als gebruiker wil ik een ticket aan kunnen maken, zodat ik een probleem kan melden waar ik ondersteuning bij nodig heb.

Context: Het is essentieel in een ICT-supportsysteem dat gebruikers gemakkelijk een nieuw ticket kunnen aanmaken om issues te rapporteren waarbij ze hulp nodig hebben.

Acceptatiecriteria:

    Er is een aparte pagina binnen de applicatie waar gebruikers een nieuw ticket kunnen aanmaken.  


Overzicht van alle vragen(tickets) voor gebruikers en administrators
Omschrijving:

User Story: Als gebruiker wil ik een overzicht van alle vragen(tickets), zodat ik een goed beeld heb van de actuele vragen.

Context: Een overzichtelijke tabel is nodig om alle tickets efficiënt te kunnen beheren en om het makkelijk te maken voor gebruikers en administrators om de status ervan te zien.

Acceptatiecriteria:

    Een tabel die alle tickets toont, chronologisch gesorteerd;

    De tabel bevat de volgende kolommen: ID, Titel, Categorieën, Status, Aangemaakt door, Aangemaakt op, Laatste update op, Toegewezen aan;

    Normale gebruikers zien alleen hun eigen tickets in het overzicht;

    Administrators hebben de mogelijkheid om alle tickets te zien.


Wachtwoordherstel voor vergeten wachtwoorden
Omschrijving:

User Story: Als gebruiker wil ik mijn wachtwoord kunnen veranderen wanneer ik het ben vergeten, zodat ik weer opnieuw toegang kan krijgen tot het systeem.

Context: Voor situaties waarin gebruikers hun wachtwoord vergeten, is een wachtwoordherstel-functie nodig om hun toegang tot het systeem te herstellen.

Acceptatiecriteria:

    Aanwezigheid van een pagina waar de gebruiker diens e-mailadres kan invullen;

    De gebruiker ontvangt een e-mail met daarin een link en een unieke token;

    Er is een pagina aanwezig waar de gebruiker een nieuw wachtwoord kan kiezen;

    Het nieuwe wachtwoord en de token worden op de backend gecontroleerd;

    Bij een succesvolle verificatie wordt de gebruiker doorgestuurd naar de inlogpagina;

    Bij een niet-succesvolle verificatie ontvangt de gebruiker een foutmelding.


Mogelijkheid tot uitloggen voor gebruikers
Omschrijving:

User Story: Als beheerder wil ik dat gebruikers kunnen uitloggen, zodat gebruikers zelf kunnen bepalen wanneer ze ingelogd zijn.

Context: Uitloggen is een belangrijk aspect van gebruikersbeheer en privacy. Het stelt gebruikers in staat om zelf te bepalen wanneer ze niet langer toegang hebben tot het systeem.

Acceptatiecriteria:

    Er is een 'Uitloggen'-knop beschikbaar binnen de applicatie;

    Klikken op de 'Uitloggen'-knop zorgt ervoor dat de gebruiker wordt uitgelogd en de sessie wordt beëindigd.



Verplichte authenticatie voor alle gebruikers
Omschrijving:

User Story: Als beheerder wil ik dat iedereen in moet loggen, zodat ik een veilige omgeving kan creëren voor klantgegevens.

Context: Authenticatie is cruciaal om de integriteit van het systeem en de veiligheid van klantgegevens te waarborgen. We moeten weten wie toegang heeft tot het systeem en welke rollen ze hebben.

Acceptatiecriteria:

    Seeder is geschreven die een 'admin'- en een 'user'-account toevoegt aan de database;

    Gebruikers moeten inloggen met behulp van hun e-mailadres en wachtwoord;

    Bij correcte inloggegevens wordt de gebruiker automatisch doorgestuurd naar het ticketoverzicht;

    Bij incorrecte inloggegevens wordt een foutmelding getoond aan de gebruiker.


Database opzetten met voorbeeldgegevens
Omschrijving:

User Story: Als developer wil ik een database met gegevens, zodat ik efficiënt mijn taken kan verwerken.

Context: Tijdens de ontwikkeling is het nuttig om een gevulde database te hebben. Dit helpt de developer beter te begrijpen hoe de applicatie zal werken met realistische data.

Acceptatiecriteria:

    Migraties zijn geschreven om de benodigde database tabellen die entiteiten representeren aan te maken;

    Seeders en factories zijn ontwikkeld om de database te vullen met voorbeeldgegevens.


Het maken van een flowchart
Omschrijving:

Doel:
Tijdens het ontwikkelen van het hulpportaal voor de klant dien je een flowchart te maken die de flow van het aanmaken van een ticket in kaart brengt. Dit kun je doen op een moment dat jij geschikt vindt: het maakt niet uit of het nu voor, tijdens of na de daadwerkelijke ontwikkeling is. Deze visualisatie helpt bij het begrijpen van de interactie tussen de frontend (Vue3 met een store) en de backend (Laravel API).

Instructies:

Kies een Tool: Gebruik een digitaal tekenprogramma zoals Draw.io, Lucidchart of pen en papier als je dat prettiger vindt.

Identificeer Hoofdcomponenten:

Vue Frontend:

    User Interface (UI) Componenten (bijv. Ticket Formulier)

    Store

        State 

        Getters

        Actions

Laravel Backend:

    Routes

    Controllers

    Modellen

    Responses

    Requests

    Database

Pijlen en Acties: Geef met pijlen aan hoe de data stroomt tussen deze componenten. Label elke pijl met de uitgevoerde actie, zoals 'Verzenden ticketinformatie naar API' of 'Koppel categorieën aan ticket via model'.

Toelichting: Voeg korte beschrijvingen toe om te verduidelijken wat er in elke stap gebeurt, met name hoe de frontend communiceert met de backend via de store en de Laravel-componenten.

Review: Controleer of de flowchart nauwkeurig de stappen weergeeft die worden doorlopen bij het aanmaken van een ticket in het hulpportaal voor de klant.

Beoordelingscriteria:

    Duidelijkheid: Is de flowchart makkelijk te volgen en begrijpen?

    Nauwkeurigheid: Komt het overeen met de daadwerkelijke code en flow van de applicatie?

    Volledigheid: Zijn alle relevante stappen en componenten inbegrepen?


Definitie en visualisatie van entiteiten voor ontwikkeling
Omschrijving:

User Story: Als developer wil ik duidelijk zien met welke entiteiten ik moet werken en deze vertaald zien in een databasediagram, zodat ik daar rekening mee kan houden.

Context: Voordat de ontwikkeling begint, is het belangrijk om duidelijk te hebben welke entiteiten er in de applicatie zullen zijn en hoe deze zich tot elkaar verhouden. Dit is cruciaal voor zowel de backend- als frontend-ontwikkeling. Een database diagram zal hierbij helpen voor een visueel overzicht.

Acceptatiecriteria:

    Er is een databasediagram gecreëerd waarin alle entiteiten en hun relaties zijn weergegeven.


Toolset bepalen voor klantenhulpportaal
Omschrijving:

User Story: Als developer wil ik weten welke tools ik moet gebruiken, zodat ik aan de eisen van de opdrachtgever kan voldoen.

Context: We hebben een opdracht gekregen van een ICT bedrijf om een klantenhulpportaal te ontwikkelen. Dit moet gerealiseerd worden binnen de Laravel- en Vue3-omgeving.

Acceptatiecriteria:

    Gebruik maken van Laravel/Vite als ontwikkelomgeving;

    De applicatie is gebouwd met Vue3;

    Gebruik van Vue-router voor client-side routing;

    Implementatie van een store factory, router- en Axios-façade;

    De applicatie is gekoppeld aan een git repository;

    Authenticatie is geregeld middels Sanctum.