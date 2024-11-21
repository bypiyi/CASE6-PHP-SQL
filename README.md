# Case-PHP-MySQL-Template

Template to code PHP and MySQL. Make sure you have Docker Desktop appliaction installed and running.

Open terminal in this root folder, enter command:

`docker-desktop up`;

Application should start after a while - check errors. If errors indicate port conflicts, change the port in docker-compose.yml. You should only change the port outside (the number on the left side)


**8060**:80


Open a browser and visit:

`http://locahost://8060`# CASE6-PHP-SQL




<!-- ---------------------------- -->

Se till att du har igång Docker Desktop i bakgrunden.

Öppna terminalen och skriv in följande kommandon för att komma igång:

Tar bort allt lokalt från Docker: docker system prune

För att starta ett nytt projekt och få en docker-compose fil: docker-compose up

Klona ner git repot från: https://github.com/bypiyi/CASE6-PHP-SQL

Ange sedan denna adressen i din webbläsare för att komma igång: http://localhost:8060/setup.php

När du fått meddelandet "Database setup complete" gå då till startsidan för att börja: http://localhost:8060/index.php
