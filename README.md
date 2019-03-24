# Sentje

1) Als gebruiker wil ik meerdere rekeningen kunnen beheren (aanmaken,inzien,verwijderen) CHECK

2) Als gebruiker wil ik een betaalverzoek kunnen aanmaken en verwijderen als er nog geen betalingen hebben plaatsgevonden op het verzoek

3) Als gebruiker wil ik een betaalverzoek kunnen delen. suggestie: unieke link etc.

4) Als gebruiker wil ik een overzicht van bekende personen welke in (tijdelijke) groepen ingedeeld kunnen worden (handig tijdens een etentje) ?

5) Als gebruiker wil ik anderen geld laten doneren (en/of zelf laten bepalen welk bedrag diegene overmaakt) tip: bunq.me

6) Als gebruiker wil ik mijn rekening overzicht exporteren en extern opslaan (google drive/dropbox of vergelijkbaar) Opslag in platte tekst (JSON, CSV)

7) Als gebruiker wil ik met intervallen betalingen uitvoeren/inplannen. Dit betekent dat je een ‘kalender’ functie in je app krijgt waarin je de verschillende betalingen kan inplannen. Afhankelijk van je instellingen (internationaal) kan de kalender er anders uit zien.

8) Een betaling moet minimaal de volgende informatie bevatten: Tijdstip, persoon, beschrijving, bedrag, valuta (optioneel locatie).

9) Een betaling kan worden verrijkt met extra informatie zoals een notitie of een afbeelding (rekening)

10) Als gebruiker wil ik betalingen maken / ontvangen in andere valuta. De valuta is in stellen bij het betaalscherm en wordt na betaling omgerekend naar Euro’s. Bonuspunten voor een koppeling met een valuta converter service.

11) Als gebruiker wil ik dat mijn wachtwoord, rekeningen en gegevens beveiligd zijn CHECK

12) i18n, l10n TOEKOMSTIGE TEKST MOET NOG

--

Yoran: 2, 3, 5, 7, 8, 9

Simon: /1, 4, 6, 10, /11, 12

DONE: 1 - 11 - 12

--

composer update ( php composer.phar update, maybe )

php artisan migrate:fresh

php artisan db:seed

--

henk.janssen@email.com

password