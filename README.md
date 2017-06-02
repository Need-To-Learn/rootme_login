# Root-me login
Root-me login is a script that allow you to login into root-me.org from the cli.
Its very useful if you want to access challenges from your VPS.

The script doesn't print your password on the screen and it encrypts the password before sending it to the server (with their old routine in js to send password before https was set).

## Dependencies
```
sudo apt install php php-curl
```

## Installation

Just download the script or clone the repository

```
wget "https://raw.githubusercontent.com/Thytrem/rootme_login/master/rootme_login.php"

or

git clone https://github.com/Need-To-Learn/rootme_login.git && cd rootme_login
```

Run the script and enter your credentials
```
php rootme_login.php
=======================================
# Root-me login script by NeedToLearn #
=======================================
Login : NeedToLearn
Password :
[+] Login Success
[+] Connected to spip
Don't forget to send me your flags in PM ;)
```

You will probably need to wait a few seconds before trying to access any root-me's services.

Ps : Works on php5.6 and 7.x

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
