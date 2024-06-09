<!doctype html>
<html class="no-js" lang="en">
    <head>
        <!-- meta data -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!--font-family-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

		<link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet">
        
        <!-- title of site -->
        <title>TorqueGT</title>

        <!-- For favicon png -->
		<link rel="shortcut icon" type="image/icon" href="assets/logo/favicon.png"/>
       
        <!--font-awesome.min.css-->
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!--linear icon css-->
		<link rel="stylesheet" href="assets/css/linearicons.css">

        <!--flaticon.css-->
		<link rel="stylesheet" href="assets/css/flaticon.css">

		<!--animate.css-->
        <link rel="stylesheet" href="assets/css/animate.css">

        <!--owl.carousel.css-->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
		
        <!--bootstrap.min.css-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- bootsnav -->
		<link rel="stylesheet" href="assets/css/bootsnav.css" >	
        
        <!--style.css-->
        <link rel="stylesheet" href="assets/css/style.css">
        
        <!--responsive.css-->
        <link rel="stylesheet" href="assets/css/responsive.css">
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		
        <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
	
	<body>
    <?php
    require_once "include.php";
    require_once "Database.php";
    $db = new Database();
    $brands = $db->select("SELECT id, name FROM brand");
    $trims = $db->select("SELECT DISTINCT trim FROM cars");
    $values = $db->select("SELECT DISTINCT value FROM cars");
    $prices = $db->select("SELECT MAX(price) AS max, MIN(price) AS min FROM cars");
    $years = $db->select("SELECT DISTINCT(year) FROM cars ORDER BY year ASC");
    ?>
		<!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->
	
		<!--welcome-hero start -->
		<section id="home" class="welcome-hero">

			<!-- top-area Start -->
			<div class="top-area">
				<div class="header-area">
					<!-- Start Navigation -->
				    <nav class="navbar navbar-default bootsnav  navbar-sticky navbar-scrollspy"  data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

				        <div class="container">

				            <!-- Start Header Navigation -->
				            <div class="navbar-header">
				                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
				                    <i class="fa fa-bars"></i>
				                </button>
				                <a class="navbar-brand" href="index.php">TorqueGT<span></span></a>

				            </div><!--/.navbar-header-->
				            <!-- End Header Navigation -->

				            <!-- Collect the nav links, forms, and other content for toggling -->
				            <div class="collapse navbar-collapse menu-ui-design" id="navbar-menu">
				                <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
				                    <li class=" scroll active"><a href="#home">начало</a></li>
				                    <li class="scroll"><a href="#service">сервиз</a></li>
									<li class="scroll"><a href="#new-cars">нови коли</a></li>
									<li class="scroll"><a href="#featured-cars">препоръчани коли</a></li>
				                    <!--/<li class="scroll"><a href="#brand">брандове</a></li>-->
				                    <li class="scroll"><a href="#contact">свържете се</a></li>
				                </ul><!--/.nav -->
				            </div><!-- /.navbar-collapse -->
				        </div><!--/.container-->
				    </nav><!--/nav-->
				    <!-- End Navigation -->
				</div><!--/.header-area-->
			    <div class="clearfix"></div>

			</div><!-- /.top-area-->
			<!-- top-area End -->

			<div class="container">
				<div class="welcome-hero-txt">
					<h2>вземи си своята мечтана кола на разумна цена!</h2>
					<p>
						Богат асортимент от вносни автомобили
					</p>
					<button class="welcome-btn" onclick="window.location.href='#'">свържете се!</button>
				</div>
			</div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="model-search-content">
                            <form action="search_results.php" method="get">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-2 col-sm-12">
                                        <div class="single-model-search">
                                            <h2>марка</h2>
                                            <div class="model-select-icon">
                                                <?php
                                                echo "<select class=\"form-control\" name=\"search_brand\" id=\"search_brand\">";
                                                echo "<option value=''>Избери</option>";
                                                foreach ($brands as $brand) {
                                                    $selected = isset($_POST['search_brand']) && $_POST['search_brand'] == $brand['id'] ? 'selected' : '';
                                                    echo "<option $selected value='{$brand['id']}'>{$brand['name']}</option>";
                                                }
                                                echo "</select>"
                                                ?>
                                            </div><!-- /.model-select-icon -->
                                        </div>
                                        <div class="single-model-search">
                                            <h2>модел</h2>
                                            <div class="model-select-icon">
                                                <select class="form-control" id="search_model" name="search_model">
                                                    <option value="default">избери</option><!-- /.option-->
                                                </select><!-- /.select-->
                                            </div><!-- /.model-select-icon -->
                                        </div>
                                    </div>
                                    <div class="col-md-offset-1 col-md-2 col-sm-12">
                                        <div class="single-model-search">
                                            <h2>Състояние</h2>
                                            <div class="model-select-icon">
                                                <select class="form-control" name="condition">
                                                    <option value="">Избери</option><!-- /.option-->
                                                    <?php
                                                    foreach ($values as $value) {
                                                        $selected = isset($_POST['selected_value']) && $_POST['selected_value'] == $value['value'] ? 'selected' : '';
                                                        echo "<option $selected value='{$value['value']}'>{$value['value']}</option>";
                                                    }
                                                    ?>
                                                </select><!-- /.select-->
                                            </div><!-- /.model-select-icon -->
                                        </div>
                                        <div class="single-model-search">
                                            <h2>Шаси</h2>
                                            <div class="model-select-icon">
                                                <select class="form-control" name="chassis">
                                                    <option value="">Избери</option><!-- /.option-->
                                                    <?php
                                                    foreach ($trims as $trim) {
                                                        $selected = isset($_POST['selected_trim']) && $_POST['selected_trim'] == $trim['trim'] ? 'selected' : '';
                                                        echo "<option $selected value='{$trim['trim']}'>{$trim['trim']}</option>";
                                                    }
                                                    ?>
                                                </select><!-- /.select-->
                                            </div><!-- /.model-select-icon -->
                                        </div>
                                    </div>
                                    <div class="col-md-offset-1 col-md-2 col-sm-12">
                                        <div class="single-model-search">
                                            <h2>Изберете година</h2>
                                            <div class="model-select-icon">
                                                <select class="form-control" name="year">
                                                    <option value="">избери</option><!-- /.option-->
                                                    <?php
                                                    foreach ($years as $year){
                                                        echo "<option value='{$year['year']}'>{$year['year']}</option>";
                                                    }
                                                    ?>
                                                </select><!-- /.select-->
                                            </div><!-- /.model-select-icon -->
                                        </div>
                                        <div class="single-model-search">
                                            <h2>цена до:</h2><span id="demo"></span>
                                            <div class="slidecontainer">
                                                <?php
                                                foreach ($prices as $price) {
                                                    echo "<input type=\"range\" min='{$price['min']}' max='{$price['max']}' value=\"0\" class=\"slider\" id=\"myRange\" name=\"price\">";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="single-model-search text-center">
                                            <button type="submit" class="welcome-btn model-search-btn">Търси</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#search_brand').change(function() {
                        var brandId = $(this).val();
                        if (brandId) {
                            $.ajax({
                                type: 'POST',
                                url: 'get_car_models.php',
                                data: { brand_id: brandId },
                                success: function(response) {
                                    $('#search_model').html(response);
                                }
                            });
                        } else {
                            $('#search_model').html('<option value="default">избери</option>');
                        }
                    });
                });

                var slider = document.getElementById("myRange");
                var output = document.getElementById("demo");
                output.innerHTML = slider.value; // Display the default slider value

                // Update the current slider value (each time you drag the slider handle)
                slider.oninput = function() {
                    output.innerHTML = this.value;
                }
            </script>
		</section><!--/.welcome-hero-->
		<!--welcome-hero end -->

		<!--service start -->
		<section id="service" class="service">
			<div class="container">
				<div class="service-content">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<div class="single-service-item">
								<div class="single-service-icon">
									<i class="flaticon-car"></i>
								</div>
								<h2><a href="#">най-големият вносител <span> на</span> нови</a></h2>
								<p>
									и запазени автомобили втора ръка от цял свят 
								</p>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="single-service-item">
								<div class="single-service-icon">
									<i class="flaticon-car-repair"></i>
								</div>
								<h2><a href="#">годишно обслужване</a></h2>
								<p>
									срещу атрактивни абонаментни цени 
								</p>
							</div>
						</div>
						<div class="col-md-4 col-sm-6">
							<div class="single-service-item">
								<div class="single-service-icon">
									<i class="flaticon-car-1"></i>
								</div>
								<h2><a href="#">помощ при застраховане и каско</a></h2>
								<p>
									експресно обслужване при закупуване на полица при нас! 
								</p>
							</div>
						</div>
					</div>
				</div>
			</div><!--/.container-->

		</section><!--/.service-->
		<!--service end-->

		<!--new-cars start -->
		<section id="new-cars" class="new-cars">
			<div class="container">
				<div class="section-header">
					<p>Разгледайте <span>най-новите</span> ни предложения </p>
					<h2>Нови попълнения</h2>
				</div><!--/.section-header-->
				<div class="new-cars-content">
					<div class="owl-carousel owl-theme" id="new-cars-carousel">
						<div class="new-cars-item">
							<div class="single-new-cars-item">
								<div class="row">
									<div class="col-md-7 col-sm-12">
										<div class="new-cars-img">
											<img src="assets/images/new-cars-model/as22_e01_037_OMP_A4_web.jpg" alt="img"/>
										</div><!--/.new-cars-img-->
									</div>
									<div class="col-md-5 col-sm-12">
										<div class="new-cars-txt">
											<h2><a href="#">opel astra <span> K </span></a></h2>
											<p>
												Opel Astra K е елегантен и ефективен компактен автомобил, който съчетава стил, производителност и напреднали технологии. 
												Неговият аеродинамичен дизайн се отличава с изискан силует с остри линии и елегантна предна решетка.
												Отвътре Astra K предлага просторна и удобна кабина, оборудвана с модерни удобства като информационно-развлекателна система със сензорен екран, усъвършенствани функции за подпомагане на водача и първокласни материали.
												С набор от ефективни бензинови и дизелови двигатели, той осигурява гладко и отзивчиво шофиране. 
											</p>
											<p class="new-cars-para2">
												Opel Astra K е идеалният избор за тези, които търсят динамичен и практичен автомобил с нотка на изтънченост. 
											</p>
											<button class="welcome-btn new-cars-btn" onclick="window.location.href='#'">
												Вижте повече
											</button>
										</div><!--/.new-cars-txt-->	
									</div><!--/.col-->
								</div><!--/.row-->
							</div><!--/.single-new-cars-item-->
						</div><!--/.new-cars-item-->
						<div class="new-cars-item">
							<div class="single-new-cars-item">
								<div class="row">
									<div class="col-md-7 col-sm-12">
										<div class="new-cars-img">
											<img src="assets\images\new-cars-model\Mokka-2021-Autohaus-Thiede-Opel-Mokka-online-kaufen-bei-Opel-Autohaus-Thiede..jpg" alt="img"/>
										</div><!--/.new-cars-img-->
									</div>
									<div class="col-md-5 col-sm-12">
										<div class="new-cars-txt">
											<h2><a href="#">Opel Mokka 2021</a></h2>
											<p>
												Opel Mokka 2021 е стилен и иновативен компактен SUV с поразителен нов дизайн. Той се отличава с модерен екстериор, елегантни LED фарове и високотехнологичен интериор с напълно цифров дисплей Pure Panel. Предлагайки ефективни бензинови, дизелови и електрически задвижвания, Mokka осигурява пъргаво управление и комфортно возене, идеално както за градско, така и за шофиране по магистрала. 
											</p>
											<p class="new-cars-para2">
												Изпитайте смесицата от стил, технология и гъвкавост с Opel Mokka 2021.
											</p>
											<button class="welcome-btn new-cars-btn" onclick="window.location.href='#'">
												Вижте повече
											</button>
										</div><!--/.new-cars-txt-->	
									</div><!--/.col-->
								</div><!--/.row-->	
							</div><!--/.single-new-cars-item-->
						</div><!--/.new-cars-item-->
					</div><!--/#new-cars-carousel-->
				</div><!--/.new-cars-content-->
			</div><!--/.container-->

		</section><!--/.new-cars-->
		<!--new-cars end -->

		<!--featured-cars start -->
		<section id="featured-cars" class="featured-cars">
			<div class="container">
				<div class="section-header">
					<p>checkout <span>the</span> featured cars</p>
					<h2>featured cars</h2>
				</div><!--/.section-header-->
				<div class="featured-cars-content">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="single-featured-cars">
								<div class="featured-img-box">
									<div class="featured-cars-img">
										<img src="assets/images/featured-cars/fc1.png" alt="cars">
									</div>
									<div class="featured-model-info">
										<p>
											model: 2009
											<span class="featured-mi-span"> 191,000 mi</span> 
											<span class="featured-hp-span"> 240HP</span>
											 automatic
										</p>
									</div>
								</div>
								<div class="featured-cars-txt">
									<h2><a href="#">BMW X1-series GT</a></h2>
									<h3>$9,395</h3>
									<p>
										Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non. 
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="single-featured-cars">
								<div class="featured-img-box">
									<div class="featured-cars-img">
										<img src="assets/images/featured-cars/fc2.png" alt="cars">
									</div>
									<div class="featured-model-info">
										<p>
											model: 2017
											<span class="featured-mi-span"> 41100 mi</span> 
											<span class="featured-hp-span"> 340HP</span>
											 automatic
										</p>
									</div>
								</div>
								<div class="featured-cars-txt">
									<h2><a href="#">chevrolet camaro <span>zl1</span></a></h2>
									<h3>$66,575</h3>
									<p>
										Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non. 
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="single-featured-cars">
								<div class="featured-img-box">
									<div class="featured-cars-img">
										<img src="assets/images/featured-cars/fc3.png" alt="cars">
									</div>
									<div class="featured-model-info">
										<p>
											model: 2017
											<span class="featured-mi-span"> 2100 mi</span> 
											<span class="featured-hp-span"> 540HP</span>
											 automatic
										</p>
									</div>
								</div>
								<div class="featured-cars-txt">
									<h2><a href="#">Lamborghini Huracan Performante <span>5.2 V10</span></a></h2>
									<h3>$125,250</h3>
									<p>
										Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non. 
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="single-featured-cars">
								<div class="featured-img-box">
									<div class="featured-cars-img">
										<img src="assets/images/featured-cars/fc4.png" alt="cars">
									</div>
									<div class="featured-model-info">
										<p>
											model: 2023
											<span class="featured-mi-span"> 25100 mi</span> 
											<span class="featured-hp-span"> 140HP</span>
											 automatic
										</p>
									</div>
								</div>
								<div class="featured-cars-txt">
									<h2><a href="#">audi <span> a4</span> Combi</a></h2>
									<h3>$35,500</h3>
									<p>
										Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non. 
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="single-featured-cars">
								<div class="featured-img-box">
									<div class="featured-cars-img">
										<img src="assets/images/featured-cars/fc5.png" alt="cars">
									</div>
									<div class="featured-model-info">
										<p>
											model: 2017
											<span class="featured-mi-span"> 56100 mi</span> 
											<span class="featured-hp-span"> 240HP</span>
											 automatic
										</p>
									</div>
								</div>
								<div class="featured-cars-txt">
									<h2><a href="#">infiniti <span>Q50</span></a></h2>
									<h3>$36,850</h3>
									<p>
										Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non. 
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="single-featured-cars">
								<div class="featured-img-box">
									<div class="featured-cars-img">
										<img src="assets/images/featured-cars/fc6.png" alt="cars">
									</div>
									<div class="featured-model-info">
										<p>
											model: 2020
											<span class="featured-mi-span"> 3100 mi</span> 
											<span class="featured-hp-span"> 300HP</span>
											 automatic
										</p>
									</div>
								</div>
								<div class="featured-cars-txt">
									<h2><a href="#">porsche <span>718</span> cayman</a></h2>
									<h3>$48,500</h3>
									<p>
										Porsche 718 Cayman е спортен автомобил с елегантен и агресивен дизайн. Оборудван с мощен 2.0-литров турбодвигател с 300 к.с., той ускорява от 0 до 100 км/ч за 4.9 секунди.
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="single-featured-cars">
								<div class="featured-img-box">
									<div class="featured-cars-img">
										<img src="assets/images/featured-cars/fc8.png" alt="cars">
									</div>
									<div class="featured-model-info">
										<p>
											model: 2007
											<span class="featured-mi-span"> 43232 mi</span> 
											<span class="featured-hp-span"> 350HP</span>
											stickshift
										</p>
									</div>
								</div>
								<div class="featured-cars-txt">
									<h2><a href="#"><span>bmw M8-</span>gran coupe</a></h2>
									<h3>$56,000</h3>
									<p>
										Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non. 
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="single-featured-cars">
								<div class="featured-img-box">
									<div class="featured-cars-img">
										<img src="assets/images/featured-cars/fc7.png" alt="cars">
									</div>
									<div class="featured-model-info">
										<p>
											model: 2020
											<span class="featured-mi-span"> 16300 mi</span> 
											<span class="featured-hp-span"> 240HP</span>
											 automatic
										</p>
									</div>
								</div>
								<div class="featured-cars-txt">
									<h2><a href="#">BMW <span> x</span>series-6</a></h2>
									<h3>$75,800</h3>
									<p>
										Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non. 
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!--/.container-->

		</section><!--/.featured-cars-->
		<!--featured-cars end -->

		<!-- clients-say strat -->
		<section id="clients-say"  class="clients-say">
			<div class="container">
				<div class="section-header">
					<h2>what our clients say</h2>
				</div><!--/.section-header-->
				<div class="row">
					<div class="owl-carousel testimonial-carousel">
						<div class="col-sm-3 col-xs-12">
							<div class="single-testimonial-box">
								<div class="testimonial-description">
									<div class="testimonial-info">
										<div class="testimonial-img">
											<img src="assets/images/clients/c1.png" alt="image of clients person" />
											<p> ⭐️⭐️⭐️⭐️⭐️</p>
										</div><!--/.testimonial-img-->
									</div><!--/.testimonial-info-->
									<div class="testimonial-comment">
										<p>
											"Отличен сайт! Намерих перфектния автомобил за мен само за няколко минути. Информацията беше ясна и изчерпателна, а процесът на покупка - изключително лесен. Препоръчвам на всеки, който търси нова кола!"
										</p>
									</div><!--/.testimonial-comment-->
									<div class="testimonial-person">
										<h2><a href="#">Мария Иванова</a></h2>
										<h4>new york</h4>
									</div><!--/.testimonial-person-->
								</div><!--/.testimonial-description-->
							</div><!--/.single-testimonial-box-->
						</div><!--/.col-->
						<div class="col-sm-3 col-xs-12">
							<div class="single-testimonial-box">
								<div class="testimonial-description">
									<div class="testimonial-info">
										<div class="testimonial-img">
											<img src="assets/images/clients/c2.png" alt="image of clients person" />
											<p>⭐️⭐️⭐️⭐️⭐️</p>
										</div><!--/.testimonial-img-->
									</div><!--/.testimonial-info-->
									<div class="testimonial-comment">
										<p>
											"Много съм доволна от услугите на този сайт. Голямо разнообразие от автомобили и страхотни оферти. Екипът е много любезен и професионален. Сайтът е интуитивен и лесен за навигация. Определено ще ползвам услугите им отново!"
										</p>
									</div><!--/.testimonial-comment-->
									<div class="testimonial-person">
										<h2><a href="#">Георги Димитров</a></h2>
										<h4>london</h4>
									</div><!--/.testimonial-person-->
								</div><!--/.testimonial-description-->
							</div><!--/.single-testimonial-box-->
						</div><!--/.col-->
						<div class="col-sm-3 col-xs-12">
							<div class="single-testimonial-box">
								<div class="testimonial-description">
									<div class="testimonial-info">
										<div class="testimonial-img">
											<img src="assets/images/clients/c3.png" alt="image of clients person" />
											<p>⭐️⭐️⭐️⭐️⭐️</p>
										</div><!--/.testimonial-img-->
									</div><!--/.testimonial-info-->
									<div class="testimonial-comment">
										<p>
											"Изключителен опит! Сайтът предлага всичко, което един купувач може да пожелае - от подробна информация за всеки автомобил до удобен процес за свързване с продавачите. Купих колата си бързо и без проблеми. Благодаря ви!"
										</p>
									</div><!--/.testimonial-comment-->
									<div class="testimonial-person">
										<h2><a href="#">john doe</a></h2>
										<h4>washington</h4>
									</div><!--/.testimonial-person-->
								</div><!--/.testimonial-description-->
							</div><!--/.single-testimonial-box-->
						</div><!--/.col-->
					</div><!--/.testimonial-carousel-->
				</div><!--/.row-->
			</div><!--/.container-->

		</section><!--/.clients-say-->	
		<!-- clients-say end -->
		
		<!--brand strat
		<section id="brand"  class="brand">
			<div class="container">
				<div class="brand-area">
					<div class="owl-carousel owl-theme brand-item">
						<div class="item">
							<a href="#">
								<img src="assets/images/brand/br1.png" alt="brand-image" />
							</a>
						</div>
						<div class="item">
							<a href="#">
								<img src="assets/images/brand/br2.png" alt="brand-image" />
							</a>
						</div>
						<div class="item">
							<a href="#">
								<img src="assets/images/brand/br3.png" alt="brand-image" />
							</a>
						</div>
						<div class="item">
							<a href="#">
								<img src="assets/images/brand/br4.png" alt="brand-image" />
							</a>
						</div>

						<div class="item">
							<a href="#">
								<img src="assets/images/brand/br5.png" alt="brand-image" />
							</a>
						</div>

						<div class="item">
							<a href="#">
								<img src="assets/images/brand/br6.png" alt="brand-image" />
							</a>
						</div>
					</div>
				</div>

			</div>
		</section>	
		 -->
		<!--blog start -->
		<section id="blog" class="blog"></section><!--/.blog-->
		<!--blog end -->

		<!--contact start-->
		<footer id="contact"  class="contact">
			<div class="container">
				<div class="footer-top">
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="single-footer-widget">
								<div class="footer-logo">
									<a href="index.php">TorqueGT</a>
								</div>
								<p>
									Ased do eiusm tempor incidi ut labore et dolore magnaian aliqua. Ut enim ad minim veniam.
								</p>
								<div class="footer-contact">
									<p>info@themesine.com</p>
									<p>+1 (885) 2563154554</p>
								</div>
							</div>
						</div>
						<div class="col-md-2 col-sm-6">
							<div class="single-footer-widget">
								<h2>about devloon</h2>
								<ul>
									<li><a href="#">about us</a></li>
									<li><a href="#">career</a></li>
									<li><a href="#">terms <span> of service</span></a></li>
									<li><a href="#">privacy policy</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-xs-12">
							<div class="single-footer-widget">
								<h2>top brands</h2>
								<div class="row">
									<div class="col-md-7 col-xs-6">
										<ul>
											<li><a href="#">BMW</a></li>
											<li><a href="#">lamborghini</a></li>
											<li><a href="#">camaro</a></li>
											<li><a href="#">audi</a></li>
											<li><a href="#">infiniti</a></li>
											<li><a href="#">nissan</a></li>
										</ul>
									</div>
									<div class="col-md-5 col-xs-6">
										<ul>
											<li><a href="#">ferrari</a></li>
											<li><a href="#">porsche</a></li>
											<li><a href="#">land rover</a></li>
											<li><a href="#">aston martin</a></li>
											<li><a href="#">mersedes</a></li>
											<li><a href="#">opel</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-offset-1 col-md-3 col-sm-6">
							<div class="single-footer-widget">
								<h2>news letter</h2>
								<div class="footer-newsletter">
									<p>
										Subscribe to get latest news  update and informations
									</p>
								</div>
								<div class="hm-foot-email">
									<div class="foot-email-box">
										<input type="text" class="form-control" placeholder="Add Email">
									</div><!--/.foot-email-box-->
									<div class="foot-email-subscribe">
										<span><i class="fa fa-arrow-right"></i></span>
									</div><!--/.foot-email-icon-->
								</div><!--/.hm-foot-email-->
							</div>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="row">
						<div class="col-sm-6">
							<p>
								&copy; copyright.designed and developed by <a href="https://www.themesine.com/">themesine</a>.
							</p><!--/p-->
						</div>
						<div class="col-sm-6">
							<div class="footer-social">
								<a href="#"><i class="fa fa-facebook"></i></a>	
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa-linkedin"></i></a>
								<a href="#"><i class="fa fa-pinterest-p"></i></a>
								<a href="#"><i class="fa fa-behance"></i></a>	
							</div>
						</div>
					</div>
				</div><!--/.footer-copyright-->
			</div><!--/.container-->

			<div id="scroll-Top">
				<div class="return-to-top">
					<i class="fa fa-angle-up " id="scroll-top" data-toggle="tooltip" data-placement="top" title="" data-original-title="Back to Top" aria-hidden="true"></i>
				</div>
				
			</div><!--/.scroll-Top-->
			
        </footer><!--/.contact-->
		<!--contact end-->


		
		<!-- Include all js compiled plugins (below), or include individual files as needed -->

		<script src="assets/js/jquery.js"></script>
        
        <!--modernizr.min.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
		
		<!--bootstrap.min.js-->
        <script src="assets/js/bootstrap.min.js"></script>
		
		<!-- bootsnav js -->
		<script src="assets/js/bootsnav.js"></script>

		<!--owl.carousel.js-->
        <script src="assets/js/owl.carousel.min.js"></script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

        <!--Custom JS-->
        <script src="assets/js/custom.js"></script>
        
    </body>
	
</html>