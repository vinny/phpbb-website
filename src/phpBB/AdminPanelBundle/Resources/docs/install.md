Installing the Admin Panel
==========================

phpBB's Admin Panel is available on Packagist ([phpbb/adminpanel](http://packagist.org/packages/phpbb/adminpanel))
and as such installable via [Composer](http://getcomposer.org/).

If you do not use Composer, you can grab the code from GitHub, and use any
PSR-0 compatible autoloader (e.g. the [Symfony2 ClassLoader component](https://github.com/symfony/ClassLoader))
to load Admin Panel classes.

You can use composer by ``composer.json`` in your project's root with this contents:
.. code-block :: js
    {
        require: {
            "phpbb/admin-panel": "master-dev"
        }
    }
    
.. note ::

    If you don't wish to use the latest development version then you can set this to 
    a set release or include a wildcard version, for example ``1.0.*``.

You can install the new dependencies by running Composer's ``install``
command from the directory where your ``composer.json`` file is located 
after downloading composer.phar with curl. If you use git then I suggest 
you add ``vendor/`` and ``composer.phar`` to your ``.gitignore`` *before* running 
these commands:

.. code-block :: bash
	
	curl -s https://getcomposer.org/installer | php
    php composer.phar update

Then, you can update your dependencies at any point  by running Composer's 
``update`` command from the directory where your ``composer.json`` file is 
located:

.. code-block :: bash

    php composer.phar update
    
Now, Composer will automatically download all required files, and install them
for you. All that is left to do is to update your ``AppKernel.php`` file, and
register the new bundle:

.. code-block :: php

    <?php

    // in AppKernel::registerBundles()
    $bundles = array(
        new phpBB\AdminPanelBundle\phpBBAdminPanelBundle($this),
    );
