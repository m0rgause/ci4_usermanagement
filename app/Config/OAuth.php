<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class OAuth extends BaseConfig
{
  public $clientId = 'c50f916d-3320-4662-8d6b-49f51a428607';
  public $clientSecret = 'Aue8Q~qab_JRJfILPqZ2v1DbzN68fmKx6yytea.U';
  // public $clientSecret = 'c0732acc-5f8d-4d2f-bfbc-33410ed572f2';
  public $redirectUri = 'http://localhost:8081/login';
  public $urlAuthorize = 'https://login.microsoftonline.com/ab5e0bc3-d1e3-4092-bebb-161f3876d597/oauth2/v2.0/authorize'; // Use your tenant-specific URL
  public $urlAccessToken = 'https://login.microsoftonline.com/ab5e0bc3-d1e3-4092-bebb-161f3876d597/oauth2/v2.0/token'; // Use your tenant-specific URL
  public $urlResourceOwnerDetails = 'https://graph.microsoft.com/v1.0/me'; // Microsoft Graph API endpoint
  public $scopes = 'openid profile email User.Read';
  //  sign out
  public $urlSignOut = 'https://login.microsoftonline.com/ab5e0bc3-d1e3-4092-bebb-161f3876d597/oauth2/v2.0/logout';
}
