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

Open `C:\xampp\reuleaux.dev\php\website.php`.  Delete the contents of the file, and replace it with `localhost`.  This is the base for all HTML links.

### Ease of Use Recommendation

We highly recommend changing the default text editor.  You can do this by opening XAMPP, clicking on the `Config` button and selecting a new editor application.  Our recommendation of Notepad++ is typically installed at `C:\Program Files\Notepad++\notepad++.exe`.[^1]

### Note to Windows users

You should install XAMPP in a folder without restricted write permissions.  It is advised *against* installing the program in `C:\Program Files`, `C:\Program Files (x86)`, or any equivalent.  Instead, we recommend the root directory of a drive, such as `C:\xampp` or `D:\xampp`.  Your `C:\Users\{USER}\AppData\Local` folder may also be suitable.

[^1]: In Windows, the XAMPP Control Panel may throw an error when writing to files, even if your application is installed in a safe location.  If this happens, re-launch the application as an administrator.