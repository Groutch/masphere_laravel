## Version en ligne :  
http://masphere2.herokuapp.com  
  
## Cahier des charges :  
Les documents se trouvent dans le dossier CDC  
  
## Modélisation :  
Se trouve dans les fichiers modelisation.png et modelisation.mwb (version mysql workbench)  
  
## Kanban :  
https://trello.com/b/CtDkLuqN/ma-phere  
  
## Journal de bord :  
Le journal de bord se trouve dans le fichier journal.MD  
  
## About the project

This project aims to allow artists and cultural professional technicians who have child.s to find professional childcare at atipic times. By the same way event organizers in Toulouse (for the begining) will have the opportunity to advertise their events. It's been developed with the PHP framework Laravel on a linux environment.

The website has 3 type of users.

### Organizers | This section is specifically designed for event organizers :
- They can from there see the list of the events they organize.
- They can add/delete/update events.

### Childcare pro | This section is specifically designed for childcare pro and they can navigate through 3 sections: research, dashboard, profil.
- research : from there they can search for events and sign up to warn that they can keep children for the duration of the performance.
- dashboard : here the users will find a summary of all the proposals they have posted.
- profil : users description and more informations (not in place for now).

### Artists and cultural professional technicians | They can navigate through 3 sections: research, dashboard, profil.
- research : from there they can search for events and sign up on proposals created by childcare professionals.
- dashboard : here the users will find a summary of all the proposals they have choosed.
- profil : users description and more informations (not in place for now).

## Installation

After having cloned/forked/downloaded the project:
- Create and setup a database
- Duplicate the .env.example file and rename it to .env
- Customise : DB_DATABASE | DB_USERNAME | DB_PASSWORD
- Run :<br />
    ```composer install```<br />
    ```php artisan key:generate```<br />
    ```php artisan migrate```<br />
    ```php artisan db:seed```<br />
    ```php artisan serve```<br />
