BCS API Wrapper Library
BCSAPI Library V2

install

> composer require tobya/bcsapiwrapper
> 

Publish config file

> php artisan vendor:publish --tag=config
> 
>

.env updates
The following values need to be available in .env file

````angular2html
# Main BCS Api URLS
BCSBACKOFFICE_APIURL=
BCSBACKOFFICE_APIKEY=

# New BCS V3 Api Urls
BCSBACKOFFICE_V3_APIURL=
BCSBACKOFFICE_V3_APIKEY=

# Photo Api
DEMOPHOTO_APIURL=

#Recipe Api
BCSRECIPE_APIURL=
BCSRECIPE_APIKEY=
````





Keep up to date

> composer update

