<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
define('title', 'The Ricaverse');
define('logo', 'uploads/logo.png');
define('email','info@payetoken.io');
define('phone','0123456789');
define('smslimit',5000);
define('currency',"USDT ");
define('decimal',18);
define('decimal_number', 10**decimal);
define('contract_address', '0xe9e7CEA3DedcA5984780Bafc599bD69ADd087D56');
define('receiving_address', '0x306A58C50497ACD28D45168C6215Eaf51457e82E');



// ZOHO EMAIl SK


define('user', 'noreplyinfomail7@gmail.com');
define('pass', 'GNI@1234');
define('sender_id', 'noreplyinfomail7@gmail.com');
define('sender_name', title);


define('user1', 'gnimailzoho@gmail.com');
define('pass1', 'GNI@1234');
define('sender_id1', 'noreplyinfomail7@gmail.com');
define('sender_name1', title);
//pay2all access token
define('access_token', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyMDgiLCJqdGkiOiJmMWMyYTVmNDYzNTFhMWU3NDBhMmVkOTBmNjRhMThkNzg5YjI3ZmNiM2U2ODdkZGQ5ZjRjZDM3NTUyN2M0NTUzOWRjMTI4MWE2ZjJkMzU5ZSIsImlhdCI6MTY2Mjk3MjI4Mi40OTYzODc5NTg1MjY2MTEzMjgxMjUsIm5iZiI6MTY2Mjk3MjI4Mi40OTYzOTEwNTc5NjgxMzk2NDg0Mzc1LCJleHAiOjE2Nzg2MTA2ODIuNDQzNDIwODg2OTkzNDA4MjAzMTI1LCJzdWIiOiIzMjE4MiIsInNjb3BlcyI6W119.jM_KXTuXUMmg-Fp5oryzgIlk5ScvGJywsfigqw1PxW5h6BBKYNXg0rUqy5qmLYQM5t7FYOgpV5FssiPxFvjl1ZqKAfzE-PtAwTZMf8rvo0l-9EALi7yEttV_9mB9Uu6Ox5mmBsOHDg25Injvj8Yd7dSLEBNox0hA8M_wur8h6VksABYcQUycHwK_yNwkIyERmViP2U9LUQWCdUKJHdKQmJNreY6iCHhBVe2Iy65L4slgqeMTEVajwFkkn7hB9cbKYvQ4qpG4yJ13z8mS_eQdd-BfzmjgoWsZj9ekTKxv3txyZRQlRPG5DBsFqwVY6BKUVHjq8YK8223JcChfqEnL3cwlRJvJvaW7pD7pY1xW2onQQeIFbE3XfJbEzdhwrjb9msX9h-mxr5tqFzNtEAGCmnrPHHjpuyP6jatnublngdmyqAzHDx_RM_pfvVdrgQh_Df9S7oLFLOWcfzQu4rUIsVGH_5JTYuvz6oKUpFg-XKSnQPBgawxqdNNR2cBb3bX2Oqf8OSdlvx8Z9HsZKfmGbxo6wLmbwnZe309LvjbnE_XPWmVDlrjPQ0yMOhwCbFLSkoMGyr5U55RFPUvrNWlVbz0kK8xmKqPoS_BpJYu34lf0RF81MQptBgjT5-QUVOPNcfOYuJOXSnpPXk4EACAC5qSRVEoqa4rKrrHO-lE3dPA');


