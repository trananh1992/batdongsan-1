<?php
class BaseFormatter extends CFormatter
{
    public function formatCanBanGap($data) 
    {
        if(!empty($data))
        {
            if($data==NHA_BAN_GAP)
                return '<img src="'.Yii::app()->theme->baseUrl.'/img/sale_off.gif" />Nhà Bán Gấp';
            else if($data==DAT_BAN_GAP)
                return '<img src="'.Yii::app()->theme->baseUrl.'/img/km1.gif" />Đất Bán Gấp';
        }   

    }

    public function formatCategoryName($id)
    {
        if(empty($id)) return '';
        $model = CategoryTin::model()->findByPk($id);
        if(!empty($model)) return $model->name;
        return '';
    }

    public function formatCategoryNameCon($id)
    {
        if(empty($id)) return '';
        $criteria = new CDbCriteria();
        $criteria->compare('t.parent_id',$id);
        // $criteria->limit = ;
        $criteria->order ="name ASC";
        $models = CategoryTin::model()->findAll($criteria);
        $html = '';
        $html .= '<a href="'.Yii::app()->createAbsoluteUrl('admin/cateTin/indexCon', array('parent_id'=>$id)).'"><span class="glyphicon glyphicon-pencil"></span>Edit Menu Con</a><br/><br/>';
        if(!empty($models))
        {
            foreach ($models as $one) 
            {
                if(!empty($one)) $html.='- '.$one->name.'<br/>';
            }
        }
        return $html;
    }

    public function formatStatusActiveInactive($value) {
        if (is_array($value)) {
            return (($value['status'] == STATUS_INACTIVE) ?
                            CHtml::link(
                                    "Inactive", array("ajaxActivate", "id" => $value['id']), array(
                                "class" => "ajaxupdate",
                                "title" => "Click here to " . DeclareHelper::$statusFormat[STATUS_ACTIVE],
                                    )
                            ) :
                            CHtml::link(
                                    "Active", array("ajaxDeactivate", "id" => $value['id']), array(
                                "class" => "ajaxupdate",
                                "title" => "Click here to " . DeclareHelper::$statusFormat[STATUS_INACTIVE],
                                    )
                            )
                    );
        } else
            return $value == 0 ? DeclareHelper::$statusFormat[STATUS_INACTIVE] : DeclareHelper::$statusFormat[STATUS_ACTIVE];
    }

    public function formatStatus($value) {
        if(is_array($value)) {
            return (($value['status'] == STATUS_INACTIVE) ?
                CHtml::link(
                    "Inactive",
                    array("ajaxActivate", "id"=>$value['id']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to ".DeclareHelper::$statusFormat[STATUS_ACTIVE],
                    )
                )
                :
                CHtml::link(
                    "Active",
                    array("ajaxDeactivate", "id"=>$value['id']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to ".DeclareHelper::$statusFormat[STATUS_INACTIVE],
                    )
                )
            );
        }
        else
            return $value == 0 ? DeclareHelper::$statusFormat[STATUS_INACTIVE] : DeclareHelper::$statusFormat[STATUS_ACTIVE];
    }

    public function formatDate($value,$formatF = '') {
        if(empty($formatF))
            $formatF = Yii::app()->params['dateFormat'];
        if($value=='0000-00-00' || $value=='0000-00-00 00:00:00' || is_null($value))
            return '';
        if(is_string($value)) {
            $date = new DateTime($value);
            return $date->format($formatF);
        }
        return parent::formatDate($value);
    }

    public function formatTime($value,$formatF = '') {
        if(empty($formatF))
            $formatF = Yii::app()->params['timeFormat'];
        if($value=='0000-00-00' || $value=='0000-00-00 00:00:00' || is_null($value))
            return '';	
        if(is_string($value)) {
            $date = new DateTime($value);
            return $date->format($formatF);
        }
        return parent::formatDate($value);
    }

    public function formatDateTime($value,$formatF = '') {
        if(empty($formatF))
            $formatF = Yii::app()->params['dateFormat'] . ' ' . Yii::app()->params['timeFormat'];
        if($value=='0000-00-00' || $value=='0000-00-00 00:00:00' || is_null($value))
            return '';	
        if(is_string($value)) {
            $date = new DateTime($value);
            return $date->format($formatF);
        }
        return parent::formatDate($value);
    }

    /* formatYNStatus use for Yes/No*/
    public static function formatYNStatus($value)
    {
        $return = DeclareHelper::$yesNoFormat;
        return isset($return[$value])?$return[$value]:"";
    }

    public static function formatYesNo($value)
    {
        $return = DeclareHelper::$yesNoFormat;
        return isset($return[$value])?$return[$value]:"";
    }

    public function formatPrice($value, $country = 'sg')
    {
        if($country == 'sg' && !empty($value) )
        {
            // return $value;
            return Yii::app()->setting->getItem('currencySign') . ' ' . number_format($value,2);
        }
        if ($value==0) {
            return  Yii::app()->setting->getItem('currencySign') . ' 0.00';
        }
        return $value;
    }

    public function formatNumberCurrency($value, $country = 'sg')
    {
        if(is_array($value))
        {
            if(empty($value['currencyType']))
                $currencyType = 'SGD';
            else
                $currencyType = $value['currencyType'];
            return number_format((float)$value['number'],2)." (".$currencyType.")";
        }
        else
            return $value = "";
    }


    public function formatGia($value, $country = 'sg')
    {
        if($value==0 || $value=="" || empty($value)) return 'Liên Hệ';
        if($country == 'sg')
        {
            $temp1 = number_format($value,0);
            $arr_number_format = explode(',', $temp1);
            $res='';
            if( isset($arr_number_format[3]) && !empty($arr_number_format[3] ) ) //tỷ - triệu - nghìn
            {
                $res = $arr_number_format[0].' tỷ ';//.$arr_number_format[1].' triệu ';

                if( !empty($arr_number_format[1]) && $arr_number_format[1]!='000' )
                    $res = $res. $arr_number_format[1]. ' triệu ';

                if( !empty($arr_number_format[2]) && $arr_number_format[2]!='000' )
                    $res = $res. $arr_number_format[2]. ' nghìn ';
            }else if( isset($arr_number_format[2]) && !empty($arr_number_format[2]) )
            {
                $res = $arr_number_format[0].' triệu ';
                if( !empty($arr_number_format[1]) && $arr_number_format[1]!='000' )
                    $res = $res. $arr_number_format[1]. ' nghìn ';
            }else if( isset($arr_number_format[1]) && !empty($arr_number_format[1]) )
            {
                $res = $arr_number_format[0].' nghìn ';
            }else if( isset($arr_number_format[0]) && !empty($arr_number_format[0]) )
            {
                $res = $arr_number_format[0].' đồng ';
            }


            return $res . ' (VNĐ)';
            // return number_format($value,0).' VNĐ';
        }
        return $value;
    }

}