
<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'individual-form',
    'enableAjaxValidation' => false,
        ));
?>
<div class="row-fluid" style="min-height: 400px;">
    <?php echo $form->errorSummary($model); ?>
    <div class="span4">
        <fieldset>
            <legend>Identification</legend>
            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'FirstName'); ?>
                <?php echo $form->textField($model, 'FirstName', array('size' => 45, 'maxlength' => 45, 'class' => 'span8 input-xlarge')); ?>
                <?php echo $form->error($model, 'FirstName'); ?>
            </div>

            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'LastName'); ?>
                <?php echo $form->textField($model, 'LastName', array('size' => 45, 'maxlength' => 45, 'class' => 'span8 input-xlarge')); ?>
                <?php echo $form->error($model, 'LastName'); ?>
            </div>

            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'OtherName'); ?>
                <?php echo $form->textField($model, 'OtherName', array('size' => 45, 'maxlength' => 45, 'class' => 'span8 input-xlarge')); ?>
                <?php echo $form->error($model, 'OtherName'); ?>
            </div>

            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'DOB'); ?>
                <?php echo $form->textField($model, 'DOB', array('onfocus' => '$("#date_pick").trigger("click")', 'readonly' => 'readonly', 'class' => 'span5 input-xlarge')); ?>
                <?php echo $form->error($model, 'DOB'); ?>
            </div>
            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'CivilStatusID'); ?>
                <?php echo $form->dropDownList($model, 'CivilStatusID', $statusList, array('class' => 'span5 input-xlarge')); ?>
                <?php echo $form->error($model, 'CivilStatusID'); ?>
            </div>

            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'GenderID'); ?>
                <?php echo $form->dropDownList($model, 'GenderID', $genderList, array('class' => 'span5 input-xlarge')); ?>
                <?php echo $form->error($model, 'GenderID'); ?>
            </div>


        </fieldset>
    </div>
    <div class="span3">
        <fieldset>
            <legend>Location</legend>
            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'CountryID'); ?>
                <?php echo $form->dropDownList($model, 'CountryID', $countryList, array('empty' => '-- Select --', 'onchange' => 'return searchProvince(this.value)','class' => 'span7 input-xlarge', 'options' => array($selectedCountry => array('selected' => true)))); ?>
                <?php echo $form->error($model, 'CountryID'); ?>
            </div>
            <div id="rwandaLocation">
                <div class="row" style="margin-left: 0px !important">
                    <?php echo $form->labelEx($model, 'ProvinceID'); ?>
                    <div id="ajax_province">
                        <?php echo $form->dropDownList($model, 'ProvinceID', $provinceList, array('empty' => '-- Select --', 'onchange' => 'return searchDistrict(this.value)','class' => 'span7 input-xlarge')); ?>
                    </div>
                    <?php echo $form->error($model, 'ProvinceID'); ?> 
                </div>

                <div class="row" style="margin-left: 0px !important">

                    <?php echo $form->labelEx($model, 'DistrictID'); ?>
                    <div id="ajax_district">
                        <?php echo $form->dropDownList($model, 'DistrictID', $currentDistrict, array('empty' => '-- Select --', 'onchange' => 'return searchSector(this.value)','class' => 'span7 input-xlarge')); ?>
                    </div>
                    <?php echo $form->error($model, 'DistrictID'); ?>
                </div>

                <div class="row" style="margin-left: 0px !important">
                    <?php echo $form->labelEx($model, 'SectorID'); ?>
                    <div id="ajax_sector">
                        <?php echo $form->dropDownList($model, 'SectorID', $currentSector, array('empty' => '-- Select --', 'onchange' => 'return searchCell(this.value)','class' => 'span7 input-xlarge')); ?>
                    </div>
                    <?php echo $form->error($model, 'SectorID'); ?>
                </div>

                <div class="row" style="margin-left: 0px !important">
                    <?php echo $form->labelEx($model, 'CellID'); ?>
                    <div id="ajax_cell">
                        <?php echo $form->dropDownList($model, 'CellID', $currentCell, array('empty' => '-- Select --', 'onchange' => 'return searchVillage(this.value)','class' => 'span7 input-xlarge')); ?>
                    </div>
                    <?php echo $form->error($model, 'CellID'); ?>
                </div>

                <div class="row" style="margin-left: 0px !important">
                    <?php echo $form->labelEx($model, 'VillageID'); ?>
                    <div id="ajax_village">
                        <?php echo $form->dropDownList($model, 'VillageID', $currentVillage, array('empty' => '-- Select --','class' => 'span7 input-xlarge')); ?>
                    </div>
                    <?php echo $form->error($model, 'VillageID'); ?>
                </div>   
            </div>

        </fieldset>

    </div>
    <div class="span5">
        <fieldset>
            <legend>Others</legend>
            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'Phone'); ?>
                <?php echo $form->textField($model, 'Phone', array('size' => 15, 'maxlength' => 15,'class' => 'span7 input-xlarge')); ?>
                <?php echo $form->error($model, 'Phone'); ?>
            </div>

            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'Email'); ?>
                <?php echo $form->textField($model, 'Email', array('size' => 50, 'maxlength' => 50,'class' => 'span7 input-xlarge')); ?>
                <?php echo $form->error($model, 'Email'); ?>
            </div>

            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'PassportNumber'); ?>
                <?php echo $form->textField($model, 'PassportNumber', array('size' => 15, 'maxlength' => 15,'class' => 'span7 input-xlarge')); ?>
                <?php echo $form->error($model, 'PassportNumber'); ?>
            </div>     

            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'NationalID'); ?>
                <?php echo $form->textField($model, 'NationalID', array('size' => 20, 'maxlength' => 20,'class' => 'span7 input-xlarge')); ?>
                <?php echo $form->error($model, 'NationalID'); ?>
            </div>
            <div class="row" style="margin-left: 0px !important">
                <?php echo $form->labelEx($model, 'Comment'); ?>
                <?php echo $form->textArea($model, 'Comment', array('size' => 200, 'maxlength' => 200,'class' => 'span7 input-xlarge')); ?>
                <?php echo $form->error($model, 'Comment'); ?>
            </div>

        </fieldset>
    </div>
</div>
<div class="form-actions">
    <?php echo BHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>
<?php $this->endWidget(); ?>  
