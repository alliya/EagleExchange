<?php

require("php/connect.php");

try
{
$ctr=0;
while($ctr<150)
{
	$category = array("BOOKS","ELECTRONICS","CLOTHES","FOOD","TICKETS","HOBBIES","UNCATEG");
	$condition = array("USED","NEW");
	$duration = array(1,1);
	$adj = array("BIG","SMALL","LADY OWNED","WHITE","BLUE","RED","MEDIUM","SHORT","LONG","BROWN");
	$id = array(101058,100149,100175,100624);
	
	$random_cat = array_rand($category);
	$random_con = array_rand($condition);
	$random_dur = array_rand($duration);
	$random_adj = array_rand($adj);
	$random_id = array_rand($id);
	
	$item_name = $condition[$random_con] . " " . $adj[$random_adj] . " " . $category[$random_cat];
	$item_price = rand(50,5000);
	$item_dur = date("Y-m-d H:i:s", strtotime("+".$duration[$random_dur]." days"));
	$item_cat = $category[$random_cat];
	$item_description = "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit";
	$item_seller = $id[$random_id];
	$item_condition = $condition[$random_con];
	
	$query = "INSERT INTO auction (`condition` , name, seller_id, category, duration, price, description, status) VALUES (:condition, :name, :seller_id, :category, :duration, :price, :description, 'ONGOING')";
	
	$params = array(
	':name'=>$item_name, 
	':seller_id'=>$item_seller, 
	':category'=>$item_cat,  
	':duration'=> $item_dur, 
	':price'=>$item_price, 
	':description'=>$item_description,
	':condition' => $item_condition
	);
	
	$stmt = $db->prepare($query); 
    $result = $stmt->execute($params);
	$ctr++;
}
}
catch(PDOException $ex)
{
	echo  mysql_error() . " dfefefefefef";
	die("Failed to run query: " . $ex->getMessage()); 
}
?>