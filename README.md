# PHP 2 Customer Management System Kompetenzcheck 

## Ziel:

Entwickle ein kleines Kundenverwaltungssystem für ein KMU (Klein- und Mittelunternehmen), das Überblick über seine KundInnendaten erhalten möchte. Die eingetragenen KundInnen sollen in der Datenbank abgespeichert werden, man muss die Daten bearbeiten und sich eine Übersicht der Einträge anzeigen lassen können. Nutze für die Verbindung zur Datenbank PDO.

## Anforderungen:

Die Tabellen sollen folgendermaßen aussehen:

- **users**: user_id, name, email, password
- **clients**: company_id, company_name, contact_person, phone, adress, created_by (welcher User hat den Eintrag erstellt), created_at (Erstelldatum), edited_at (Bearbeitungsdatum)

Relation: users 1 – n clients

## Features:

- User-Registrierung
- User-LogIn
- Anlegen von NeukundInnen über ein Kontaktformular
- Übersicht aller KundInnen
- Möglichkeit jeden Eintrag zu bearbeiten & zu löschen
- Eingeloggte User können alle Einträge im System sehen
- Eingeloggte User können nur die Einträge bearbeiten bzw. löschen, die sie auch selbst erstellt haben. (Tipp: Das könnt ihr mit einer Session lösen).

## Benutzeroberfläche:

Für die Benutzeroberfläche (GUI) verwendet bitte eines der CSS Frameworks aus dem Modul CSS Frameworks (Ja, so könnt ihr beide Kompetenzen miteinander abschließen 😉). Gestaltet das Kundenverwaltungssystem benutzerfreundlich! (gutes Userfeedback bei den Kontaktformularen, deutliche Hinweise, wenn etwas nicht geklappt hat, etc.) Achtet beim Styling auf gute Lesbarkeit, Farben, die nicht ablenken etc. Denkt auch an die Responsive Gestaltung des Tools & passt euer CSS dementsprechend an.

## Für Datenbank:

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS clients (
    company_id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(50) NOT NULL,
    contact_person VARCHAR(70),
    phone VARCHAR(20),
    address VARCHAR(100),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    edited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(user_id)
);

ALTER TABLE clients
MODIFY COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
MODIFY COLUMN edited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
