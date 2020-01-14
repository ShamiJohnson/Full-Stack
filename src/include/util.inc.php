<?php

require_once "dbconnect.php";

function signin_block($location) {
	if (!isset($_SESSION)) {
		session_start();
	}

	if (!isset($_SESSION['userID'])) {
		header("Location: $location");
	}
}

/**
 * Perform general validation on field values for the following add/edit forms:
 *     manufacturer, category, network, location, faculty/staff
 * 
 * @param String $value
 *
 * @return bool Successful validation of value (true valdiated; false invalid)
 */
function general_validate($value, $max_length) {
	return $value !== "" && (strlen($value) <= $max_length);	
}


/**
 * Validate the values of add/edit asset form.
 *
 * @param array $values {
 *     Array of values for each the fields on the add/edit asset form.
 *
 *     @type string 
 * 
 * @return array Array containing the valid state of each of the values passed by $values
 */
function asset_validate($values) {

	// Needs to validate
	/*
		Asset Category
		Asset ID
		Purchace Date
		Manufacturer
		Model
		Warranty Date
		Location
		Notes
	*/

	$validations = Array();
	
	$valid_categories = getPrimaryKeys("CATEGORY", "CategoryID");
	$validations['category'] = in_array($values['category'], $valid_categories);

	$validations['id'] = general_validate($values['id'], 100);
	$validations['purchase_date'] = general_validate($values['purchase_date'], 15);

	$valid_manufacturers = getPrimaryKeys("MANUFACTURER", "ManufacturerID");
	$validations['manu'] = in_array($values['manu'], $valid_manufacturers);

	$validations['model'] = general_validate($values['model'], 50);

	$validations['warr_date'] = general_validate($values['warr_date'], 15);

	$valid_locations = getPrimaryKeys("LOCATION", "LocationID");
	$validations['locaton'] = in_array($values['location'], $valid_locations);

	$validations['notes'] = is_string($values['notes']) && (strlen($values['notes']) <= 500);

	return $validations;
}

/**
 * Return array "manu"=>true/false and "category"=>true/false based on valdiation of 
 * manu and category respectively. (i.e. true validated, false invalid)
 */
function model_number_validate($manu, $category) {
	$valid_manufacturers = getPrimaryKeys("MANUFACTURER", "ManufacturerID");
	//$valid_categories = getPrimaryKeys("CATEGORY", "CategoryID");

	$validations = Array();

	$validations['manu'] = in_array($manu, $valid_manufacturers);
	$validations['category'] = in_array($category, $valid_categories);
	//$validations['category'] = general_validate($category, 100);

	return $validations;
}

/**
 * Get array containing list of primary keys of table (must provide name of primary key)
 */ 
function getPrimaryKeys($table_name, $primary_key) {
	global $db;
	
	$stmt = $db->prepare("SELECT * FROM $table_name");
	$stmt->execute();

	$values = Array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		array_push($values, $row[$primary_key]);
		//echo $row['RoomNumber'] . " ";
		//echo $row['BuildingCode'] . " ";
		//echo $row['RoomNumber'] . " ";
	}
	
	return $values;
}

function getTableSize($table_name) {
	global $db;

	$stmt = $db->query("SELECT count(*) FROM $table_name WHERE Surplus=1");
	
	return $stmt->fetch(PDO::FETCH_NUM)[0];

}

function categoryCount($cat_id) {
	global $db;

	$stmt = $db->prepare("SELECT count(*) FROM ASSET WHERE CategoryID = ?");
	$stmt->execute([$cat_id]);

	return $stmt->fetch(PDO::FETCH_NUM)[0];
}

function surplusCount() {
	global $db;

	$stmt = $db->query("SELECT count(*) FROM ASSET WHERE Surplus=1");

	return $stmt->fetch(PDO::FETCH_NUM)[0];
}

function locationCount() {
	global $db;

	$stmt = $db->query("SELECT count(*) FROM LOCATION");

	return $stmt->fetch(PDO::FETCH_NUM)[0];
}

//echo categoryCount(1);

//echo getTableSize("ASSET");

//echo var_dump(model_number_validate("", ""));
//echo var_dump(getPrimaryKeys("LOCATION", "LocationID"));
//getPrimaryKeys("LOCATION", "LocationID");

/*
echo var_dump(asset_validate(array(
	"category" => "3",
	"id" => "983192",
	"purchase_date" => "5/12/2033",
	"manu" => "3",
	"model" => "2348293",
	"warr_date" => "3/3/3928",
	"location" => "32",
	"notes" => "Notes for the asset"
)));
*/

?>


