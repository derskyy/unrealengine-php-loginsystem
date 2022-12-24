# unrealengine-php-loginsystem
Simple Unreal Engine Login System which includes a simple User Information Webinterface, API for the Unreal Engine and Unreal Engine Project Files for the InGame Login.

This template is intended as an example only. I am not a professional when it comes to encryption etc., so there may be errors in the code. 
If you use parts of the code for your project you have to check the code yourself first. If you find any errors or similar, please let me know!

=
KNOWN ISSUES
- [API.php] "fetchPlayerData" returns "not logged in" for unkown reasons
- [dashboard.php] working fine, but it's not the final design
- [UNREAL] When register a new user (in the unreal engine), the email & password are working, the username isnt working -> VAREST Bug? ²
² Seems to be a issue with the JSON Object Node of VARest

=
FEATURES
- [GENERAL] Encrypted Passwords (hashed passwords with unique salt)
- [GENERAL] (Maybe) Secured against SQL Injections
- [WEB] PHP Website for basic User Informations (Login, Registration, Dashboard)
- [WEB] Registration Page
- [WEB] Login PHP Page
- [WEB] Logout Function (Dashboard)
- [DB] Two Database Tables (userdata for Passwords, Usernames, Emails) & (playerdata for coins, exp, lvl etc)
- [UNREAL] Main Menu UMG File with:
-----> Login Screen / Register Screen
-----> After Login the Game Menu gets unlocked
-----> User Information at the top (email, username, points, coins, level, exp)

=
REQUIREMENTS
- Unreal Engine 5.1+
- Unreal Engine 5.1 VARest Plugin (https://www.unrealengine.com/marketplace/en-US/product/varest-plugin)
- Webserver with for example PHPMyAdmin
- Webserver for the PHP Website files and / or the API for the Unreal Engine
- Basic know-how how to edit a Database
- Own Database (see next headline)

=
INSTALLATION 
1. Download everything as zip and extract it
2. Upload the PHP Folder to your webserver.

2.1 You only need the "API.php" for the unreal engine, if you wanna use the website, upload everything.
2.2 Replace your Database Name, Username, Password and the Host (localhost) with your data in the "config.php"

3. Create a database on your server and enter the login details (2.2) (and upload + import the included SQL File to your Database)
4. Open the Unreal Engine Project with the Unreal Engine 5.1 (or higher)

4.1 You need the VARest Plugin for your Unreal Engine Version
4.2 Go to Content>Blueprints> gm_mainmenu (GameMode Blueprint)

4.2.1 There you can find a red bubble with a Server URL Node. 
4.2.2 Insert in this variable your API Connection URL - e.g. => https://exp.defcongaming.de/api.php OR https://yourdomain123xyz.de/api.php

5. Play the Project in Editor or export the Project as exe (or for other platforms) - here you can create Accounts or login with your registered webaccount :)

