<?php
session_start();  // Začátek session
session_unset();  // Odstranění všech session proměnných
session_destroy();  // Zničení session
header("Location: index.php");  // Přesměrování na hlavní stránku
exit();
