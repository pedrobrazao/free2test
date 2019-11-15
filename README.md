Free2 Test
==========

A simple demo app built on top of Symfony 4.3, Bootstrap and JQuery.

Setup
-----

1. Clone repository.

2. Run `composer install`

3. Copy `.env. to `.env.local` and edit this with proper details.

4. Run `bin/console doctrine:schema:create`.

5. Run `bin/console doctrine:fixtures:load`.

API Endpoints
-------------

### Postcode

`GET /api/postcode/{postcode}/lookup`
`GET /api/postcode/{postcode}/validate`

### Contact

`GET /api/contact/{id}`
`GET /api/contact/search?q=`
`POST /api/contact`
