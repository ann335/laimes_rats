![ROSME Logo](https://www.rosme.com/image/catalog/logo3.svg)

# Laimes Rats - ROSME

Interaktīva laimes rata aplikācija ar administrācijas paneli.

## Mapju struktūra
```
Laimes_rats/
    ├── php/          (index.php, admin.php, card.php, wheel_db.sql)
    ├── css/          (style.css, style_for_admin.css, style_for_cards.css)
    ├── js/           (script.js, script_for_admin.js)
    ├── img_for_cards/    (uzvaras karšu attēli - JPEG)
    ├── svg icons/        (sektoru ikonas - SVG)
    └── arrow/            (arrow.svg)
```

## Galvenās funkcijas

### Laimes rats
- 12 sektori ar tekstu VAI SVG ikonu
- Idle animācija (+30° → -15° cilpa)
- Varbūtību sistēma (weighted random)
- Konfetti efekts pie uzvaras
- Automātiska pāreja uz uzvaras karti

### Admin panelis
- Sektoru rediģēšana (nosaukums, kartes attēls, virsraksti, apraksts)
- Varbūtību kontrole (0-100%)
- Spinu skaita iestatījumi (1-100)
- Preview režīms

### Uzvaras karte
- Dinamisks saturs no DB
- Responsīvs dizains
- Restart poga

## Datubāze

**Tabula: `prizes`**
- Sektora dati: ID, title, image (SVG), image1 (karte)
- Kartes saturs: h1, h2, P (apraksts)
- probability (0-100%)

**Tabula: `wheel_settings`**
- spin_count (1-100 apgriezieni)



## Instalācija

---

## 1. Lejupielāde

1. Lejupielādē **visus projekta failus** no repozitorija vai zip arhīva.  
2. Pārliecinies, ka visi faili un mapes ir saglabāti vienā vietā, saglabājot to struktūru: 
``` 
Laimes_Rats/
    ├── php/
    ├── css/
    ├── js/
    ├── img_for_cards/
    ├── svg icons/
    ├── arrow/
```

## 2. Servera izvēle

Šim projektam nepieciešams lokāls PHP + MySQL serveris. Ieteicams izmantot:  

- **Serveris:** XAMPP  
- **Versija:** 7.2.34  
- **Darba vide:** Windows  
- **PHP rediģēšana:** Visual Studio Code (versija 1.109.2)

## 3. Servera palaišana

1. Instalē **XAMPP** (ja vēl nav instalēts).  
2. Palaid **XAMPP Control Panel**.  
3. Ieslēdz:  
- **Apache**  
- **MySQL**  
4. Pārliecinies, ka nav konfliktu ar citiem serveriem vai portiem.


## 4. Projekta ievietošana serverī

1. Atver XAMPP instalācijas mapi, parasti: 

`C:\xampp\`

2. Atver mapi **htdocs**: 

`C:\xampp\htdocs\`

3. Kopē visu projekta mapi `Laimes_Rats` uz **htdocs**: 

`C:\xampp\htdocs\Laimes_Rats\`

4. Pārbaudi, ka struktūra saglabāta, piemēram: 
``` 
htdocs/
└── Laimes_Rats/
        ├── php/
        ├── css/
        ├── js/
        ├── img_for_cards/
        ├── svg icons/
        ├── arrow/
```

## 5. Projekta palaišana
Atver pārlūkprogrammu un dodies uz galveno lapu:
http://localhost/Laimes_Rats/php/index.php

Lai piekļūtu administrācijas panelim:
http://localhost/Laimes_Rats/php/admin.php

## 6. Rediģēšana un apskate
Visus PHP, CSS un JS failus var apskatīt un rediģēt ar Visual Studio Code.


## 7. Konfigurācija

1. Atver **PHP failus**, kas izmanto datubāzi (`index.php`, `admin.php`, utt.)  
2. Ja vajag rediģēq **DB kredenciālus**, lai tie atbilstu XAMPP iestatījumiem:  

```php
$host = 'localhost';
$db   = 'wheel_db'; 
$user = 'root';
$pass = ''; 
```
---

