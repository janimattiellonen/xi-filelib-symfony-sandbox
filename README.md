Xi Filelib Symfony sandbox
==========================

This is a Symfony Standard Edition application for testing and playing around
with Filelib.

Installation
------------

Assuming you have already obtained the source code:

1. Copy `parameters.example.yml` to `parameters.yml`: `cp app/config/parameters.example.yml app/config/parameters.yml`
2. Configure `parameters.yml` to your likings
3. Create an empty database (see parameters.yml for the name - note, PostGreSQL is selected as default)
4. `curl -s https://getcomposer.org/installer | php`
5. `php composer.phar install`
6. Create database schema (schema can be found from vendor/xi/filelib/docs)
7. Configure your web server (docs/nginx.conf contains an example nginx vhost configuration you may use - defaulting to `/var/www/xi-filelib-symfony-sandbox`)
8. Add `127.0.0.1 xifilelibsandbox.localhost` to `/etc/hosts`
9. Restart the web server
10. Navigate to `http://xifilelibsandbox.localhost/app_dev.php` in your browser

Urls you can try
----------------

- http://xifilelibsandbox.localhost/app_dev.php
- http://xifilelibsandbox.localhost/app_dev.php/upload
- http://xifilelibsandbox.localhost/app_dev.php/clear