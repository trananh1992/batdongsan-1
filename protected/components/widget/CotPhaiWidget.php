<?php
class CotPhaiWidget extends CWidget
{
    // public $list_hot;
    public function run()
    {    
        // $list_hot = $this->list_hot;
        $this->render( 'widget_cot_phai' ,array(
            // 'list_hot'=>$list_hot,
        ));
    }
}