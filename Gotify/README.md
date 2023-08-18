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
GOTIFY_SendMessage(12345, 'Der Titel', 'Eine Nachricht mit vielen Worten.', 3);
```

#### Nachricht mit Notification URL senden
`boolean GOTIFY_SendMessageWithNotificationUrl(integer $InstanzID, string $title, string $message, string $notificationUrl, integer $priority);`  
sendet eine Nachricht bestehend aus einem Titel und dem Nachrichtentext, sowie einer URL, die beim Klick auf die Notification aufgerufen werden soll. Der Parameter $priority ist optional. Mehr Infos können in der [API-Dokumentation](https://gotify.net/api-docs#/message/createMessage) gefunden werden.

Beispiel:
```php
GOTIFY_SendMessageWithNotificationUrl(12345, 'Der Titel', 'Eine eher unwichtige Nachricht.', "https://gotify.net", 0);
```

#### Bild senden
`boolean GOTIFY_SendImage(integer $InstanzID, string $title, string $message, int $imageId, string $imageDescription, integer $priority);`  
sendet eine Nachricht bestehend aus einem Titel, dem Nachrichtentext, dem angegebenen Bild (die ImageID muss auf eine Instanz vom Typ "Medien->Bild" verweisen) und einer Bildbeschreibung. Der Parameter $priority ist optional. Mehr Infos können in der [API-Dokumentation](https://gotify.net/api-docs#/message/createMessage) gefunden werden.

Beispiel:
```php
GOTIFY_SendImage(12345, 'Der Titel', 'Zusätzliche Infos zum Bild oder ähnliches', 67890, "Bildbeschreibung", 3);
```

#### Bild via URL senden
`boolean GOTIFY_SendImageFromUrl(integer $InstanzID, string $title, string $message, string $url, string $imageDescription, boolean $notificationImage, integer $priority);`  
sendet eine Nachricht bestehend aus einem Titel, dem Nachrichtentext, dem verlinkten Bild und einer Bildbeschreibung. Der Parameter $notificationImage definiert, ob die Bild-URL in der Notification gerendered werden soll. Der Parameter $priority ist optional. Mehr Infos können in der [API-Dokumentation](https://gotify.net/api-docs#/message/createMessage) gefunden werden.

Beispiel:
```php
GOTIFY_SendImageFromUrl(12345, 'Der Titel', 'Zusätzliche Infos zum Bild oder ähnliches', 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Example.jpg', "Bildbeschreibung", true, 3);
```

#### Nachricht mit Extras senden
`boolean GOTIFY_SendMessageWithExtras(integer $InstanzID, string $title, string $message, integer $priority, array $extras);`  
erweitert die Nachricht die sogenannten Extras. Wie diese anzuwenden sind kann [hier](https://gotify.net/docs/msgextras) nachgelesen werden.
Das Format des Parameters muss ein string-indiziertes, multidimensionales Array sein.

Beispiel:
```php
GOTIFY_SendMessageWithExtras(12345, 'Der Titel', 'Eine Nachricht mit vielen Worten.', 3, array("client::display" => array("contentType" => "text/plain")));
```

#### Testnachricht senden
`boolen GOTIFY_SendTestMessage(integer $InstanzID);`  
sendet eine vordefinierte Testnachricht mit Priorität 0. Diese Funktion wird auf der Konfigurationsseite vom Button "Sende Testnachricht" verwendet.
