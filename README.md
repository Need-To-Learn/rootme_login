# rootme_login
rootme_login is a script wich allow you to login into Root-me.org using only your terminal.
Its very useful if you want to access challenges from your VPS.

The script doesn't print your password on the screen and it encrypts the password before sending it to the server.

##How to use it
Simply download the script, you will need to have at least php cli installed.
```
wget "https://raw.githubusercontent.com/Thytrem/rootme_login/master/rootme_login.php"
```
If its not done, you will need to install curl for php
```
sudo apt-get install php5-curl
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

Ps : only tested on php5.6

```
ssh -p 2222 app-script-ch11@challenge01.root-me.org
                 _    
 _ __ ___   ___ | |_       _ __ ___   ___    ___  _ __ __ _ 
| '__/ _ \ / _ \| __| ___ | '_ ` _ \ / _ \  / _ \| '__/ _` |
| | | (_) | (_) | |__|___|| | | | | |  __/_| (_) | | | (_| |
|_|  \___/ \___/ \__|     |_| |_| |_|\___(_)\___/|_|  \__, |
                                                      |___/ 

app-script-ch11@challenge01.root-me.org's password:
```
And voilà !
