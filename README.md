# Bilemo API
A Restful API to manage customers, list products.
Secured with JWT, powered by API Platform

## Installation
- Clone the repository
- Install with composer
`composer install`
- Generate the ssl keys for JWT
`$ mkdir -p var/jwt # For Symfony3+, no need of the -p option`
`$ openssl genrsa -out var/jwt/private.pem -aes256 4096`
`$ openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem`
- Configure your .env accordingly (look at env.dist)
- Create the database
`php bin/console doctrine:database:create`
- Create the schema
`php bin/console doctrine:schema:create`
- Install the demo data set if you want to [IMPORTANT] You have to change **at least** the companies passwords when you put in production.
`php bin/console doctrine:fi:lo`

## Login the users
Make a http request with :
- Method: POST
- url: {your.domain}/api/login_check
- Accept: application/json
- Content-Type: multipart/form-data
- body [form data]:
    - _username
    - _password

The user gets a JSON response containing a JWT Token valid for 1 Hour.
 
## Accessing the API with your JWT Token
Every request to the API MUST contain the JWT Token received in the Headers :
- Authorization: Bearer {Your JWT Token}

## Content negotiation
Send your content in JSON or in JSON-LD

## Hypermedia served by Hydra
For accessing the hypermedia informations your Headers must contain :
- Accept: application/ld+json

## Resources accessible without token
- {your.domain}/api/login_check
- {your.domain}/api/docs

## Documentation
All the available entry points are documented here:
- {domain}/api/docs
