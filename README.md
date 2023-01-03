# FREE BLOGGING

est un back-end en REST pour un blog compatible avec l'hébergement des pages perso de l'opérateur français [FREE][100]

## L'environnement 

1; le serveur fournit un php en 5.6.34

1. ils nous offre nombres de variables prédéfinies par le serveur, que je n'ai pas encore réussit à configurer dans mon serveur de test, je ne suis pas encore un gourout PHP.

1. une configuration proche est disponible dans le fichier free_blogging.ini.
Il vous est cependant inutile de vous torturer à l'utiliser car vous pourrez faire les modifications 
des appels de fonctions désactivées avant l'upload.

1. Je publirais une distribution contenant tout, y comprit ce que l'ont trouve dans le dossier vendor.
	J'ai crée une abstraction supplémentaire que je compte bien ajouter directement à une version de symfony.

Avouez que ce serait moins amusant si il n'y avait pas un peu de challenge.:stuck_out_tongue_winking_eye:
### Contraintes

l'environement server n'est pas modifiable

<details>
 <summary> les fonctions php suivantes sont bloquées : </summary>
 
| -                | -                    | -                | -                     |
| :---:            | :---:                | :---:            | :---:                 |
| chown            | chmod                | get_current_user | php_uname             |
| putenv           | set_time_limit       | getmyuid         | getmypid              |
| dl               | ini_alter            | ini_restore      | realpath              |
| tmpfile          | link                 | shell_exec       | proc_open             |
| chroot           | sleep                | usleep           | umask                 |
| set_include_path | restore_include_path | ini_set          | exec                  |
| passthru         | system               | popen            | pclose                |
| leak             | mysql_list_dbs       | listen           | chgrp                 |
| disk_total_space | disk_free_space      | rmdir            | openlog               |
| closelog         | syslog               | flock            | socket_create_listen  |
| socket_accept    | socket_listen        | symlink          | setlocale             |
| imagerotate      | -                    | -                | -                     |

[Source dans les pages d'aides de FREE][101]
</details>
<details><summary>  problème de POST </summary>
    Il est impossible d'utiliser les requêtes POST en RAW (donc pas de corps en Json).
Celà provoque l'affichage d'une erreur serveur lié à la déprecation d'une fonctionnalitée de php.
Les autre requêtes GET, PUT, PATCH, DELETE ne sont pas affectées par ce problème qui n'est qu'une erreur de configuration du serveur, erreur pardonnable, les API REST n'étaient pas à la mode lors de la mise en ligne des serveurs.

celà pourrait être corrigé en ajoutant la ligne 
always_populate_raw_post_data = -1
dans le php.ini du serveur et un redémarrage.
Mais le esrvice de gestion des pages persos de FREE ne répond pas au demandes des utilisateurs on vas devoir se passer de cette solution.
</details>



## Framework

Notre petit outil de blogging utiliserat Symfony en 3.4 que vous pouvez trouver ici :<br />
plus précisément le symfony standard edition qui créer un projet symfony pré-configuré ce qui est bien pratique.
<br>
le site du framework est ici :
[pour son aide en ligne][1]


### Configuration du Framework 
Symfony Standard Edition est configuré avec les éléments suivants par défaut:

  * AppBundle  qui est le répertoire ou l'ont mettrat la majorité du code

  * Twig comme moteur de template ;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations activées pour tout.

  * **FrameworkBundle** - le coeur du Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] 
  	- Ajoute nombre d'outils facilitant le développement 
	la capacité de routage et de template par annotation

  * [**DoctrineBundle**][7] - support pour Doctrine ORM

  * [**TwigBundle**][8] - Moteur Twig template

  * [**SecurityBundle**][9] - Security Par l'intégration de Symfony security component
  
  * [**SwiftmailerBundle**][10] - Support de Swiftmailer, library pour l'envoi d'emails

  * [**MonologBundle**][11] - Monolog, library pour les log du framework

  * **WebProfilerBundle** (in dev/test env) - Ajoute du profiling et la tooolbar de débug

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev env) - Adds code generation
    capabilities

  * [**WebServerBundle**][14] (in dev env) - Adds commands for running applications using the PHP built-in web server

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component integration

Toutes les librairies et les bundles sont distribués sous les licences MIT ou BSD

<!-- liens Framework Symfony standard -->

[1]:  https://symfony.com/doc/3.4/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.4/doctrine.html
[8]:  https://symfony.com/doc/3.4/templating.html
[9]:  https://symfony.com/doc/3.4/security.html
[10]: https://symfony.com/doc/3.4/email.html
[11]: https://symfony.com/doc/3.4/logging.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
[14]: https://symfony.com/doc/current/setup/built_in_web_server.html

<!-- Mes liens -->

[100]: https://www.free.fr
[101]: https://assistance.free.fr/articles/pages-perso-php-et-fonctions-desactivees-chez-free-653


