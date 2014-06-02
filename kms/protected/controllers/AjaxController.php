<?php

class AjaxController extends Controller {

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionProvince() {
        $countryID = $_POST['countryID'];
        $provinces = Province::model()->findAll('CountryID = ' . $countryID);
        if (count($provinces) > 0) {
            echo "<select name='Individual[ProvinceID]' onchange='return searchDistrict(this.value)' class='span7 input-xlarge'>";
            echo "<option value=''> -- Select -- </option>";
            foreach ($provinces as $province) {
                echo "<option value='" . $province['ProvinceID'] . "'>" . $province['Name'] . "</option>";
            }
            echo "</select>";
        } else {
            echo "<select name='Individual[ProvinceID]' onchange='return searchDistricts(this.value)' class='span7 input-xlarge'>";
            echo "<option value=''> -- Select -- </option>";
            echo "</select>";
        }
    }

    public function actionDistrict() {
        $provinceID = $_POST['provinceID'];
        $districts = District::model()->findAll('ProvinceID = ' . $provinceID);
        if (count($districts) > 0) {
            echo "<select name='Individual[DistrictID]' onchange='return searchSector(this.value)' class='span7 input-xlarge' >";
            echo "<option value=''> -- Select -- </option>";
            foreach ($districts as $district) {
                echo "<option value='" . $district['DistrictID'] . "'>" . $district['Name'] . "</option>";
            }
            echo "</select>";
        } else {
            echo "<select name='Individual[DistrictID]' onchange='return searchSector(this.value)' class='span7 input-xlarge' >";
            echo "<option value=''> -- Select -- </option>";
            echo "</select>";
        }
    }

    public function actionSector() {
        $districtID = $_POST['districtID'];
        $sectors = Sector::model()->findAll('DistrictID = ' . $districtID);
        if (count($sectors) > 0) {
            echo "<select name='Individual[SectorID]' onchange='return searchCell(this.value)' class='span7 input-xlarge' >";
            echo "<option value=''> -- Select -- </option>";
            foreach ($sectors as $sector) {
                echo "<option value='" . $sector['SectorID'] . "'>" . $sector['Name'] . "</option>";
            }
            echo "</select>";
        } else {
            echo "<select name='Individual[SectorID]' onchange='return searchCell(this.value)' class='span7 input-xlarge' >";
            echo "<option value=''> -- Select -- </option>";
            echo "</select>";
        }
    }

    public function actionCell() {
        $sectorID = $_POST['sectorID'];
        $cells = Cell::model()->findAll('SectorID = ' . $sectorID);
        if (count($cells) > 0) {
            echo "<select name='Individual[CellID]' onchange='return searchVillage(this.value)' class='span7 input-xlarge' >";
            echo "<option value=''> -- Select -- </option>";
            foreach ($cells as $cell) {
                echo "<option value='" . $cell['CellID'] . "'>" . $cell['Name'] . "</option>";
            }
            echo "</select>";
        } else {
            echo "<select name='Individual[CellID]' onchange='return searchVillage(this.value)' class='span7 input-xlarge' >";
            echo "<option value=''> -- Select -- </option>";
            echo "</select>";
        }
    }

    public function actionVillage() {
        $cellID = $_POST['cellID'];
        $villages = Village::model()->findAll('CellID = ' . $cellID);
        if (count($villages) > 0) {
            echo "<select name='Individual[VillageID]' class='span7 input-xlarge'>";
            echo "<option value=''> -- Select -- </option>";
            foreach ($villages as $village) {
                echo "<option value='" . $village['VillageID'] . "'>" . $village['Name'] . "</option>";
            }
            echo "</select>";
        } else {
            echo "<select name='Individual[VillageID]' class='span7 input-xlarge'>";
            echo "<option value=''> -- Select -- </option>";
            echo "</select>";
        }
    }

}
