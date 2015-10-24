PHP_ARG_WITH(discount, whether to enable discount support,
[  --with-discount[=DIR]       Enable discount markdown support. Dir is the optional path to the discount library])

if test "$PHP_DISCOUNT" != "no"; then
  AC_MSG_CHECKING([for discount headers])
  for i in "$PHP_DISCOUNT" "$prefix" /usr /usr/local; do
    if test -r "$i/include/mkdio.h"; then
      PHP_DISCOUNT_DIR=$i
      AC_MSG_RESULT([found in $i])
      break
    fi
  done
  if test -z "$PHP_DISCOUNT_DIR"; then
    AC_MSG_RESULT([not found])
    AC_MSG_ERROR([Please install discount])
  fi

  PHP_ADD_INCLUDE($PHP_DISCOUNT_DIR/include)
  dnl recommended flags for compilation with gcc
  dnl CFLAGS="$CFLAGS -Wall -fno-strict-aliasing"

  export OLD_CPPFLAGS="$CPPFLAGS"
  export CPPFLAGS="$CPPFLAGS $INCLUDES -Wall -Wno-parentheses"
  AC_CHECK_HEADER([mkdio.h], [], AC_MSG_ERROR(['mkdio.h' header not found]))
  PHP_SUBST(DISCOUNT_SHARED_LIBADD)

  PHP_ADD_LIBRARY_WITH_PATH(markdown, $PHP_DISCOUNT_DIR/$PHP_LIBDIR, DISCOUNT_SHARED_LIBADD)
  export CPPFLAGS="$OLD_CPPFLAGS"

  PHP_SUBST(DISCOUNT_SHARED_LIBADD)
  AC_DEFINE(HAVE_DISCOUNT, 1, [Whether you have discount markdown support])
  PHP_NEW_EXTENSION(discount, discount.c markdowndoc_class.c markdowndoc_meth_callbacks.c markdowndoc_meth_document.c markdowndoc_meth_header.c markdowndoc_meth_input.c markdowndoc_meth_misc.c markdowndoc_meth_parts.c, $ext_shared)
fi
