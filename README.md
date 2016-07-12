# Newband Baidu Translate Bundle

### Version
1.0.0

### Installation

First add the dependencie to your `composer.json` file:

    "require": {
        ...
        "newband/baidu-translate-bundle": "~1.0"
    },

Then install the bundle with the command:

    php composer update

Enable the bundle in your application kernel:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Newband\Amplitude\NewbandBaiduTranslateBundle(),
        );
    }
    
### Configuration

    // app/config/config.yml
    
    ... 
    newband_baidu_translate:
        app: app id
        secret: secret key