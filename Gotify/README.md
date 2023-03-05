# Gotify

### 1. Konfiguration

| Name                     | Typ       | Beschreibung                         |
| :----------------------: | :-------: | :----------------------------------: |
| Server URL               | string    | URL des Gotify-Servers               |
| Application Token        | string    | App-Token zur Authentifizierung      |

### 2. Funktionsreferenz

#### Nachricht senden
`boolean GOTIFY_SendMessage(integer $InstanzID, string $title, string $message, integer $priority);`  
sendet eine Nachricht bestehend aus einem Titel und dem Nachrichtentext. Der Parameter $priority ist optional. Mehr Infos können in der [API-Dokumentation](https://gotify.net/api-docs#/message/createMessage) gefunden werden.

Beispiel:
```php
GOTIFY_SendMessage(12345, 'Der Titel', 'Eine Nachricht mit vielen Worten.', 0);
```

#### Bild senden
`boolean GOTIFY_SendMessage(integer $InstanzID, string $title, int $imageId, integer $priority, string $notificationUrl);`  
sendet eine Nachricht bestehend aus einem Titel und dem angegebenen Bild (die ImageID kann auf eine Instanz vom Typ "Media/Bild" oder "ImageGrabber" verweisen). Die Parameter $priority und $notificationUrl sind optional. Letzterer definiert eine URL die beim Klick auf die Notification aufgerufen werden soll. Mehr Infos können in der [API-Dokumentation](https://gotify.net/api-docs#/message/createMessage) gefunden werden.

Beispiel:
```php
GOTIFY_SendImage(12345, 'Der Titel', 67890, 0, null);
```

#### Bild via URL senden
`boolean GOTIFY_SendMessage(integer $InstanzID, string $title, string $url, integer $priority, string $notificationUrl);`  
sendet eine Nachricht bestehend aus einem Titel und dem verlinkten Bild. Die Parameter $priority und $notificationUrl sind optional. Letzterer definiert eine URL die beim Klick auf die Notification aufgerufen werden soll. Mehr Infos können in der [API-Dokumentation](https://gotify.net/api-docs#/message/createMessage) gefunden werden.

Beispiel:
```php
GOTIFY_SendImageFromUrl(12345, 'Der Titel', 'Eine Nachricht mit vielen Worten.', 0);
```

#### Nachricht mit Extras senden
`boolean GOTIFY_SendMessageWithExtras(integer $InstanzID, string $title, string $message, integer $priority, array $extras);`  
erweitert die Nachricht die sogenannten Extras. Wie diese anzuwenden sind kann [hier](https://gotify.net/docs/msgextras) nachgelesen werden.
Das Format des Parameters muss ein string-indiziertes, multidimensionales Array sein.

Beispiel:
```php
GOTIFY_SendMessageWithExtras(12345, 'Der Titel', 'Eine Nachricht mit vielen Worten.', 0, array("client::display" => array("contentType" => "text/plain")));
```

#### Testnachricht senden
`boolen GOTIFY_SendTestMessage(integer $InstanzID);`  
sendet eine vordefinierte Testnachricht mit Priorität 0. Diese Funktion wird auf der Konfigurationsseite vom Button "Sende Testnachricht" verwendet.