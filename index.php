<?php

/*
 * Include _Security
 */

include '_Security.php';
$Security = new Security;

// EN : Load class XSS FR : Charche la class XSS
$XSS = $Security->Load("XSS"); 
// EN : Writes a text with security FR : Ecrie le texte avec la securité
$XSS->Write("<script>alert('There is an XSS fault')</script>"); 

// EN : Load class Cookie FR : Charche la class Cookie
$Cookie = $Security->Load("Cookie"); 
// EN : Start Protection Cookie FR : Demarre la protection des Cookie
$Cookie->Start(); 
// EN : Return false if the cookie modified and true else not modified
// FR : Retourne false si le cookie a était modifier et true si le cookie na pas était modifier ou importé
$Cookie->Check(); 

 // EN : Load class CSRF FR : Charche la  class CSRF
$CSRF = $Security->Load("CSRF");
 // EN : Write <Input> hidden formulaire FR : Ecrie <Input> en cacher dans le formulaire
$CSRF->Formulaire();
// En : Return false or true FR : Retourne False ou True
$CSRF->Check();  


