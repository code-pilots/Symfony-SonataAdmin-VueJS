DEPRECATED
==========

Symfony
=======

A Symfony project starter.

Additional dependencies:
------------------------

* Sonata Admin Bundle
* VueJS
* webpack
* buefy (VueJS + bulma)
* less (can be easily replaced by other preprocessor)

First steps:
------------

1. Install project dependencies:

```composer install```

2. Update Sonata Admin front-end libraries (optional):

```bower install ./vendor/sonata-project/admin-bundle/bower.json```

3. Install project front-end libraries:

```yarn install```

4. Build assets for dev environment:

```yarn run encore dev```


Build assets:
-------------

* `yarn run encore dev`
* `yarn run encore dev --watch`
* `yarn run encore production`
