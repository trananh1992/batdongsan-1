<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="<?php echo CHtml::encode($this->pageTitle); ?>" />

<?php 
$desc = $this->getMetaDescription();
$keyword = $this->getMetaKeywords();
if (!empty($desc)) {
   echo "<meta content='{$desc}' name='description' />";
}
if (!empty($keyword)) {
    echo "<meta content='{$keyword}' name='keywords' />";
} 
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<!-- <meta name="viewport" content="width=1280" />  -->
<meta content="telephone=no" name="format-detection" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

<!-- css -->
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/nguyen.css">
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom.css" rel="stylesheet" media="screen" /> 



<!-- Icon title -->
<link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />
<link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />





<link href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" rel="shortcut icon" type="<?php echo Yii::app()->theme->baseUrl; ?>/image/vnd.microsoft.icon" />
<?php /*
	<link rel="SHORTCUT ICON" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />
	<link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />
*/?>
<?php 
// Yii::app()->clientScript->registerCoreScript('jquery'); 
// Yii::app()->clientScript->registerCoreScript('jquery.ui'); 
?> 

  
<!-- js -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery1.11.1.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/holder.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom.js"></script>

<script  src="<?php echo Yii::app()->baseUrl . '/resources/ckeditor/ckeditor.js'; ?>" type="text/javascript" ></script>
<script  src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/gii.js" type="text/javascript"></script>
<script  src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/holder.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        runEditorBasic('<?php echo Yii::app()->baseUrl; ?>/resources/', <?php echo Yii::app()->params['ckeditor_basic']; ?>, '100%', 150);
        runEditorFull('<?php echo Yii::app()->baseUrl; ?>/resources/', <?php echo Yii::app()->params['ckeditor_full']; ?>, '100%', 250);
        runDatePicker('<?php echo Yii::app()->theme->baseUrl; ?>');
        runTimePicker('<?php echo Yii::app()->theme->baseUrl; ?>');
        runDateTimePicker('<?php echo Yii::app()->theme->baseUrl; ?>');
        // validateNumber();
    });
</script>

<script type="text/javascript">

$(document).ready(function () {
  $('.navbar-default .navbar-nav > li.dropdown').hover(function () {
      $('ul.dropdown-menu', this).stop(true, true).slideDown('fast');
      $(this).addClass('open');
  }, function () {
      $('ul.dropdown-menu', this).stop(true, true).slideUp('fast');
      $(this).removeClass('open');
  });
});

</script>

  <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->


<!--  -->
<link   href="<?php echo Yii::app()->theme->baseUrl; ?>/css/fancybox.css" rel="stylesheet" type="text/css" />
<script  src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.fancybox.js" type="text/javascript"></script>















<script type="text/javascript">
function xoaTinDetail(object, tin_id, user_id, id_div)
{
  if(confirm('Bạn có chắc muốn xóa?'))
  {
      jQuery.ajax({
          url: "<?php echo Yii::app()->createAbsoluteUrl('thanhvien/xoaTinDetail'); ?>",
          type: "post",
          data: {
              'tin_id': tin_id,
              'user_id': user_id
          },
          beforeSend: function() {
            $.blockUI({ message: null });
           },
          success: function(data) 
          {
            $.unblockUI();
            console.log(data);
            if(data=='delete_success')
              $(id_div).remove();
              // jQuery('#image_data_product_photo').append(data);
              // jQuery('.qq-upload-button input[type="file"]').attr("disabled", false);
          },
          error: function() 
          {
            $.unblockUI();  
              // jQuery('.qq-upload-button input[type="file"]').attr("disabled", false);
          }
      });
  }

  
}
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=906605782693204";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<meta property="fb:app_id" content="906605782693204" />
<meta property="fb:admins" content="100000628072288"/>




<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60839598-3', 'auto');
  ga('send', 'pageview');

</script>