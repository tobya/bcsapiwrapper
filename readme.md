BCS API Wrapper Library
BCSAPI Library V4

[![Latest Stable Version](https://poser.pugx.org/tobya/bcsapiwrapper/v)](//packagist.org/packages/tobya/bcsapiwrapper) [![Total Downloads](https://poser.pugx.org/tobya/bcsapiwrapper/downloads)](//packagist.org/packages/tobya/bcsapiwrapper) [![Latest Unstable Version](https://poser.pugx.org/tobya/bcsapiwrapper/v/unstable)](//packagist.org/packages/tobya/bcsapiwrapper) [![License](https://poser.pugx.org/tobya/bcsapiwrapper/license)](//packagist.org/packages/tobya/bcsapiwrapper)

install

> composer require tobya/bcsapiwrapper
> 

Publish config file

> php artisan vendor:publish 

> select BCSApiWrapper



.env updates
The following values need to be available in .env file

````angular2html
# Main BCS Api URLS
BCSBACKOFFICE_APIURL=
BCSBACKOFFICE_APIKEY=

# New BCS V4 Api Urls / V3 discontinued
BCSBACKOFFICE_V4_APIURL=
BCSBACKOFFICE_V4_APITOKEN=


# Photo Api
DEMOPHOTO_APIURL=

#Recipe Api
BCSRECIPE_APIURL=
BCSRECIPE_APIKEY=
````




Keep up to date

> composer update
> 
> 

Upgrading from V2 

You need to add the following to `config/bcsapi.php`

````php
  'v4' => [
            'backoffice' => [
                'url' => env('BCSBACKOFFICE_V4_APIURL',''),
                'token' => env('BCSBACKOFFICE_V4_APITOKEN',''),
            ],
        ]
````

and `.env` is

````
BCSBACKOFFICE_V4_APIURL={base host url, not api.backoffice.ie}
BCSBACKOFFICE_V4_APITOKEN={sanctum token}
````

V2 BCSApiWrapper
````php
$CourseApi =  App('BCSApi')->Course();
$CourseInfo = $CourseApi->CourseInfo(12345);
echo $CourseInfo->CourseName;
````

V4 BCSApiWrapper
````php
$CourseApi = BCSLoader::Course();
$CourseInfo = $CourseApi->CourseInfo(12345);
echo $CourseInfo->CourseName;
````

This may require rewriting of quite a bit of code on upgrading.

Tests
==

There is a Postman Collection to do tests on the main BCSApi routes.

https://github.com/tobya/bcsStudents_gitp4/blob/LaravelSubscriptions/resources/postman/api.cookingisfun.ie%20v2.postman_collection.json
