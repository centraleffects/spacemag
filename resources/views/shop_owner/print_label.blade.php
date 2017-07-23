<style tyle="text/css">
   <!--
   .barcodebox{
	   	width: 265px;
	   	border:1px  dashed #000;
	   	padding:20px;
	   	float:left;
	   	margin-left: 5px;
	   	margin-bottom: 5px;
	   	height: 96px;
	   	overflow: hidden;
   }
   #actionbtn{
	   	background: #ccc;
	   	padding: 10px;
	   	margin-bottom:10px;
   }
   #content{
   		padding: 10px;
   }
   #right{
	   	float:right;
	   	width: 40%;
	   	margin-top: -5px;
   }
   #left{
	   	float:left;
	   	width: 50%;
	   	padding-left: 10px;
   }
   .article-name{
   		font-weight: bold;
    	margin-top: 3px;
   }
   .barcode{
		background: #fff;
	    margin-top: -36px;
	    width: 100px;
	    z-index: 9999;
	    position: absolute;
	    margin-left: 130px;
	    font-size: 20px;
	    padding-left: 10px;
	    padding-right: 10px;
	    padding-top: 3px;
	    padding-bottom: 3px;
   }
   body{
   		margin:0;
   		padding: 0;
   }
   img{
   		width: 100%;
    	height: 67px;
   }
   button{
   	font-size: 15px;
   }
   @media screen
   {
     
   }

   @media print
   {
     body {
		   size: landscape;
		   margin: 0;
		   padding: 0;
		}
	 #actionbtn{
	 	display: none;
	 }
   }
   
   -->
</style>
<div id="actionbtn">
	<div id="left">Please set the paper orientation to Landscape in your printer dialog</div>
	<div id="right"><button onclick="window.print()">Click here to print these labels</button></div>
	<br>
</div>
<div id="content">
	@for ($i = 1; $i <= 15; $i++)
	<div class="barcodebox">
		<div><img src="{{ Helper::getBarCode( $article->barcode_id ) }}"/></div>
		<div class="barcode">{{$article->barcode_id}}</div>
		<div class="article-name">{{$article->name}}</div>
		<div>Cost: {{$prices->price}} {{$shop->currency}}</div>
	</div>
	@endfor
</div>