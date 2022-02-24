<!-- jQuery Version 1.11.0 -->
<script src="<?=base_url ()?>assists/cp/js/jquery-1.11.0.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?=base_url ()?>assists/cp/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?=base_url ()?>assists/cp/js/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/r-2.2.2/datatables.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?=base_url ()?>assists/cp/js/raphael/raphael.min.js"></script>
<script src="<?=base_url ()?>assists/cp/js/morris/morris.min.js"></script>

<!-- Select 2 blugin Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?=base_url ()?>assists/cp/js/sb-admin-2.js"></script>

<?php if ( isset ( $js_page ) ) $this->load->view ( $js_page ) ; ?>

</body>

</html>