<div id='pleft'>
<h2>Search Results</h2>
  	
<?php
if (count($results)){
	foreach ($results as $key => $list){
		echo "<div class='productlisting'>";
  		?>
  		<img src="<?php echo 'http://localhost:8080/stalin_projects/codeig_shoppingcart'.$list['thumbnail'];?>" border='0' class='thumbnail'/>
   <?php 
		echo "<h4>";
		echo anchor('welcome/product/'.$list['id'],$list['name']);
		echo "</h4>\n";
		echo $list['shortdesc']."<br/>". anchor('welcome/cart/'.$list['id'],'add to cart')."</div>";	
	}
}else{
	echo "<p>Sorry, no records were found to match your search term.</p>";
}
?>
</div>