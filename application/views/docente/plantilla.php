<?php
$this->load->helper('html');

$this->load->view("inc/start_head");
$this->load->view("inc/css");
$this->load->view("inc/end_head");
$this->load->view("inc/sidebar-docente");
$this->load->view("inc/nav");
$this->load->view("docente/".$contenido);
$this->load->view("inc/start_footer");
$this->load->view("inc/js");
?>

<?php

if(isset($js)) {
    foreach ($js as $script) {
        //echo script_tag('assets/js/'.$script);
        ?>
        <script src="<?=base_url('assets/js').'/'.$script?>"></script>
        <?php
    }
}

?>

<?php

$this->load->view("inc/end_footer",$periodo);

?>





