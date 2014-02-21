<?php
return array(
  'guest'=> array(
    'scn-social-auth-user/login',
    'scn-social-auth-user/login/provider',
    'scn-social-auth-hauth',
    'scn-social-auth-user/register',
  ),
  'user'=> array(
    'home',
    'notes',
    'contacts',
    'scn-social-auth-user/authenticate/provider',
    'scn-social-auth-user',
    'zfcuser/changepassword',
    'scn-social-auth-user/logout',
    'calendar'
  ),
  'admin'=> array(
    'home',
    'guestbook',
    'admin',
    'add-user',
    'delete-user'
  )
);
