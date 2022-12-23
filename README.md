# unrealengine-php-loginsystem
Simple Unreal Engine Login System which includes a simple User Information Webinterface, API for the Unreal Engine and Unreal Engine Project Files for the InGame Login.

This template is intended as an example only. I am not a professional when it comes to encryption etc., so there may be errors in the code. 
If you use parts of the code for your project you have to check the code yourself first. If you find any errors or similar, please let me know!

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
