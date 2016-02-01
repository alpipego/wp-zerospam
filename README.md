wp-zerospam
===========

Plugin to get rid of WordPress Comment Spam, Akismet fails to do so even on low traffic sites.

The idea is loosely based on the negative CAPTCHA and/or honey pot technique and the method used by [David Walsh](http://davidwalsh.name/wordpress-comment-spam).

The assumption to get this to work is that you use either the original wordpress comment form or one that uses the `respond` ID on the form itself.

Technique:
* add a field via php
* remove the field via js
* validate the `$commentdata` `$_POST` to check if the field has been removed
* if it is still present redirect the user to the same page without saving the comment
* if a human user does not have javascript activated they don't see the comment form at all (better than making the user send the form and not saving their comment)
