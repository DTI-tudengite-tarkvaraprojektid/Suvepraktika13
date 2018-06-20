## Töökeskkonna Monitoorimise Seade

Link veebilehele: http://sisekliima.000webhostapp.com/login.php

### Eesmärk ja Lühikirjeldus
Projekti eesmärgiks oli luua töötav lahendus töökeskkonna monitoorimiseks. Seade tegeleb temperatuuri, niiskuse ja valgustiheduse mõõtmisega. Peale seda saadab andmed andmebaasi ning veebilehel kuvatakse näidud juba tabeli- ja graafikukujul. Graafikul on ka näha alampiire. Üle/alla mille näitavad peavad olema.
Projekt on loodud Digitehnoloogia Instituudi informaatika eriala esimese aasta Tarkvaraarenduse Praktika aine suvepraktika raames. 

### Tehnoloogiad
  * Alguses oli tihe koostöö Arduino IDE-ga(ver. 1.8.5), kus sai Arduino skeemile kirjutatud kood, mis hakkab tööle, kui seade tööle läheb.
  * Lõpuks oli vaja tekitada serveri pool, kuhu seade saaks andmeid saata.Selleks leidsime 000webhost-i, mis on tasuta serveri leht. Sealt saab faile ja ka serveri poolt hallata PHPMyAdmin-i kaudu

### Projekti panustajad
  * Katri Palo
  * Dennis Richard Šulga
  * Andre Martov 
  * Caspar Sepp
  * Alexander Lawrence
### Seadme käivitamine ja kasutamine
  * Esiteks on vaja Arduino IDE-s kood Node MCU-le (või muule Arduino skeemile) üles laadida. 
  * Seadme sisselülitamisel hakkab tal loop tööle ja hakkabki andmeid andmebaasi saatma.
  * Git-i repositooriumis olevad failid tuleb kuhugi serverisse panna, et saaks veebist ligi neile.
  * get_data leht on andmete kuvamine tabeli kujul, kust edasi saab üleval paiknevate nuppude abil navigeerida teistele lehtedele.
### Andmebaasi loomine
```
CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `ruum` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `temperatuur` float NOT NULL,
  `ohuniiskus` float NOT NULL,
  `valgus` int(11) NOT NULL
)
```
