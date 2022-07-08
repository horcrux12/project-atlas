<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('access_user')) {
  function access_user($level_user, $redirect){
    $ci =& get_instance();
    // array hari dan bulan
    if ($ci->session->userdata['level'] != $level_user){
        redirect($redirect);
    }
  }
}