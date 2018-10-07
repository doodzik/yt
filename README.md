# yt

[yt](http://yt.dudzik.co) is a distraction-free youtube client.
You can search for videos and watch videos. That is about it.

# Installation

```bash
$ brew install composer
$ make install
$ make server
```

Make sure that you have set the necessary environment variables.
By default, the `init.php` script will look for an `env.php` file in its parent directory where these are set. You can comment out the require statement if you want to set these environment variables differently. 

```
<?php
putenv('PRODUCTION=false');
putenv('GOOGLE_DEV_KEY=');
?>
```

The init script will look for the vendor (dependencies) directory in its parent directory if you set the `PRODUCTION` environment variable to true.

If you want to make the quick access work from another url you will need to add this `.htaccess` file to that website:
```
RewriteEngine On                                                                  
RewriteBase /                                                                     
RewriteCond %{HTTP_HOST} !yt.dudzik.co$ [NC]                                      
RewriteRule ^(.*)$ http://yt.dudzik.co/quick/$1 [L,R=303]
```
(Obviously, change `yt.dudzik.co` to your host name)

