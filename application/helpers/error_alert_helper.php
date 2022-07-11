<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('alert_error')) {
  function alert_error($message, $redirect){
    $ci =& get_instance();
    // array hari dan bulan
    $data['data'] = '
		<script src="'.base_url().'assets/vendors/sweetalert/sweetalert.min.js"></script>
		<script>
			swal("'.$message.'", {
                icon: "success",
            }).
			then(() => {
				window.location.href = "'.base_url().$redirect.'"
			})
		</script>';
	$ci->load->view('templates/kosong', $data);
  }
}