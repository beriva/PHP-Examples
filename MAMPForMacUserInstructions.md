# Setting up the mac command line to use MAMP's PHP.

If you're using MAMP to develop sites locally, then it makes sense for when you type `php` into the terminal that it uses MAMP's PHP, rather than the system-wide PHP that ships with Mac OS X.

First, open up a terminal window, and type:

```
$ which php
```

This should show something like:

```
/usr/bin/php
```

If it does, great! Chances are it will. Now you need to locate your version of MAMP's PHP, it should be located somewhere like:

```
/Applications/MAMP/bin/php/php5.4.4/bin/php
```
You may need to change the PHP version, depending on what version of MAMP you're running.

Now this is the tricky bit **BE CAREFUL BECAUSE YOU CAN DO SOME REAL DAMAGE TO YOUR SYSTEM AT THIS POINT**

We're going to *rename* the Mac OSX included version of PHP to something like `php_old`, then create a *symbolic link* from MAMP's PHP to `/usr/bin/php`, so that when you type `php`, the command the terminal is actually issuing is `/Applications/MAMP/bin/php/php5.4.4/bin/php`.

First, move the system-wide version using `mv`:

```
$ sudo mv /usr/bin/php /usr/bin/php_old
```

Now try running:

```
$ php_old -v
```

This should show you the version information for php.

Now we're going to create a symbolic link from MAMP's PHP to where PHP used to be in the `/usr/bin` folder:

```
$ sudo ln -s /Applications/MAMP/bin/php/php5.4.4/bin/php /usr/bin/php
```

Now run `$ php -v` and you should see that the version is the same as your MAMP's PHP version!

Done :)

>Please note there are extra steps involved in getting things like `Pear` and `PECL` working with this.
