<?php

require_once "lib/php/helpers.php";

$conn = dbConnect();

function productSuggestTemplate($carry,$item){
return $carry.<<<HTML

<div class="centered_col col-sm-12 col-md-6 col-lg-3">
<div class="card3">
		<a href="product_detail.php?id=$item->id" class="fill-parent flex-parent flex-vertical">
				<img src="$item->image_thumb" class="flower_sm">
			<div class="content">
		<h5>$item->name<br>&dollar;$item->price</h5>
	       </div>
	   </a>
		</div>
		</div>
HTML;
}


$data = getQueryResults(
	$conn,
	isset($_GET['id'])?
	"SELECT * FROM test
	WHERE id <> {$_GET['id']}
	ORDER BY RAND() LIMIT 4":
	"SELECT * FROM test
	ORDER BY RAND() LIMIT 4"
);

?>

<ul class="container7 collapsed row gap">
	<?= array_reduce($data,'productSuggestTemplate'); ?>
</ul>