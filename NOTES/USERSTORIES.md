# Klantenhulpportaal — User Stories

> Product backlog voor het ICT-klantenhulpportaal, te bouwen met **Laravel** (API) en **Vue 3** (frontend met store, router en Axios-façade).

## Inhoud

1. [Setup en Development](#setup-en-development)
2. [Authenticatie en Toegang](#authenticatie-en-toegang)
3. [Gebruikersbeheer](#gebruikersbeheer)
4. [Tickets](#tickets)
5. [Reacties](#reacties)
6. [Categorieën](#categorieën)
7. [Notities](#notities)

---

## Setup en Development

### Toolset bepalen voor klantenhulpportaal

> Als developer wil ik weten welke tools ik moet gebruiken, zodat ik aan de eisen van de opdrachtgever kan voldoen.

**Context:** We hebben een opdracht gekregen van een ICT-bedrijf om een klantenhulpportaal te ontwikkelen. Dit moet gerealiseerd worden binnen de Laravel- en Vue 3-omgeving.

**Acceptatiecriteria**

- Gebruikmaken van Laravel/Vite als ontwikkelomgeving
- De applicatie is gebouwd met Vue 3
- Gebruik van Vue Router voor client-side routing
- Implementatie van een store factory, router- en Axios-façade
- De applicatie is gekoppeld aan een Git-repository
- Authenticatie is geregeld middels Sanctum

### Definitie en visualisatie van entiteiten

> Als developer wil ik duidelijk zien met welke entiteiten ik moet werken en deze vertaald zien in een databasediagram, zodat ik daar rekening mee kan houden.

**Context:** Voordat de ontwikkeling begint, is het belangrijk om duidelijk te hebben welke entiteiten er in de applicatie zullen zijn en hoe deze zich tot elkaar verhouden. Dit is cruciaal voor zowel de backend- als frontend-ontwikkeling.

**Acceptatiecriteria**

- Er is een databasediagram gecreëerd waarin alle entiteiten en hun relaties zijn weergegeven

### Database opzetten met voorbeeldgegevens

> Als developer wil ik een database met gegevens, zodat ik efficiënt mijn taken kan verwerken.

**Context:** Tijdens de ontwikkeling is het nuttig om een gevulde database te hebben. Dit helpt de developer beter te begrijpen hoe de applicatie zal werken met realistische data.

**Acceptatiecriteria**

- Migraties zijn geschreven om de benodigde databasetabellen (die entiteiten representeren) aan te maken
- Seeders en factories zijn ontwikkeld om de database te vullen met voorbeeldgegevens

### Het maken van een flowchart

**Doel:** Maak tijdens het ontwikkelen van het hulpportaal een flowchart die de flow van het aanmaken van een ticket in kaart brengt (mag voor, tijdens of na de ontwikkeling). Deze visualisatie helpt bij het begrijpen van de interactie tussen de frontend (Vue 3 met store) en de backend (Laravel API).

**Te identificeren hoofdcomponenten**

- **Vue-frontend** — UI-componenten (bijv. ticketformulier) en de store (state, getters, actions)
- **Laravel-backend** — routes, controllers, modellen, requests, responses, database

**Instructies**

- Geef met pijlen aan hoe data tussen de componenten stroomt en label elke pijl met de uitgevoerde actie (bijv. "Verzend ticketinformatie naar API" of "Koppel categorieën aan ticket via model")
- Voeg korte beschrijvingen toe die verduidelijken wat er in elke stap gebeurt, met name hoe de frontend via de store met de Laravel-componenten communiceert
- Controleer of de flowchart de werkelijke stappen bij het aanmaken van een ticket nauwkeurig weergeeft

**Beoordelingscriteria**

- **Duidelijkheid** — is de flowchart makkelijk te volgen en te begrijpen?
- **Nauwkeurigheid** — komt het overeen met de daadwerkelijke code en flow van de applicatie?
- **Volledigheid** — zijn alle relevante stappen en componenten inbegrepen?

---

## Authenticatie en Toegang

### Verplichte authenticatie voor alle gebruikers

> Als beheerder wil ik dat iedereen in moet loggen, zodat ik een veilige omgeving kan creëren voor klantgegevens.

**Context:** Authenticatie is cruciaal om de integriteit van het systeem en de veiligheid van klantgegevens te waarborgen. We moeten weten wie toegang heeft tot het systeem en welke rollen zij hebben.

**Acceptatiecriteria**

- Er is een seeder die een 'admin'- en een 'user'-account aan de database toevoegt
- Gebruikers loggen in met hun e-mailadres en wachtwoord
- Bij correcte inloggegevens wordt de gebruiker automatisch doorgestuurd naar het ticketoverzicht
- Bij incorrecte inloggegevens wordt een foutmelding getoond

### Gebruikersregistratie en bevestigingsmail

> Als gebruiker wil ik mezelf kunnen registreren, zodat ik gebruik kan maken van het systeem.

**Context:** Voor toegang tot het systeem is het noodzakelijk dat gebruikers zich kunnen registreren. Zo houden we een beveiligde omgeving en krijgen alleen geautoriseerde personen toegang.

**Acceptatiecriteria**

- Er is een registratiepagina beschikbaar
- Na succesvolle registratie ontvangt de gebruiker een bevestigingsmail

### Mogelijkheid tot uitloggen

> Als beheerder wil ik dat gebruikers kunnen uitloggen, zodat zij zelf kunnen bepalen wanneer ze ingelogd zijn.

**Context:** Uitloggen is een belangrijk aspect van gebruikersbeheer en privacy. Het stelt gebruikers in staat zelf te bepalen wanneer ze niet langer toegang hebben tot het systeem.

**Acceptatiecriteria**

- Er is een 'Uitloggen'-knop beschikbaar binnen de applicatie
- Klikken op de knop logt de gebruiker uit en beëindigt de sessie

### Wachtwoordherstel voor vergeten wachtwoorden

> Als gebruiker wil ik mijn wachtwoord kunnen veranderen wanneer ik het ben vergeten, zodat ik weer toegang kan krijgen tot het systeem.

**Context:** Voor situaties waarin gebruikers hun wachtwoord vergeten, is een herstelfunctie nodig om hun toegang tot het systeem te herstellen.

**Acceptatiecriteria**

- Er is een pagina waar de gebruiker zijn e-mailadres kan invullen
- De gebruiker ontvangt een e-mail met een link en een unieke token
- Er is een pagina waar de gebruiker een nieuw wachtwoord kan kiezen
- Het nieuwe wachtwoord en de token worden op de backend gecontroleerd
- Bij een succesvolle verificatie wordt de gebruiker doorgestuurd naar de inlogpagina
- Bij een niet-succesvolle verificatie ontvangt de gebruiker een foutmelding

---

## Gebruikersbeheer

### Inzicht in gebruikers van het systeem

> Als administrator wil ik weten wie er van mijn systeem gebruikmaakt, zodat ik goed op de hoogte blijf.

**Context:** Voor beheer en controle is het noodzakelijk te weten welke gebruikers toegang hebben tot het systeem. Deze informatie is alleen toegankelijk voor administrators.

**Acceptatiecriteria**

- Er is een knop die leidt naar een pagina met een overzicht van alle gebruikers
- De overzichtspagina is alleen toegankelijk voor administrators
- Op de pagina staat een tabel met alle geregistreerde gebruikers van het systeem
- Kolommen: Voornaam, Achternaam, E-mailadres, Rol, Telefoonnummer

### Aanpassen van gebruikersinformatie

> Als administrator wil ik een gebruiker kunnen aanpassen, zodat ik fouten of onduidelijkheden kan wijzigen.

**Context:** Gegevens van gebruikers kunnen veranderen of er kunnen fouten ingeslopen zijn. Het is essentieel dat een administrator deze gegevens kan corrigeren.

**Acceptatiecriteria**

- Er is een pagina waar een administrator de gegevens van een gebruiker kan aanpassen

### Verwijderen van gebruikers

> Als administrator wil ik gebruikers kunnen verwijderen, zodat de lijst up-to-date blijft.

**Context:** Er kunnen verschillende redenen zijn om een gebruiker te verwijderen, zoals beëindiging van het contract of een inactief account. Het is belangrijk om de gebruikerslijst actueel te houden.

**Acceptatiecriteria**

- Een gebruiker kan verwijderd worden vanaf de overzichtspagina van alle gebruikers
- Het verwijderen moet door de administrator worden bevestigd
- Zijn er nog niet-afgehandelde tickets aan de gebruiker gekoppeld, dan krijgt de administrator een melding en kan het account niet worden verwijderd

---

## Tickets

### Aanmaken van nieuwe tickets

> Als gebruiker wil ik een ticket kunnen aanmaken, zodat ik een probleem kan melden waar ik ondersteuning bij nodig heb.

**Context:** Het is essentieel in een ICT-supportsysteem dat gebruikers eenvoudig een nieuw ticket kunnen aanmaken om issues te rapporteren waarbij ze hulp nodig hebben.

**Acceptatiecriteria**

- Er is een aparte pagina binnen de applicatie waar gebruikers een nieuw ticket kunnen aanmaken

### Overzicht van alle tickets

> Als gebruiker wil ik een overzicht van alle vragen (tickets), zodat ik een goed beeld heb van de actuele vragen.

**Context:** Een overzichtelijke tabel is nodig om alle tickets efficiënt te beheren en het voor gebruikers en administrators makkelijk te maken de status ervan te zien.

**Acceptatiecriteria**

- Een tabel die alle tickets toont, chronologisch gesorteerd
- Kolommen: ID, Titel, Categorieën, Status, Aangemaakt door, Aangemaakt op, Laatste update op, Toegewezen aan
- Normale gebruikers zien alleen hun eigen tickets in het overzicht
- Administrators kunnen alle tickets zien

### Volledige ticketgegevens op één pagina

> Als gebruiker wil ik alle gegevens van mijn ticket op één pagina inzichtelijk hebben, zodat ik het goed kan volgen.

**Context:** Voor een goed overzicht en om een ticket en de bijbehorende antwoorden te kunnen beoordelen, is het belangrijk dat gebruikers en administrators de volledige informatie op één pagina kunnen zien.

**Acceptatiecriteria**

- Vanaf de ticket-overzichtspagina kan worden doorgeklikt naar een pagina met informatie over een specifiek ticket
- Die pagina toont alle relevante informatie over het ticket, inclusief eventuele antwoorden en statusupdates

### Wijzigen van eigen tickets

> Als gebruiker wil ik mijn ticket kunnen aanpassen, zodat ik fouten of onduidelijkheden kan wijzigen.

**Context:** Gebruikers realiseren zich na het indienen soms dat er fouten of onduidelijkheden in een ticket staan. Daarom moeten zij hun eigen tickets kunnen wijzigen — tenzij het een administrator is, die alle tickets mag wijzigen.

**Acceptatiecriteria**

- Er is een aparte pagina binnen de applicatie waar het ticket kan worden aangepast
- Alleen de gebruiker die het ticket heeft aangemaakt kan het aanpassen, tenzij het een administrator is

### Wijzigen van ticketstatus

> Als administrator wil ik de status van een ticket kunnen wijzigen.

**Context:** Het bijhouden van de ticketstatus is essentieel voor een efficiënte workflow. Er zijn drie mogelijke statussen: *In afwachting*, *In behandeling* en *Afgehandeld*.

**Acceptatiecriteria**

- Op de informatiepagina van het ticket is er een optie om de status van het ticket te wijzigen
- Alleen een administrator kan de status van een ticket wijzigen

### Toewijzen van tickets

> Als administrator wil ik een ticket aan iemand kunnen toewijzen, zodat duidelijk is wie welke taak oppakt.

**Context:** Om te voorkomen dat meerdere mensen aan hetzelfde ticket werken, moeten tickets aan een specifieke administrator toegewezen kunnen worden.

**Acceptatiecriteria**

- Op de detailpagina van het ticket is er een optie om het ticket aan een administrator toe te wijzen
- Alleen administrators kunnen tickets toewijzen
- Administrators kunnen tickets ook aan zichzelf toewijzen
- Tickets kunnen alleen aan administrators worden toegewezen

---

## Reacties

### Ticketbehandeling en notificaties

> Als administrator wil ik een ticket kunnen afhandelen, zodat problemen bij gebruikers opgelost kunnen worden.

**Context:** Een administrator moet kunnen reageren op tickets die door gebruikers zijn ingediend. De gebruiker moet op de hoogte worden gebracht zodra er een antwoord op diens ticket is gegeven.

**Acceptatiecriteria**

- Administrators kunnen een reactie toevoegen aan elk ticket
- De reactie verschijnt op de informatiepagina van het betreffende ticket
- Zodra een reactie is toegevoegd, ontvangt de gebruiker een e-mailnotificatie

### Tonen van reacties

> Als gebruiker wil ik de reacties kunnen lezen, zodat ik mijn probleem kan oplossen.

**Context:** Het is handig om zowel het ticket als de bijbehorende reacties op één plek te hebben, zodat de gebruiker het makkelijk kan vinden en opvolgen.

**Acceptatiecriteria**

- De reacties worden getoond op de informatiepagina van het betreffende ticket

### Aanpassen van reacties

> Als administrator wil ik een reactie kunnen aanpassen, zodat eventuele fouten er later uitgehaald kunnen worden.

**Context:** Het kan gebeuren dat een administrator na het plaatsen van een reactie een fout ontdekt. In dergelijke gevallen moet het mogelijk zijn de reactie te corrigeren.

**Acceptatiecriteria**

- Administrators kunnen bestaande reacties aanpassen

---

## Categorieën

### Overzicht van alle categorieën

> Als administrator wil ik een overzicht van alle categorieën, zodat ik ze goed kan beheren.

**Context:** Voor efficiënt ticketbeheer is een overzicht van alle beschikbare categorieën nuttig. Dit helpt bij het categoriseren en het bepalen van prioriteiten.

**Acceptatiecriteria**

- Er is een tabel die alle categorieën toont, alfabetisch gesorteerd
- De tabel heeft een kolom voor de titel van de categorie
- Deze pagina is alleen toegankelijk voor administrators

### Categorie aanmaken

> Als administrator wil ik een categorie kunnen aanmaken, zodat tickets gecategoriseerd kunnen worden.

**Context:** Om het ticketbeheer zo efficiënt mogelijk te maken, moeten administrators nieuwe categorieën kunnen toevoegen wanneer dat nodig is.

**Acceptatiecriteria**

- Er is een aparte pagina waar een nieuwe categorie kan worden aangemaakt
- Deze pagina is alleen toegankelijk voor administrators

### Categorie aanpassen

> Als administrator wil ik een categorie kunnen aanpassen, zodat ik fouten of onduidelijkheden kan wijzigen.

**Context:** Administrators moeten bestaande categorieën kunnen wijzigen voor een duidelijkere of accuratere categorisering van tickets.

**Acceptatiecriteria**

- Er is een aparte pagina waar een bestaande categorie kan worden aangepast
- Deze pagina is alleen toegankelijk voor administrators

### Verwijderen van categorieën

> Als administrator wil ik een categorie kunnen verwijderen, zodat ik categorieën die niet meer van toepassing zijn uit de lijst kan halen.

**Context:** Administrators moeten onnodige of verouderde categorieën kunnen verwijderen om het systeem overzichtelijk te houden.

**Acceptatiecriteria**

- De optie om een categorie te verwijderen is beschikbaar vanaf de categorie-overzichtspagina
- Er verschijnt een bevestigingsprompt voordat de categorie daadwerkelijk wordt verwijderd
- Zijn er nog tickets aan de categorie gekoppeld, dan verschijnt een melding en kan de categorie niet worden verwijderd

---

## Notities

### Toevoegen van notities aan tickets

> Als administrator wil ik notities aan een ticket kunnen toevoegen, zodat ik niets vergeet.

**Context:** Het is handig voor administrators om notities aan tickets toe te voegen. Dit is nuttig om belangrijke informatie of actiepunten te noteren tijdens het afhandelen van het ticket.

**Acceptatiecriteria**

- Een notitie moet gekoppeld zijn aan een specifiek ticket en een specifieke gebruiker
- Notities kunnen alleen worden aangemaakt door een administrator

### Lezen van notities op tickets

> Als administrator wil ik notities kunnen lezen, zodat ik weet wat er door andere administrators of mezelf genoteerd is.

**Context:** Om een compleet beeld te hebben van wat er rond een ticket speelt, moeten administrators de bijbehorende notities kunnen lezen.

**Acceptatiecriteria**

- Notities zijn alleen zichtbaar voor administrators
- Notities zijn alleen te zien op de 'Weergeven'-pagina van een ticket
- Notities zijn chronologisch gesorteerd op basis van het veld `created_at`

### Aanpassen van notities

> Als administrator wil ik een notitie kunnen aanpassen, zodat ik fouten kan herstellen of updates kan doorvoeren.

**Context:** Na het maken van een notitie kunnen aanvullende informatie of correcties nodig zijn. Daarom moeten administrators notities kunnen bewerken.

**Acceptatiecriteria**

- Het aanpassen van notities is alleen mogelijk voor administrators
- Er is een bewerkmogelijkheid naast elke notitie op de 'Weergeven'-pagina van een ticket
- Na het bewerken wordt de aangepaste versie direct weergegeven

### Verwijderen van notities

> Als administrator wil ik een notitie kunnen verwijderen, zodat ik irrelevante of foutieve informatie uit het systeem kan halen.

**Context:** Een notitie kan niet langer relevant of correct zijn en moet dan verwijderd kunnen worden. Alleen administrators hebben deze bevoegdheid.

**Acceptatiecriteria**

- Alleen administrators kunnen een notitie verwijderen
- Er is een verwijdermogelijkheid naast elke notitie op de 'Weergeven'-pagina van een ticket
- Na bevestiging wordt de notitie uit het systeem verwijderd