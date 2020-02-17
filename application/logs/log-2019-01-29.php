<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-01-29 06:41:23 --> 404 Page Not Found: Public/favicon.ico
ERROR - 2019-01-29 07:31:41 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ')' C:\wamp64\www\materlite\application\controllers\admin\Users.php 23
ERROR - 2019-01-29 07:39:10 --> 404 Page Not Found: Public/plugins
ERROR - 2019-01-29 07:40:45 --> 404 Page Not Found: Public/plugins
ERROR - 2019-01-29 07:57:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'like '%a%'  )' at line 1 - Invalid query: SELECT * FROM ci_users WHERE (  is_admin = 0 )AND (  username like '%a%' OR email like '%a%' OR is_admin like '%a%' OR created_at like '%a%' OR  like '%a%'  ) 
ERROR - 2019-01-29 07:57:00 --> Severity: error --> Exception: Call to a member function num_rows() on boolean C:\wamp64\www\materlite\application\libraries\Datatable.php 41
ERROR - 2019-01-29 08:17:39 --> Severity: Notice --> Undefined property: Export::$ignore_directories C:\wamp64\www\materlite\application\controllers\admin\Export.php 22
ERROR - 2019-01-29 08:17:39 --> Severity: Notice --> Only variables should be assigned by reference C:\wamp64\www\materlite\application\controllers\admin\Export.php 28
