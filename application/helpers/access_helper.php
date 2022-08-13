<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('access_user')) {
  function access_user($level_user, $redirect){
    $ci =& get_instance();
    // Check is Array
    if(is_array($level_user)){
      if(!in_array($ci->session->userdata['level'], $level_user)){
        redirect($redirect);
      }
    }else{
      if ($ci->session->userdata['level'] != $level_user){
        redirect($redirect);
      }
    }
  }
}
if (!function_exists('access_user_show_404')) {
  function access_user_show_404($level_user){
    $ci =& get_instance();
    // Check is Array
    if(is_array($level_user)){
      if(!in_array($ci->session->userdata['level'], $level_user)){
        show_404();
      }
    }else{
      if ($ci->session->userdata['level'] != $level_user){
        show_404();
      }
    }
  }
}