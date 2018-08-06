This site was developed in Windows using IIS, so I will explain how to get it up and running in this environment.

In order to run this service, there are a few requirements:
- IIS must be running
- PHP must be allowed to run on the whole machine
- the server must be running a mysql server
- you must be connected to the internet

1. The Short folder must be placed into the directory "C:\inetpub\wwwroot"
2. The account on the mysql server account must be:
  username: "root"
  password: "LinkShortner"
  Otherwise, these details must be changed in the appropriate files:
  - indexScript.php
  - linkAnalytics.php
  - listScript.php
  - loginServer.php
  - r.php
3.a. Create the database LinkShortener using the "CREATE database LinkShortener;" in your mysql.
  b. Import the database in database.sql.
4. The service can now be used.

Everytime the service wants to be started, you must assure that the IIS service, the mysql server are running, and you are connected to the internet.
