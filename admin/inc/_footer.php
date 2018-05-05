<!-- Page Footer-->
<footer class="main-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <p>&copy; <?php echo $config->settings['sitename']; ?> <?php echo date('Y');?>. <?php echo $lang['common']['copyright'];?></p>
            </div>
            <div class="col-sm-6 text-right">
                <p><a href="https://github.com/rubensrocha/fruit-farm" target="_blank" class="external"><?php echo $config->scriptName; ?></a></p>
            </div>
        </div>
    </div>
</footer>
</div><!-- content-inner -->
</div><!-- page-content -->
</div><!-- page -->
<!-- JavaScript files-->
<script src="<?php $func->url('vendor/jquery/jquery.min.js');?>"></script>
<script src="<?php $func->url('vendor/popper.js/umd/popper.min.js');?>"></script>
<script src="<?php $func->url('vendor/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php $func->url('vendor/jquery.cookie/jquery.cookie.js');?>"></script>
<script src="<?php $func->url('vendor/chart.js/Chart.min.js');?>"></script>
<script src="<?php $func->url('vendor/jquery-validation/jquery.validate.min.js');?>"></script>
<!-- Main File-->
<script src="<?php $func->url('js/front.js');?>"></script>
<script src="<?php $func->url('js/functions.js');?>"></script>
<!-- Custom Scripts -->
<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>