# lambda
Ce projet permet de créer un nouveau projet PHP avec une structure pour organiser au mieux son projet.

## Getting started
Pour démarrer le projet vous devez avoir :

* PHP 5.6 (au minimum)
* Serveur apache

### Arborescence des fichiers :

**/app :** Dossier contenant les classes PHP<br>
**/assets :** Dossier contenant les librairies<br>
**/templates :** Dossier contenant les templates HTML

### Gérer les formulaires
Étapes d'exécution : Page HTML > Form.php > Class.php > Méthode de cette Class.php

```php
$login = new Form('lambda\Users', 'login', array_merge($_POST, array('editor' => 'username,password')), FALSE);
```

**(0)** = new Form(**(1)**, **(2)**, array_merge(**(3)**), **(4)**);

**(0)** = Nom du formulaire<br>
**(1)** = Classe à utiliser pour définir Class.php<br>
**(2)** = Méthode à utiliser de la classe<br>
**(3)** = Tableau PHP contenant toutes les données à transmettre au formulaire

array_merge(**(4)**, **(5)**, **(6)**)

**(5)** = Données $_POST<br>
**(6)** = Données $_FILES<br>
**(7)** = éléments du formulaire à sécuriser différement

array('editor' => '**(8)**,**(8)**')

**(8)** = nom des éléments HTML (séparés par une virgule)

**(4)** = Type du formulaire Ajax ou Post<br>
    Ajax = TRUE<br>
    POST = FALSE (par défault)


## Installation
* Clonez le projet dans votre répertoire
* Configurer le fichier [Autoload.php](https://github.com/maximeaudy/lambda/blob/master/app/Autoload.php)
  * Informations de la bdd
  * Lien du site
  * Nom de votre projet
