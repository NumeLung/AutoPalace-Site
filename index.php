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
    require_once "config.php";
    require_once "Database1.php";
    $db = new Database1();


    $brands = $db->select("SELECT id, name FROM brand");
    $models = $db->select("SELECT id, name, id_brand FROM model");

    $aBrandsForSearch = [];
    foreach($brands as $k => $brand) {
        $aBrandsForSearch[$brand['id']] = [
            'brand_id'  => $brand['id'],
            'brand_name' => $brand['name'],
            'models' => []
        ];
        foreach ($models as $kk => $model) {
            if ($model['id_brand'] == $brand['id']) {
                $aBrandsForSearch[$brand['id']]['models'][$model['id']] = [
                    'model_id' => $model['id'],
                    'model_name' => $model['name']
                ];
            }
        }
    }

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
                                <div class="row">
                                    <form method="POST" action="index.php">
                                    <div class="col-md-offset-1 col-md-2 col-sm-12">
                                        <div class="single-model-search">
                                            <h2>марка</h2>
                                            <div class="model-select-icon">
                                                <select class="form-control" id="search_brand" name="search_brand">
                                                    <option value="">Избери</option>
                                                <?php
                                                foreach ($aBrandsForSearch as $k => $brand) {
                                                    $selected = isset($_POST['search_brand']) && $_POST['search_brand'] == $brand['brand_id'] ? 'selected' : '';
                                                    echo "<option $selected value='{$brand['brand_id']}'>{$brand['brand_name']}</option>\n";
                                                }
                                                ?>
                                                </select>
                                                <script type="text/javascript">
                                                    // debugger;
                                                    document.getElementById('search_brand').value = "<?php echo isset($_POST['search_brand']) ? $_POST['search_brand'] : ''; ?>";
                                                </script>
                                            </div>
                                        </div>
                                        <div class="single-model-search">
                                            <h2>модел</h2>
                                            <div class="model-select-icon">
                                                <select class="form-control" id="search_model" name="search_model">
                                                    <option value="">избери</option><!-- /.option-->
                                                    <?php
                                                    foreach ($aBrandsForSearch as $k => $brand) {
                                                        if ($k == $_POST['search_brand']) {
                                                            foreach ($brand['models'] as $model) {
                                                                $selected = isset($_POST['search_model']) && $_POST['search_model'] == $model['model_id'] ? 'selected' : '';
                                                                echo "<option $selected value='{$model['model_id']}'>{$model['model_name']}</option>\n";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select><!-- /.select-->
                                                <script type="text/javascript">
                                                    document.getElementById('search_model').value = "<?php echo isset($_POST['search_model']) ? $_POST['search_model'] : ''; ?>";
                                                </script>
                                            </div><!-- /.model-select-icon -->
                                        </div>

                                    </div>
                                    <div class="col-md-offset-1 col-md-2 col-sm-12">
                                        <div class="single-model-search">
                                            <h2>Състояние</h2>
                                            <div class="model-select-icon">
                                                <select class="form-control" id="search_value" name="search_value">
                                                    <option value="">Избери</option>
                                                    <?php
                                                    foreach ($values as $value) {
                                                        $selected = isset($_POST['search_value']) && $_POST['search_value'] == $value['value'] ? 'selected' : '';
                                                        echo "<option $selected value='{$value['value']}'>{$value['value']}</option>\n";
                                                    }
                                                    ?>
                                                </select>
                                                <script type="text/javascript">
                                                    document.getElementById('search_value').value = "<?php echo isset($_POST['search_value']) ? $_POST['search_value'] : ''; ?>";
                                                </script>
                                            </div>
                                        </div>
                                        <div class="single-model-search">
                                            <h2>Шаси</h2>
                                            <div class="model-select-icon">
                                                <select class="form-control" id="search_trim" name="search_trim" >
                                                    <option value="">Избери</option><!-- /.option-->
                                                    <?php
                                                    foreach ($trims as $trim) {
                                                        $selected = isset($_POST['search_trim']) && $_POST['search_trim'] == $trim['trim'] ? 'selected' : '';
                                                        echo "<option $selected value='{$trim['trim']}'>{$trim['trim']}</option>\n";
                                                    }
                                                    ?>
                                                </select><!-- /.select-->
                                                <script type="text/javascript">
                                                    document.getElementById('search_trim').value = "<?php echo isset($_POST['search_trim']) ? $_POST['search_trim'] : ''; ?>";
                                                </script>
                                            </div><!-- /.model-select-icon -->
                                        </div>
                                    </div>
                                    <div class="col-md-offset-1 col-md-2 col-sm-12">
                                        <div class="single-model-search">
                                            <h2>година</h2>
                                            <div class="model-select-icon">
                                                <select class="form-control" id="search_year" name="search_year" >
                                                    <option value="">избери</option><!-- /.option-->
                                                    <?php
                                                    foreach ($years as $year){
                                                        echo "<option value='{$year['year']}'>{$year['year']}</option>\n";
                                                    }
                                                    ?>
                                                </select><!-- /.select-->
                                                <script type="text/javascript">
                                                    document.getElementById('search_year').value = "<?php echo isset($_POST['search_year']) ? $_POST['search_year'] : ''; ?>";
                                                </script>
                                            </div><!-- /.model-select-icon -->
                                        </div>
                                        <div class="single-model-search">
                                            <h2>цена до:</h2>$ <span id="price"></span>
                                            <div class="slidecontainer">
                                                <?php
                                                foreach ($prices as $price) {
                                                    echo "<input type=\"range\" min='{$price['min']}' max='{$price['max']}' ";
                                                }
                                                $price = isset($prices['min']) ? $prices['min'] : 0;
                                                if (isset($_POST['price'])) $price = $_POST['price'];
                                                echo "value=\"{$price}\" class=\"slider\" id=\"myRange\" name=\"price\">"; ?>
                                            </div>
                                            <script type="text/javascript">
                                                document.getElementById('price').innerHTML = "<?php echo isset($_POST['price']) ? $_POST['price'] : ''; ?>";
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12">
                                        <div class="single-model-search text-center">
                                            <button type="submit" class="welcome-btn model-search-btn" onclick="" id="collectButton">Търси</button>
                                        </div>
                                    </div>
                                    </form>
                                    <!--<script>
                                        //load car models via ajax
                                        $(document).ready(function() {
                                            $('#search_brand').click(function() {
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
                                                    $('#search_model').html('<option value="">избери</option>');
                                                }
                                            });
                                        });
                                    </script>-->
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var data = <?= json_encode($aBrandsForSearch) ?>
                // Function to populate the model select element
                function populateModelSelect(brandId) {
                    const modelSelect = document.getElementById('search_model');
                    modelSelect.innerHTML = '<option value="">избери</option>'; // Clear previous model options

                    if (data[brandId]) {
                        const models = data[brandId].models;
                        for (const key in models) {
                            if (models.hasOwnProperty(key)) {
                                const model = models[key];
                                const option = document.createElement('option');
                                option.value = model.model_id;
                                option.textContent = model.model_name;
                                modelSelect.appendChild(option);
                            }
                        }
                    }
                }

                // Event listener for brand select change
                document.getElementById('search_brand').addEventListener('change', function() {
                    const selectedBrandId = this.value;
                    populateModelSelect(selectedBrandId);
                });

                // If a brand is already selected (e.g., due to form submission), populate models for it
                document.addEventListener('DOMContentLoaded', function() {
                    const brandSelect = document.getElementById('search_brand');
                    if (brandSelect.value) {
                        populateModelSelect(brandSelect.value);
                    }
                });
            </script>
            <!--<script>
                var modelsByBrands = <?/*= json_encode($aBrandsForSearch) */?>
                function displayModels(brandId) {
                    const modelsContainer = document.getElementById('search_model');
                    modelsContainer.innerHTML = ''; // Clear previous models
                    debugger;
                    if (brandId === data.brand_id) {
                        const models = data.models;
                        for (const key in models) {
                            if (models.hasOwnProperty(key)) {
                                const model = models[key];
                                const modelDiv = document.createElement('div');
                                modelDiv.textContent = `${model.model_name} (ID: ${model.model_id})`;
                                modelsContainer.appendChild(modelDiv);
                            }
                        }
                    }
                }
            </script>-->
            <script>
                /*document.getElementById('collectButton').addEventListener('click', async function() {
                    // Get the selected values from each select element
                    const search_brand = document.getElementById('search_brand').value;
                    const search_model = document.getElementById('search_model').value;
                    const search_value = document.getElementById('search_value').value;
                    const search_trim = document.getElementById('search_trim').value;
                    const search_year = document.getElementById('search_year').value;
                    const search_price = document.getElementById('demo').innerHTML;

                    // Create an array with the selected values
                    const selectedValues = [search_brand, search_model, search_value, search_trim, search_year, search_price];

                    // Log the array to the console
                    console.log(selectedValues);

                    // Send the array to the PHP file using fetch
                    try {
                        const response = await fetch('get_cars.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(selectedValues)
                        });
                        const result = await response.json();
                        console.log('Completed!', result);
                    } catch(err) {
                        console.error(`Error: ${err}`);
                    }
                });*/
                /*function showFeatured() {
                    const featuredElement = document.getElementById("featured-cars");
                    debugger;
                    if (featuredElement) {
                        featuredElement.scrollIntoView({ behavior: "smooth" });
                    }
                }*/
            </script>
            <script>
                var slider = document.getElementById("myRange");
                var output = document.getElementById("price");
                output.innerHTML = slider.value; // Display the default slider value

                // Update the current slider value (each time you drag the slider handle)
                slider.oninput = function() {
                    output.innerHTML = this.value;
                }
            </script>
		</section><!--/.welcome-hero-->
		<!--welcome-hero end -->

        <!--featured-cars start -->
        <section id="featured-cars" class="featured-cars">
            <div class="container">
                <div class="section-header">
                    <p>Разгледайте нашият шоуруум</p>
                    <?php if(empty($_POST)) {
                        echo "<h2>featured cars</h2>";
                    }
                    ?>
                </div><!--/.section-header-->
                <div class="featured-cars-content">
                    <?php include "load_featured.php"?>
                </div>
            </div><!--/.container-->
        </section><!--/.featured-cars-->
        <!--featured-cars end -->

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
											<button class="welcome-btn new-cars-btn" onclick="window.location.href='https://www.opel.bg/koli/mokka-models.html'">
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

		<!-- clients-say strat -->
		<section id="clients-say"  class="clients-say">
			<div class="container">
				<div class="section-header">
					<h2>Какво мислят клиентите ни</h2>
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
										<h2><a href="#">Георги Димитров</a></h2>
										<h4>Димитровград</h4>
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
										<h2><a href="#">Мария Иванова</a></h2>
										<h4>Разград</h4>
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
										<h2><a href="#">иван иванов</a></h2>
										<h4>Варна</h4>
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
									Авбомобилите са нашата страаст
								</p>
								<div class="footer-contact">
									<p>info@bobauhleba.com</p>
									<p>088 скрий са</p>
								</div>
							</div>
						</div>
						<div class="col-md-2 col-sm-6">
							<div class="single-footer-widget">
								<h2>about devloon</h2>
								<ul>
									<li><a href="#">За нас</a></li>
									<li><a href="#">Работа при нас</a></li>
									<li><a href="#">ToS</a></li>
									<li><a href="#">Политика на поверителност</a></li>
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
											<li><a href="#">mercedes</a></li>
											<li><a href="#">opel</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-offset-1 col-md-3 col-sm-6">
							<div class="single-footer-widget">
								<h2>бюлетина</h2>
								<div class="footer-newsletter">
									<p>
										Абонирайте се за нашата бюлетина
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
								&copy; copyright.designed and developed by <a href="https://www.themesine.com/">NumeLung</a>.
							</p><!--/p-->
						</div>
						<div class="col-sm-6">
							<div class="footer-social">
								<a href=""><i class="fa fa-facebook"></i></a>
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