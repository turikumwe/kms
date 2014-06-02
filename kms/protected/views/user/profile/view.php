<?php
/* @var $this IndividualController */
/* @var $model Individual */

$this->breadcrumbs = array(
    'Individuals' => array('index'),
    $model->LastName,
);
$this->renderPartial('_UserMenu', array('active' => 'none', 'editAction' => true, 'id' => $model->IndividualID, 'userOption'=>true));
?>
<div class="span9">
    <h1 style="text-align: center;">Individual view</h1>
    <?php echo CHtml::errorSummary($model); ?>

    <div class="well" style="min-height: 350px;">
        <ul class="nav nav-tabs" style="width: 100% !important">
            <li class="" style="float: right !important" ><a data-toggle="tab" id="doc" href="#document">Documents</a></li>
            <li class="" style="float: right !important" ><a data-toggle="tab" id="con" href="#contact">Contacts</a></li>
            <li class="" style="float: right !important" ><a data-toggle="tab" id="loc" href="#location">Location</a></li>
            <li class="active" style="float: right !important" ><a data-toggle="tab" id="ide" href="#identification">Identification</a></li>
        </ul> 
        <div class="tab-content" id="myTabContent">
            <div id="identification" class="tab-pane active">
                <table class="items table table-striped table-bordered table-condensed">
                    <tbody class="detail-data">
                        <tr class="even"><th>First Name</th><td><?php echo $model->FirstName; ?></td></tr>
                        <tr class="odd"><th>Last Name</th><td><?php echo $model->LastName; ?></td></tr>
                        <tr class="even"><th>Other Name</th><td><?php echo $model->OtherName; ?></td></tr>
                        <tr class="odd"><th>Dob</th><td><?php echo date('d/m/Y', strtotime($model->DOB)); ?></td></tr>
                        <tr class="even"><th>Passport Number</th><td><?php echo $model->PassportNumber; ?></td></tr>
                        <tr class="odd"><th>National ID</th><td><?php echo $model->NationalID; ?></td></tr>
                        <tr class="odd"><th>Civil Status</th><td><?php echo Civilstatus::model()->findByPk($model->CivilStatusID)->Name; ?></td></tr>
                        <tr class="even"><th>Gender</th><td><?php echo Gender::getNameByID($model->GenderID); ?></td></tr>
                        <tr class="odd"><th>Created On</th><td><?php echo date('d/m/Y h:m', strtotime($model->CreatedOn)); ?></td></tr>
                        <tr class="even"><th>Short Bio</th><td><?php echo $model->Comment; ?></td></tr>
                    </tbody>
                </table>                
            </div>
            <div id="location" class="tab-pane">
                <table class="items table table-striped table-bordered table-condensed">
                    <tbody class="detail-data">
                        <tr class="odd"><th>Country</th><td><?php echo Country::getNameByID($model->CountryID); ?></td></tr>
                        <tr class="even"><th>Province</th><td><span class="null"><?php echo Province::getNameByID($model->ProvinceID); ?></span></td></tr>
                        <tr class="odd"><th>District</th><td><span class="null"><?php echo District::getNameByID($model->DistrictID); ?></span></td></tr>
                        <tr class="even"><th>Sector</th><td><span class="null"><?php echo Sector::getNameByID($model->SectorID); ?></span></td></tr>
                        <tr class="odd"><th>Cell</th><td><span class="null"><?php echo Cell::getNameByID($model->CellID); ?></span></td></tr>
                        <tr class="even"><th>Village</th><td><span class="null"><?php echo Village::getNameByID($model->VillageID); ?></span></td></tr>
                    </tbody>
                </table>  
            </div>
            <div id="contact" class="tab-pane">
                <div id="location" class="tab-pane">
                    <table class="items table table-striped table-bordered table-condensed">
                        <tbody class="detail-data">
                            <tr><th colspan="2" style="color: green;" ><em>Primary contacts</em></th></tr>
                            <tr class="odd"><th>Phone</th><td>0788683000</td></tr>
                            <tr class="even"><th>Email</th><td>vit01@gmail.com</td></tr>
                            <tr><th colspan="2" style="color: green;" ><em><br />Secondary contacts</em><a href="#add_contact" data-toggle="modal" style="float: right;">Add contact</a></th></tr>
                            <?php if (count($contacts) > 0) { ?>
                                <?php
                                foreach ($contacts as $contact) {
                                    echo '<tr class="odd"><th>' . ContactCategory::getNameByID($contact->SocialNetworkTypeID) . '</th><td>' . $contact->Address . '<div style="float: right;">'
                                    . '<a href="' . Yii::app()->createUrl("/user/profile/delCont", array("id" => $contact->SocialNetworkID)) . '" rel="tooltip" class="delete" data-original-title="Delete"><i class="icon-trash"></i></a></div></td></tr>';
                                }
                                ?>

                            <?php } else { ?>
                                <tr><th colspan="2" >None</th></tr>
                            <?php } ?>
                        </tbody>
                    </table>  
                </div>
            </div>
            <div id="document" class="tab-pane">

                <?php if (Yii::app()->user->hasFlash('error')):
                    ?>
                    <div class="info" style="width: 100%;">
                        <div class="alert in alert-block fade alert-error"><a data-dismiss="alert" class="close">×</a><?php echo Yii::app()->user->getFlash('error'); ?></div>
                    </div>
                <?php endif; ?>
                <?php if (Yii::app()->user->hasFlash('success')):
                    ?>
                    <div class="info" style="width: 100%;">
                        <div class="alert in alert-block fade alert-success"><a data-dismiss="alert" class="close">×</a><?php echo Yii::app()->user->getFlash('success'); ?></div>
                    </div>
                <?php endif; ?>
                <div style="float: right; width: 100%; text-align: right"><a href="#add_document" data-toggle="modal" style="float: right;"><em>Add a document</em></a></div>
                <br /><br />
                <?php if (count($userDocs) > 0) { ?>
                    <h2><em>Uploaded documents</em></h2>
                    <?php
                    $sector = new Sector();
                    $this->widget('bootstrap.widgets.TbGridView', array(
                        'type' => 'striped bordered condensed',
                        'dataProvider' => $document->searchByIndividual($model->IndividualID),
                        'columns' => array(
                            array('name' => 'DocumentTypeID', 'header' => 'Document category', 'value' => 'DocumentCategory::getNameByID($data->DocumentTypeID)',
                                'type' => 'raw'),
                            array('name' => 'Name', 'header' => 'Document Name', 'value' => 'CHtml::link($data->DocumentName, Yii::app()
 ->createUrl("/user/profile/get",array("id"=>$data->DocumentID)))',
                                'type' => 'raw'),
                            array('name' => 'SubmitDate', 'header' => 'Uploaded on', 'value' => 'date("d-M, Y H:i:s",strtotime($data->SubmitDate))'),
                            array(
                                'class' => 'bootstrap.widgets.TbButtonColumn',
                                'template' => '{delete}',
                                'buttons' => array(
                                    'delete' => array(
                                        'url' => 'Yii::app()->createUrl("/user/profile/del",array("id"=>$data->DocumentID))', // the PHP expression for generating the URL of the button
                                        'imageUrl' => '...', // image URL of the button. If not set or false, a text link is used
                                        'click' => 'js:delDoc()',
                                    ),
                                ),
                            ),
                        ),
                    ));
                    ?>
                <?php } else { ?>
                    <div style="min-height: 100px; width: 100%;">
                        <div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign">
                                <h2>No document found!</h2>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div id="add_document" style="display: none;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel"><em>Upload a document...</em></h3>
                </div>
                <?php if (count($documentCategories) > 0) { ?>
                    <div class="modal-body">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'document-form',
                            'action' => Yii::app()->createUrl("/user/profile/addDocument"),
                            'enableAjaxValidation' => false,
                            'htmlOptions' => array('enctype' => 'multipart/form-data')
                        ));
                        ?>
                        <input type="hidden" name="Document[IndividualID]" value="<?php echo $model->IndividualID; ?>" />
                        <div style="margin-left: 0px !important" class="row">

                            <em><strong>Document type</strong></em><br />
                            <select id="Individual_DocumentTypeID" name="Document[DocumentTypeID]">
                                <?php
                                foreach ($documentCategories as $category) {
                                    echo '<option value="' . $category->DocumentTypeID . '">' . $category->Name . '</option>';
                                }
                                ?>
                            </select>    
                            <div style="margin-left: 0px !important" class="row">
                                <div class="form">
                                    <?php echo $form->errorSummary($document); ?>
                                    <div class="row" style="margin-left: 0px !important;">
                                        <?php echo $form->labelEx($document, 'DocFile'); ?>
                                        <?php echo $form->fileField($document, 'DocFile', array('size' => 36, 'maxlength' => 255)); ?>
                                        <?php echo $form->error($document, 'DocFile'); ?>
                                    </div>

                                    <div class="row" style="margin-left: 0px !important;">
                                        <?php echo $form->labelEx($document, 'Summary'); ?>
                                        <?php echo $form->textArea($document, 'Summary', array('rows' => 6, 'cols' => 50, 'maxlength' => 200)); ?>
                                        <?php echo $form->error($document, 'Summary'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                <div class="row buttons">
                                    <?php echo CHtml::submitButton($document->isNewRecord ? 'Create' : 'Save', array("class" => "btn btn-primary")); ?>
                                </div>
                            </div>

                            </form>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div>
                <?php } else {
                    ?>
                    <div class="modal-body">
                        <div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign">No document category defined. Please define some document category</span>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<div id="add_contact" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Adding contact...</h3>
    </div>
    <div class="modal-body">
        <form action="<?php echo Yii::app()->createUrl("/user/profile/addContact"); ?>" id="add_contact" method="POST">
            <input type="hidden" name="ContactAddress[IndividualID]" value="<?php echo $model->IndividualID; ?>" />
            <div style="margin-left: 0px !important" class="row">
                <em><strong>Contact type</strong></em><br />
                <?php if (count($contactCategories) > 0) { ?>
                    <select id="Individual_SectorID" name="ContactAddress[SocialNetworkTypeID]">
                        <?php
                        foreach ($contactCategories as $category) {
                            echo '<option value="' . $category->SocialNetworkID . '">' . $category->Name . '</option>';
                        }
                        ?>
                        <option value="">-- Select--</option>
                    </select>    
                <?php } ?>
                <div style="margin-left: 0px !important" class="row">
                    <em><strong>Contact</strong></em><br />
                    <input type="text" maxlength="30" name="ContactAddress[Address]">              
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <input type="submit" value="Add" class="btn btn-primary" />
                </div>

        </form>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#<?php echo $active_tab; ?>").trigger("click");
    });
</script>
<style>
    .detail-data th {
        width: 20%;
    }
</style>
<script type="text/javascript">
    function delDoc() {
        $(document).on('click', '#yw0 a.delete', function() {
            if (!confirm('Are you sure you want to delete this item?'))
                return false;
            var th = this;
            var afterDelete = function() {
            };
            $.fn.yiiGridView.update('yw0', {
                type: 'POST',
                url: $(this).attr('href'),
                success: function(data) {
                    location.reload();
                },
                error: function(XHR) {
                    return afterDelete(th, false, XHR);
                }
            });
            return false;
        });
    }
</script>
