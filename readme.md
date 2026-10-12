BCS API Wrapper Library
BCSAPI Library V4

[![Latest Stable Version](https://poser.pugx.org/tobya/bcsapiwrapper/v)](//packagist.org/packages/tobya/bcsapiwrapper) [![Total Downloads](https://poser.pugx.org/tobya/bcsapiwrapper/downloads)](//packagist.org/packages/tobya/bcsapiwrapper) [![Latest Unstable Version](https://poser.pugx.org/tobya/bcsapiwrapper/v/unstable)](//packagist.org/packages/tobya/bcsapiwrapper) [![License](https://poser.pugx.org/tobya/bcsapiwrapper/license)](//packagist.org/packages/tobya/bcsapiwrapper)

The BCS Api Wrapper Library provide PHP wrapper classes for most of the APIs used internally within the BCS system.

 ## Overview

### From Backoffice
- Course
- Student
- CourseType
- Holiday
- MediaItem
- Note
- Personlist
- Subscriber
- Subscription
- TransactionType
- User
- Voucher

### From RecipeApi
- Recipe
- Render

### Secure Booking Server
- Secure Bookings

### KitchenBook
- Telegram Chat

### Photo Api
- PhotoAPI is seperate and currently doesnt have a wrapper.

## install
````php
 composer require tobya/bcsapiwrapper
````

Publish config file

> php artisan vendor:publish 

> select BCSApiWrapper



.env updates
The following values need to be available in .env file

````dotenv
# Main BCS Api URLS 
# Required for V1 where KEY is in URL
BCSBACKOFFICE_APIURL=
BCSBACKOFFICE_APIKEY=

# New BCS V4 Api Urls 
BCSBACKOFFICE_V4_APIURL=
BCSBACKOFFICE_V4_APITOKEN=


# Photo Api
DEMOPHOTO_APIURL=

#Recipe Api
BCSRECIPE_APIURL=
BCSRECIPE_APIKEY=
````

## Generating Backoffice Api Keys

For version 4 generate keys in backoffice.  This can be done when logged in as super user , log in as toby.

https://backoffice.cookingisfun.ie/user/settings

Create a token via the form.  Both fields are for info only.


Keep up to date

> composer update


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


### V5 BCSApiWrapper

V5 is currently being written and the wrapping function are now being generated with [Saloon php ](https://docs.saloon.dev/)

As of writing only Course is available.  Use as follows

````

$CourseApi = BCSApi::V5->CourseApi();

$response = $CourseApi->CourseDetails($courseid);

// retrieve response json data as an object.
$info = $response->Object();

echo $info->course->CourseName;


````



Tests
==

There is a Postman Collection to do tests on the main BCSApi routes.

https://github.com/tobya/bcsStudents_gitp4/blob/LaravelSubscriptions/resources/postman/api.cookingisfun.ie%20v2.postman_collection.json
