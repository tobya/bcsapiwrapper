BCS API Wrapper Library
BCSAPI Library V2

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
> 
> 

Upgrading from BCSAPI 
--
https://github.com/tobya/bcsapi

most of these calls were available from BCSAPI

Changes

In any Laravel project, all API classes can be retrieved through Service Provider

````php
  $CourseApi = App('BCSApi')->Course();
````

The Api URL and Key will be injected to return a correctly created Api as long as all .env values are filled in correctly.

**Array -> Object**

One breaking change from BCSApi -> BCSApiWrapper is that all retured data is now returned as a Stdobj rather than an array.

V1
````php
$CourseApi = new BCSCourseAPI($url,$key) ;
$CourseInfo = $CourseApi->CourseInfo(12345);
echo $CourseInfo['CourseName'];
````


V2 BCSApiWrapper
````php
$CourseApi = new App('BCSApi')->Course();
$CourseInfo = $CourseApi->CourseInfo(12345);
echo $CourseInfo->CourseName;
````

This may require rewriting of quite a bit of code on upgrading.

Tests
==

There is a Postman Collection to do tests on the main BCSApi routes.

https://github.com/tobya/bcsStudents_gitp4/blob/LaravelSubscriptions/resources/postman/api.cookingisfun.ie%20v2.postman_collection.json
