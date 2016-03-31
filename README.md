# rootme_login
rootme_login est un script qui permet de se connecter à Root-me.org en ligne de commande. 
Cela est très utile si vous souhaitez vous connecter depuis un VPS.

La connexion n'affiche pas votre mot de passe dans votre console et le mot de passe est hashé avant de l'envoyer au serveur.

##How to use it
Simply download the script, you will need to have at least php cli installed.
```
wget "https://raw.githubusercontent.com/Thytrem/rootme_login/master/rootme_login.php"
```
Run the script and enter your credentials
```
php rootme_login.php
=======================================
# Root-me login script by NeedToLearn #
=======================================
Login : needtolearn
Password : 
[+] Login Success
[+] Connected to spip
Have a good fl4g !!!
```
You will probably need to wait a few seconds before trying to access any root-me's services.
