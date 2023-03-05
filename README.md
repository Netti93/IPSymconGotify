# Gotify

[![IPS-Version](https://img.shields.io/badge/Symcon_Version-5.3+-red.svg)](https://www.symcon.de/service/dokumentation/entwicklerbereich/sdk-tools/sdk-php/)
![Code](https://img.shields.io/badge/Code-PHP-blue.svg)
[![License](https://img.shields.io/badge/License-CC%20BY--NC--SA%204.0-green.svg)](https://creativecommons.org/licenses/by-nc-sa/4.0/)

### Inhaltsverzeichnis

1. [Funktionsumfang](#1-funktionsumfang)
2. [Vorraussetzungen](#2-vorraussetzungen)
3. [Software-Installation](#3-software-installation)
4. [Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
5. [Konfiguration](#5-konfiguration)
6. [PHP-Befehlsreferenz](#6-php-befehlsreferenz)
7. [Anhang](#7-anhang)
8. [Versionshistorie](#8-versionshistorie)

### 1. Funktionsumfang

* Das Modul ermöglicht das Senden von Benachrichtigungen via [Gotify](https://gotify.net).

### 2. Vorraussetzungen

- IP-Symcon ab Version 5.3  
(es wurde meinerseits jedoch nur ab Version 6.1 aufwärts getestet/genutzt)
- Ein von der IP-Symcon Instanz aus erreichbarer Gotify-Server ab Version 2.0.0  
(es wurde meinerseits jedoch nur ab Version 2.0.22 aufwärts getestet/genutzt)
- Ein gültiger App-Token von selbigem Gotify-Server

### 3. Software-Installation

* Über den Module Store das 'Gotify'-Modul installieren.
* Alternativ über das Module Control folgende URL hinzufügen:  
https://github.com/Netti93/IPSymconGotify

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' kann das 'Gotify'-Modul mithilfe des Schnellfilters gefunden werden.  
	- Weitere Informationen zum Hinzufügen von Instanzen in der [Dokumentation der Instanzen](https://www.symcon.de/service/dokumentation/konzepte/instanzen/#Instanz_hinzufügen)

### 5. Konfiguration

siehe [Modulbeschreibung](Gotify/README.md#1-konfiguration)

### 6. PHP-Befehlsreferenz

siehe [Modulbeschreibung](Gotify/README.md#2-funktionsreferenz)

### 7. Anhang

GUIDs

- Bibliothek: `{23DF70BD-570B-4CA9-1B85-4124A62C10DB}`
- Module:
  - Gotify: `{CB54965F-FAF7-A902-F9CA-606AB0614458}`

Verweise:
- https://gotify.net

### 8. Versionshistorie

- 1.0 @ 18.02.2022
  - Initiale Version
- 1.1 @ 01.03.2023
  - Fix für SendMessageWithExtras
- 1.2 @ 05.03.2023
  - SendImage und SendImageFromUrl hinzugefügt
