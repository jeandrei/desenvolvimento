<!DOCTYPE html>
<title>My Example</title>

 <!--Bootstrap CSS-->
 <link rel="stylesheet" href="css/bootstrap.min.css">
   
   <!--CSS MIDIFICAÇÕES SOBESCREVER Botstrap-->
   <link rel="stylesheet" href="css/style.css">

  


<style>
body {
padding-top: 1em;
}	
</style> <div class="container-fluid">
		
<ul id="clothing-nav" class="nav nav-tabs" role="tablist">
	
<li class="nav-item">
<a class="nav-link active" href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="#hats" role="tab" id="hats-tab" data-toggle="tab" aria-controls="hats">Hats</a>
</li>

<!-- Dropdown -->
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
Footwear
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="#dropdown-shoes" role="tab" id="dropdown-shoes-tab" data-toggle="tab" aria-controls="dropdownShoes">Shoes</a>
<a class="dropdown-item" href="#dropdown-boots" role="tab" id="dropdown-boots-tab" data-toggle="tab" aria-controls="dropdownBoots">Boots</a>
</div>
</li>

</ul>

<!-- Content Panel -->
<div id="clothing-nav-content" class="tab-content">

<div role="tabpanel" class="tab-pane fade show active" id="home" aria-labelledby="home-tab">
<p>Welcome home! Click on the tabs to see the content change.</p>
</div>

<div role="tabpanel" class="tab-pane fade" id="hats" aria-labelledby="hats-tab">
<p>A hat is a head covering. It can be worn for protection against the elements, ceremonial reasons, religious reasons, safety, or as a fashion accessory.</p>
</div>

<div role="tabpanel" class="tab-pane fade" id="dropdown-shoes" aria-labelledby="dropdown-shoes-tab">
<p>A shoe is an item of footwear intended to protect and comfort the human foot while doing various activities. Shoes are also used as an item of decoration.</p>
</div>

<div role="tabpanel" class="tab-pane fade" id="dropdown-boots" aria-labelledby="dropdown-boots-tab">
<p>A boot is a type of footwear and a specific type of shoe. Most boots mainly cover the foot and the ankle, while some also cover some part of the lower calf. Some boots extend up the leg, sometimes as far as the knee or even the hip.</p>
</div>

</div>


</div>
		
<!--jquery-->
<script src="js/jquery-3.3.1.min.js"></script> 

<!--jquery mask-->
<script src="js/jquery.mask.js" data-autoinit="true"></script>


<!--Botstrap main-->
<script src="js/bootstrap.min.js"></script>

<!--Javascript funções-->
<script src="js/main.js"></script>
