Discount PHP Extension
====

The Markdown PHP Extension provides a wrapper to the [Discount markdown library](https://github.com/Orc/discount).

BUILDING ON UNIX etc.
----

To compile your new extension, you will have to execute the following steps:

    phpize
    ./configure [--with-discount]
    make
    sudo make install

TESTING
----

You can now load the extension using a php.ini directive

    extension="discount.so"

or load it at runtime using the dl() function

    dl("discount.so");

The extension should now be available, you can test this
using the `extension_loaded()` function:

    if(extension_loaded("discount")){
      echo "discount loaded :)";
    }else{
      echo "something is wrong :(";
    }

The extension will also add its own block to the output
of `phpinfo()`;

CREDITS
----

Implementation details have been taken from:

* php-discount by Gustavo Lopes, but replaced the bundled discount library with a shared one.
      [https://github.com/cataphract/php-discount]


