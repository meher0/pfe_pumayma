<!DOCTYPE html>
<html>
<head>
    <title>Réunion.TN</title>
    <link rel="stylesheet" href="css/cssfile.css">

</head>

<header>
<div class="logo"> المنصة الرقمية للاجتمعات الوزارية <a href="/welcome" >
  </a></span></div>
		   @if (Route::has('login'))

		   @auth
		   <span class="sign">  <a href="{{ url('/home') }}"class="act">الحساب الخاص</a></span>
		   @else
           <span class="sign">  <a href="{{ route('login') }}" class="act">تسجيل الدخول</a></span>
			  
		   @endauth

				  @endif
				</span>

	</header>


<body >


    <div class="slider">
		<!-- fade css -->
		<div class="myslide fade">
			<div class="txt">
			<h1>قم بانشاء حسابك الخاص</h1>

				<p>المنصةالرقمية </p>
				<p>للاجتمعات الرسمية </p>
			</div>
			<img src="images\1.jpg" style="width: 100%; height: 100%;">
		</div>

		<div class="myslide fade">
		<div class="txt">
			<h1>قم بانشاء حسابك الخاص</h1>

				<p>المنصةالرقمية </p>
				<p>للاجتمعات الرسمية </p>
			</div>
			<img src="images\2.jpg" style="width: 100%; height: 100%;">
		</div>

		<div class="myslide fade">
		<div class="txt">
			<h1>قم بانشاء حسابك الخاص</h1>

			<p>المنصةالرقمية </p>
				<p>للاجتمعات الرسمية </p>			</div>
			<img src="images\4.jpg" style="width: 100%; height: 100%;">
		</div>



		<!-- /fade css -->

		<!-- onclick js -->
		<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  		<a class="next" onclick="plusSlides(1)">&#10095;</a>

		<div class="dotsbox" style="text-align:center">
			<span class="dot" onclick="currentSlide(1)"></span>
			<span class="dot" onclick="currentSlide(2)"></span>
			<span class="dot" onclick="currentSlide(3)"></span>

		</div>
		<!-- /onclick js -->
	</div>

<script src="js/jsfile.js"></script>
</body>
</html>

