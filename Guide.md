# Installation and Deployment

Download and install XAMPP from [apachefriends.org](https://www.apachefriends.org/download.html).  We highly recommend any version 8.1.x, which is equivalent to the PHP version originally used to develop the application.  You may find that other versions work without issues, but we cannot promise compatibility.  The XAMPP version used in this guide is 8.1.17.  The process should be equivalent on any platform, but we're using Windows for the purpose of this explanation.  Not all of the default XAMPP packages shown in the setup wizard are required.  Only the following are necessary:

- Apache
- MySQL
- PHP
- phpMyAdmin

Download the source code for PC Life from [GitHub](https://github.com/drand808/PC-Life/tags).  Place the contents of the repository into your installation directory for XAMPP (such that if XAMPP is installed at `C:\xampp`, then `C:\xampp\reuleaux.dev` should exist).  Do not overwrite the contents of `htdocs`.  If there are any conflicts, keep the existing files.

Run the XAMPP Control Panel and click the `Config` button in line with `Apache`.  In the dropdown, select `Apache (httpd.conf)`.  Search for any instance of `htdocs`, and replace it with `reuleaux.dev`.  In the version used for this guide, this occurs at lines 252 and 253.

```apacheconf
251 | ...
252 | DocumentRoot "C:/xampp/htdocs"
253 | <Directory "C:/xampp/htdocs">
254 | ...
```

becomes

```apacheconf
251 | ...
252 | DocumentRoot "C:/xampp/reuleaux.dev"
253 | <Directory "C:/xampp/reuleaux.dev">
254 | ...
```

In the same file, replace all instances of 80 with a unique port[^1] that isn't in use.  If you use port 80, especially on a shared network, Apache will not start.  This should occur at lines 60 and 228.

```apacheconf
 59 | ...
 60 | Listen 80
... | ...
228 | ServerName localhost:80
229 | ...
```

becomes

```apacheconf
 59 | ...
 60 | Listen 12345
... | ...
228 | ServerName localhost:12345
229 | ...
```

Save this file and go back to the main XAMPP window.  Now, click the same configuration button as before, and select `Apache (httpd-ssl.conf)`.  Replace all instances of `443` with yet another port number (e.g. `23456`).  Save this file and close it.

Open `C:\xampp\reuleaux.dev\php\website.php`.  Delete the contents of the file, and replace it with `https://localhost:` followed by your SSL port number (e.g. `https://localhost:23456`).  You can also use the non-SSL version if you wish to use HTTP instead of HTTPS (e.g. `http://localhost:12345`).

Click `Start` next to Apache in the main XAMPP window.  The home page should load.  However, if you try to click anything that requests the database, you will receive an error.

Open your browser of choice, and enter `localhost:` followed by your port number into the URL (e.g. `localhost:12345`).  You should now be able to view the website running on your local machine.

### Ease of Use Recommendation

We highly recommend changing the default text editor.  You can do this by opening XAMPP, clicking on the `Config` button and selecting a new editor application.  Our recommendation of Notepad++ is typically installed at `C:\Program Files\Notepad++\notepad++.exe`.[^2]

### Note to Windows users

You should install XAMPP in a folder without restricted write permissions.  It is advised *against* installing the program in `C:\Program Files`, `C:\Program Files (x86)`, or any equivalent.  Instead, we recommend the root directory of a drive, such as `C:\xampp` or `D:\xampp`.  Your `C:\Users\{USER}\AppData\Local` folder may also be suitable.

### Database

Note that we have not provided instructions on how to set up a copy of the database.[^3]  This process that would take a significant amount of time.  We can come back and write that as needed.

[^1]: Your port should be within the range of 1024 to 65535.  Ports below 1024 are used by common services and you will likely run into conflicts.

[^2]: In Windows, the XAMPP Control Panel may throw an error when writing to files, even if your application is installed in a safe location.  If this happens, re-launch the application as an administrator.

[^3]: You may receive denied permissions when attempting to connect to the official database from your local website.  We're attempting to find a way to work around it.
