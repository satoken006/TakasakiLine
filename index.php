<html>

<head>
    <meta charset="utf-8">
	<title>高崎線 駅データ</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div id="title">
		高崎線　駅データ
	</div>
	<hr size="5" color="green">

    <?php

    require "php/function.php";

    ?>

	<form action="index.php" method="get">
		<table>
			<tr>
				<td id="sort_ui">
					ソートする項目
				</td>
				<td id="sort_ui">
					ソートする方向
				</td>
			</tr>
			<tr>
				<td id="sort_ui">
					<select name="sort" onchange="javascript:submit()">
						<option value="id" <?php setSelected("sort", "id"); ?> >番号</option>
						<option value="pronounce" <?php setSelected("sort", "pronounce"); ?> >よみ</option>
						<option value="people" <?php setSelected("sort", "people"); ?> >乗車人員</option>
						<option value="section" <?php setSelected("sort", "section"); ?> >区間距離</option>
						<option value="open" <?php setSelected("sort", "open"); ?> >開業年</option>
					</select>
				</td>
				<td id="sort_ui">
					<input type="radio" name="direction" value="ASC" onclick="javascript:submit()" <?php setChecked("direction", "ASC"); ?> >昇順
					<input type="radio" name="direction" value="DESC" onclick="javascript:submit()" <?php setChecked("direction", "DESC"); ?> >降順
				</td>
			</tr>
		</table>
	</form>

	<?php

    require "../php/setConnection_TakasakiLine.php";

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

	<div id="description">
		● : 全ての車両が停車<br>
		▲ : 一部の車両が停車<br>
		レ : 通過
	</div>
	<div id="description">
		※区間距離は、特定の駅と上野寄りにある隣の駅との距離(「大宮」ならば「さいたま新都心」との距離)
	</div>
	<div id="description">
		参考ページ<br>
		<a href="http://tanaken73.gozaru.jp/database/takasaki.html">高崎線（上野～高崎）</a>
	</div>
</body>

</html>