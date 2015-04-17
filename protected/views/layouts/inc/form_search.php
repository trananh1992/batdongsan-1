<div class="row col-sm-12">
    <?php
    $m_search = new TinNhaDat();
    if(isset($_GET['TinNhaDat']))
      $m_search->attributes = $_GET['TinNhaDat'];
    $form=$this->beginWidget('CActiveForm', array(
            'id'=>'form_search_top',
            'action'=>  Yii::app()->createAbsoluteUrl('site/listTin'),
            'htmlOptions'=>array('class'=>'form', 'role'=>'search', 'enctype'=>'multipart/form-data'),
            'method'=>'GET',
    //        'enableClientValidation'=>true,
            'clientOptions'=>array(
    //            'validateOnSubmit'=>true,
            ),
        )); 
    ?>
          <div class="col-sm-2">
            <?php echo $form->dropDownList($m_search,'s_dich_vu', CategoryTin::getListDichVu(), array('class' => 'form-control')); ?>
            <?php //echo $form->dropDownList($m_search,'s_dich_vu', DichVu::getListData(), array('class' => 'form-control')); ?>
            <!-- <select class="form-control">
                <option>Loại dịch vụ</option>
                <option>Nhà bán</option>
                <option>Đất bán</option>
            </select> -->
          </div>

          <div class="col-sm-2">
              <?php echo $form->dropDownList($m_search,'s_khu_vuc', CategoryTin::getListKhuVuc(), array('class' => 'form-control')); ?>
          </div>
        
          <div class="col-sm-2">
              <?php echo $form->dropDownList($m_search,'s_gia', Gia::getListGia(), array('class' => 'form-control')); ?>
          </div>
          <div class="col-sm-2">
              <?php echo $form->dropDownList($m_search,'s_dien_tich', DienTich::getListDienTich(), array('class' => 'form-control')); ?>
          </div>
        <div class="col-sm-2 form-group">
            <?php echo $form->textField($m_search,'title', array('class' => 'form-control', 'placeholder'=>'Nhập tiêu đề tin')); ?>
        </div>
        <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
        </div>
    <?php $this->endWidget(); ?>

    </div>