<?php

$sort = "";
if( isset($_GET["sort"]) ){
    if( $_GET['sort'] != null ){
        $sort = " order by " . $_GET["sort"];
    }
}

if( isset($_GET["direction"]) ){
    $direction = "";
    if( $_GET["direction"] != null ){
        $direction = $_GET["direction"];
    }
}

$columnName = array("番号", "駅名", "よみ", "乗車人員(人/日)", "区間距離(km)", "営業キロ", "開業年", "通勤快速", "快速アーバン");

$q = "SELECT * FROM takasaki_line where 1" . $sort . " " . $direction;

echo "<table border='1' id='database'>";

echo "<tr>";
for( $i = 0 ; $i < count($columnName) ; $i ++ ){
    echo "<th>" . $columnName[$i] . "</th>";
}
echo "</tr>";

foreach( $connection->query( $q ) as $column) {
    echo "<tr>";
    for ( $i = 0 ; $i < 9 ; $i ++ ) {
        $cell = 
            ($i == 3) ? 
                number_format($column[$i])
             : 
                $column[$i];
        echo "<td>" . $cell . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>