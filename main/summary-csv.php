<?php
require_once "../include/summary_csv_util.php";
header("Content-Type:text/csv");
header("Content-Disposition: attachment; filename=report.csv");

showAll();
