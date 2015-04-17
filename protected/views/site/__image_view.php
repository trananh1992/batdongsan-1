<li style="background: none; float: left; margin-left: 10px; margin-bottom: 10px; " id="image-high-<?php echo $idfile; ?>">
    <style type="text/css">
    /*.img-del{
        background-image: url('<?php echo Yii::app()->theme->baseUrl."/img/delete.png"; ?>');
    }*/
    .img-del{
        /*background: url(../images/delete-icon2.png) no-repeat;*/
        background: url('<?php echo Yii::app()->theme->baseUrl."/img/delete-icon.png"; ?>') no-repeat;
        border: medium none;
        height: 25px;
        width: 25px;
        right: 0px;
        top: 0px;
        cursor: pointer !important;
        position: absolute;
    }
    .img-del :hover{
        /*background: url(../images/delete-icon.png) no-repeat;*/
        background: url('<?php echo Yii::app()->theme->baseUrl."/img/delete-icon.png"; ?>') no-repeat;
        border: medium none;
        height: 25px;
        width: 25px;
        right: 0px;
        top: 0px;
        cursor: pointer !important;
        position: absolute;
    }
    </style>
    <span class="thumbnail" style=" position: relative;">
        <img src="<?php echo $linkfile; ?>" alt="" style="width:100px; height:100px;" />
        <button href='' type="button" class="img-del" value="<?php echo $idfile; ?>"></button>
        <input type="hidden" name="array_image[<?php echo $idfile; ?>]" value="<?php echo $idfile; ?>" />

    </span>
    <div style="margin-left:10px;">
        <?php 
        if($image->is_default==TYPE_YES){ ?>
                <input class="btn btn-primary" type="radio" name="is_default" value="<?php echo $idfile?>" checked /> Set Default
        <?php }else{ ?>
            <input class="btn btn-primary" type="radio" name="is_default" value="<?php echo $idfile?>" /> Set Default
        <?php }
        ?>
        
    </div>
    

    <script>
        jQuery('#image-high-<?php echo $idfile?> .img-del').click(function()
        {
            $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl('site/deleteImageEajax');?>",
                data:{
                    'id' : jQuery(this).val()
                },
                type: 'POST',
                beforeSend: function() {
                    $.blockUI({ message: null });
                },
                success: function(data, textStatus, xhr) 
                {
                    $.unblockUI();
                    console.log(data);
                    if(data=='delete_success')
                    {
                        jQuery('#image-high-<?php echo $idfile ?>').remove();
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    $.unblockUI();
                    console.log(data);
                }
            });
        });

    </script>
</li>



