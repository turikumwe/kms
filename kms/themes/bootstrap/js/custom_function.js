function searchProvince(countryID) {
    var resetDistricts = '<select class="span7 input-xlarge" id="Individual_ProvinceID" name="Individual[ProvinceID]" onchange="return searchDistrict(this.value)"><option value="">-- Select --</option></select>';
    var resetSectors = '<select class="span7 input-xlarge" id="Individual_SectorID" name="Individual[SectorID]" onchange="return searchCell(this.value)"><option value="">-- Select --</option></select>';
    var resetCells = '<select class="span7 input-xlarge" id="Individual_CellID" name="Individual[CellID]" onchange="return searchVillage(this.value)"><option value="">-- Select --</option></select>';
    var resetVillage = '<select class="span7 input-xlarge" id="Individual_VillageID" name="Individual[VillageID]"><option value="">-- Select --</option></select>';
    url = '/kms/ajax/province';
    $.post(url, {
        countryID: countryID
    },
    function(data) {
        $('#ajax_province').empty().append(data);
    });
    // reset other district, sector, cell and villages
    $('#ajax_district').empty().append(resetDistricts);
    $('#ajax_sector').empty().append(resetSectors);
    $('#ajax_cell').empty().append(resetCells);
    $('#ajax_village').empty().append(resetVillage);
}
function searchDistrict(provinceID) {
    var resetSectors = '<select class="span7 input-xlarge" id="Individual_SectorID" name="Individual[SectorID]" onchange="return searchCell(this.value)"><option value="">-- Select --</option></select>';
    var resetCells = '<select class="span7 input-xlarge" id="Individual_CellID" name="Individual[CellID]" onchange="return searchVillage(this.value)"><option value="">-- Select --</option></select>';
    var resetVillage = '<select class="span7 input-xlarge" id="Individual_VillageID" name="Individual[VillageID]"><option value="">-- Select --</option></select>';
    url = '/kms/ajax/district';
    $.post(url, {
        provinceID: provinceID
    },
    function(data) {
        $('#ajax_district').empty().append(data);
    });
    // reset other sector, cell and villages
    $('#ajax_sector').empty().append(resetSectors);
    $('#ajax_cell').empty().append(resetCells);
    $('#ajax_village').empty().append(resetVillage);
}
function searchSector(districtID) {
    var resetCells = '<select class="span7 input-xlarge" id="Individual_CellID" name="Individual[CellID]" onchange="return searchVillage(this.value)"><option value="">-- Select --</option></select>';
    var resetVillage = '<select class="span7 input-xlarge" id="Individual_VillageID" name="Individual[VillageID]"><option value="">-- Select --</option></select>';
    url = '/kms/ajax/sector';
    $.post(url, {
        districtID: districtID
    },
    function(data) {
        $('#ajax_sector').empty().append(data);
    });
    // reset other cell and villages
    $('#ajax_cell').empty().append(resetCells);
    $('#ajax_village').empty().append(resetVillage);
}
function searchCell(sectorID) {
    var resetVillage = '<select class="span7 input-xlarge" id="Individual_VillageID" name="Individual[VillageID]"><option value="">-- Select --</option></select>';
    url = '/kms/ajax/cell';
    $.post(url, {
        sectorID: sectorID
    },
    function(data) {
        $('#ajax_cell').empty().append(data);
    });
    $('#ajax_village').empty().append(resetVillage);
}
function searchVillage(cellID) {
    url = '/kms/ajax/village';
    $.post(url, {
        cellID: cellID
    },
    function(data) {
        $('#ajax_village').empty().append(data);
    });
}

function get_product(product_id) {
    $("#wait").show();
    url = 'index.php?r=back/sale/selectproduct';
    $.post(url, {
        ref: product_id
    },
    function(data) {
        $('#selected-product').empty().append(data);
    });

    //empty the bar_code
    $('#bar_code').val('');
}
function checkSelectedCountry(countryID) {

    if (countryID !== "184") {
        $("#rwandaLocation").hide();
    } else {

        $("#rwandaLocation").show();
    }
}

