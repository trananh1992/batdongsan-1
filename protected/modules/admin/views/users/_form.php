<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
    </div>
    <div class="panel-body">
        <div class="form">
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'users-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
                    ));
            ?>
            
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php
                    if(!$model->isNewRecord)
                        echo $form->textField($model, 'username', array('class' => 'form-control', 'maxlength' => 255,'readonly'=>'readonly'  ));
                    else
                        echo $form->textField($model, 'username', array('class' => 'form-control', 'maxlength' => 255  ));
                    ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>

            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'email', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>
            </div>
            <div class="form-group form-group-sm">
                
                <?php echo $form->labelEx($model, 'temp_password', array('class' => "col-sm-1 control-label")); ?>
                <div class="col-sm-3">
                    <?php echo $form->passwordField($model, 'temp_password', array('size' => 47, 'maxlength' => 30, 'value' => '', 'class' => "form-control")); ?>
                    <?php echo $form->error($model, 'temp_password'); ?>
                </div>
            </div>
            <div class="form-group form-group-sm">
                <?php echo $form->labelEx($model, 'password_confirm', array('class' => "col-sm-1 control-label")); ?>
                <div class="col-sm-3">
                    <?php echo $form->passwordField($model, 'password_confirm', array('size' => 47, 'maxlength' => 50, 'value' => '', 'class' => "form-control")); ?>
                    <?php echo $form->error($model, 'password_confirm'); ?>
                    <?php
                    if(!$model->isNewRecord)
                        echo '<div class="notes">Để trống nếu không muốn đổi password.</div>';
                    ?>

                </div>
            </div>
            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'full_name', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'full_name', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'full_name'); ?>
                </div>
            </div>

            <?php /*
            <div class='form-group form-group-sm'>
                    <?php echo $form->labelEx($model, 'profile_imge', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    
                    <?php if (!empty($model->profile_imge))
                    { ?>
                        <div class="thumbnail">
                            <div class="caption">
                                <h4><?php echo $model->getAttributeLabel('profile_imge'); ?></h4>
                                <p>Click on remove button to remove <?php echo $model->getAttributeLabel('profile_imge'); ?></p>
                                <p><a href="<?php echo $this->baseControllerIndexUrl(); ?>/removeimage/fieldName/profile_imge/id/<?php echo $this->id; ?>" class="label label-danger removedfile" rel="tooltip" title="Remove">Remove</a>
                            </div>
                            <img src="<?php echo Yii::app()->createAbsoluteUrl($model->uploadImageFolder . "/" . $model->id . "/" . $model->thumb_image); ?>"  style="width:100%;" />
                        </div><?php } ?>
                    <?php echo $form->fileField($model, 'profile_imge', array('accept' => 'image/*', 'title' => 'Upload  ' . $model->getAttributeLabel('profile_imge'))); ?>
                    <div class='notes'>Allow file type  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Maximum file size : <?php echo ($model->maxImageFileSize/1024)/1024;?>M </div>
                    <?php echo $form->error($model, 'profile_imge'); ?>
                </div>
           </div>
           */?>
           


            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'status', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->dropDownList($model, 'status', $model->optionActive, array('class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'status'); ?>
                </div>
            </div>

            

            <div class='form-group form-group-sm'>
                <?php echo $form->labelEx($model, 'phone', array('class' => 'col-sm-1 control-label')); ?>
                <div class="col-sm-3">
                    <?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'maxlength' => 255)); ?>
                    <?php echo $form->error($model, 'phone'); ?>
                </div>
            </div>


            <div class="clr"></div>
            <div class="well">
                <?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
                <?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>