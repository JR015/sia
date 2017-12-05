<?php
$this->load->helper('html');

$this->load->view("inc/start_head");
$this->load->view("inc/css");

if(isset($css)){
    foreach ($css as $estilo) {
        if ($estilo != '') {
            echo link_tag('assets/css/' . $estilo);
        }
    }
}

$this->load->view("inc/end_head");
$this->load->view("inc/sidebar-coordinador");
$this->load->view("inc/nav");
$this->load->view("coordinador/".$contenido);
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

$this->load->view("inc/end_footer");

?>





