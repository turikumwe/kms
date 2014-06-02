<?php
/* @var $this IndividualController */
/* @var $model Individual */

$this->breadcrumbs = array(
   'Profile' => array('index'),
    $model->UserName,
    'Update',
);
$this->renderPartial('_UserMenu', array('active' => 'editPeople', 'editAction' => true, 'userOption' => false, 'id' => $model->IndividualID));
?>

<div class="span10">
    <div style="margin-left: 0px;">
        <h1 style="text-align: center;">Details update</h1>
        <p class="note">Fields with <span class="required">*</span> are required.</p>
    </div>
    <?php
    echo $this->renderPartial('../../default/_Individualform', array('model' => $model, 'statusList' => $statusList,
        'genderList' => $genderList, 'countryList' => $countryList, 'provinceList' => $provinceList,
        'currentDistrict' => $currentDistrict, 'currentSector' => $currentSector, 'currentCell' => $currentCell, 'currentVillage' => $currentVillage, 'selectedCountry' => $selectedCountry));
    ?>  
</div>
<div style="display: none;">
    <img alt="tick" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/datepicker/images2/cal.gif" onclick="javascript:NewCssCal('Individual_DOB', 'yyyyMMdd')" style="cursor:pointer"
         id="date_pick"/>
</div>