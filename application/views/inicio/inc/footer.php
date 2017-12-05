<!--footer start-->



<footer class="footer">
    <div class="container">
        <div class="row">

            <br>

            <br>
            <br>
            <br>
            <br>

        </div>

    </div>


</footer>
<!-- footer end -->
<!--small footer start -->

<!--

<footer class="footer-small">
    <div class="container">
        <div class="row">



            <div class="col-md-4">
                <div class="copyright">
                    <p>&copy; Copyright - CECAR <?php echo date('Y') ?>.</p>
                </div>
            </div>
        </div>
    </div>
</footer>


-->

<!--small footer end-->

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?= base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<script src="<?= base_url('assets/js/mis-scripts/inicioSesion.js');?>"></script>
<script src="<?=base_url('assets/js/mis-scripts/restablecerClave.js')?>">    </script>
<script src="<?= base_url('assets/js/mis-scripts/registroEstudiante.js');?>"></script>

<script src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>

<script  src="<?=base_url('assets/js/jquery.parallax-1.1.3.js')?>"></script>

<script src="<?=base_url('assets/js/parallax-slider/jquery.cslider.js')?>"></script>

<noscript>

    <meta http-equiv="Refresh" content="60;URL=<?=base_url('error/no_script')?>">

</noscript>

<script>

    /*

    window.oncontextmenu = function() {
        return false;
    }


    */

</script>






<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<script>




    $('ul.nav li.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });

    wow = new WOW(
        {
            boxClass:     'wow',      // default
            animateClass: 'animated', // default
            offset:       0          // default
        }
    )
    wow.init();


    $(window).scroll(function() {
            $('#skillz').each(function(){
                    var imagePos = $(this).offset().top;
                    var viewportheight = window.innerHeight;

                    var topOfWindow = $(window).scrollTop();
                    if (imagePos < topOfWindow+viewportheight) {
                        $('.skill_bar').fadeIn('slow');
                        $('.skill_one').animate({
                                width:'50%'}
                            , 2000);

                        $('.skill_bar_progress p').fadeIn('slow',function(){

                            }
                        );
                    }
                }
            );
        }
    );



</script>

</body>
</html>
