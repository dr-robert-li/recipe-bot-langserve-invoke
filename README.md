# Recipe Bot LangServe WordPress Plugin
### Author: Robert Li
### Version 0.1
### Feb 2024

This plugin creates a block called "Recipe Bot" that interacts with a LangServe FastAPI Server's `/invoke` endpoint.
It can be retrofitted to use any of LangServe's endpoints and the context can be changed to serve different purposes.

Fork and change both files in `/app/` folder to do so.

This was created for the WordCamp Asia 2024 talk *ChatWP: Talking to Wordpress using Generative AI*.

It is paired with the Colab Notebook found here: https://colab.research.google.com/drive/1PGw_QEjJFQ3vhVuSinCbWose5KNjk5wb?usp=sharing 

To use this you may require adding CSP header to your web server:

For `.htaccess`:

```
<ifModule mod_headers.c>
Header always set Content-Security-Policy "upgrade-insecure-requests;"
</IfModule>
```

For nginx, as this to the server instance in the `nginx.conf` or relevant `/conf.d/` config file:

```
server {
  add_header Content-Security-Policy upgrade-insecure-requests;
}
```

Simply `git clone` this repository, zip it up and Upload it to add as a new plugin on your WordPress site. Documentation can be found here: https://wordpress.org/documentation/article/manage-plugins/#upload-via-wordpress-admin
