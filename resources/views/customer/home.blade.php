@extends('customer.layouts.master')

@section('content')
<!-- Start of banner section ============================================= -->
<section id="banner-area" class="banner-area-section home-2">
    <div class="container">
        <div class="row">
            <div class="banner-area-content">
                <div class="banner-area-head">
                    <div class="banner-text-custom ">
                        <div  class="banner-text pb40 text-center">
                            <h1 class="pb30">{!! $subject !!}</h1>
                            <span>{!! $description !!}</span>
                            <br>
                            <div class="d-flex">
                                @guest
                                <a class="lightbtn" href="{{ route('register') }}">ثبت نام</a>
                                <a class="lightbtn" href="{{ route('login') }}">ورود</a>
                                @endguest
                                @auth
                                <button class="lightbtn"><a href="{{ route('login') }}"> ورود به پنل کاربری </a></button>
                                @endauth
                            </div>
                        </div>
                    </div>
                    <div class="banner-mock-up home-1 zooming">
                        <img src="{{ asset($bannerImage) }}" alt="img">
                    </div>
                </div><!-- /banner-area-head -->
            </div><!-- /banner-area-content -->
        </div><!-- /row -->
    </div><!-- /.container -->
</section>
<!-- End of banner section ============================================= -->

<!-- Start of some extra features ============================================= -->
	<section id="rules" class="extra-features-section">
		<div class="container">
			<div class="row section-content">
                <span class="mobile-rule-image"><img src="{{ $ruleImage }}" alt=""></span>

                <div class="section-title text-center pb50">
                    <h1 class="title deep-black pb40">قوانین بازی</h1>
                </div>
				<!-- //section-title -->
				<div class="extra-features-content">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<div class="extra-right">
								<div class="extra-left-content">
									<div class="extra-icon-text text-left">
										<div class="features-text pt25">
											<div class="features-text-title text-center pb10">
												<h3 class="deep-black">نگرفتن جایزه</h3>
											</div>
											<div class="features-text-dec text-right">
												<span>به هر نحوی توسط گاد از بازی کیک بشید شامل جایزه نمی شوید .</span>
											</div>
										</div>
									</div>
								</div>
								<!-- // extra-right-content -->
								<div class="extra-left-content">
									<div class="extra-icon-text text-left">
										<div class="features-text pt25">
											<div class="features-text-title text-center pb10">
												<h3 class="deep-black">گرفتن نقش در شب</h3>
											</div>
											<div class="features-text-dec text-right">
												<span>بعد از روز معارفه , به دستور گاد بازی شب می شود و نقش ها در شب پخش می شود .</span>
											</div>
										</div>
									</div>
								</div>
								<!-- // extra-right-content -->
								<div class="extra-left-content">
									<div class="extra-icon-text text-left">
										<div class="features-text pt25">
											<div class="features-text-title text-center pb10">
												<h3 class="deep-black">کیک 4 اخطاری</h3>
											</div>
											<div class="features-text-dec text-right">
												<span>حرف زدن خارج نوبت و در گوشی حرف زدن و لایک و دیس لایک موقع دفاعیه شخص موجب گرفتن اخطار میشود و سپس بعد از گرفتن 4 اخطار حذف می شوید .</span>
											</div>
										</div>
									</div>
								</div>
                                <div class="extra-left-content">
									<div class="extra-icon-text text-left">
										<div class="features-text pt25">
											<div class="features-text-title text-center pb10">
												<h3 class="deep-black">کیک بدون اخطار</h3>
											</div>
											<div class="features-text-dec text-right">
												<span>کوچیک ترین حرف در شب و چشم باز کردن در شب موجب کیک  بدون اخطار می شود .</span>
											</div>
										</div>
									</div>
								</div>
								<!-- // extra-left-content -->
							</div><!-- /extra-left -->
						</div>
						<!-- /col-sm-3 -->
						<div class="col-sm-4">
							<div class="extra-pic text-center">
								<img src="{{ asset($ruleImage) }}" alt="img">
							</div>
						</div>
						<!-- /col-sm-6 -->
						<div class="col-md-4 col-sm-6">
							<div class="extra-left">
								<div class="extra-left-content">
									<div class="extra-icon-text text-right">

										<div class="features-text pt25">
											<div class="features-text-title text-center pb10">
												<h3 class="deep-black">گرفتن موبایل ها</h3>
											</div>
											<div class="features-text-dec text-right">
												<span>برای اینکه بازی به صورت کامل عادلانه پیش برود و ... قبل از شروع شدن بازی گوشی ها گرفته می شود .</span>
											</div>
										</div>
									</div>
								</div>
								<!-- // extra-left-content -->

								<div class="extra-left-content">
									<div class="extra-icon-text text-right">

										<div class="features-text pt25">
											<div class="features-text-title text-center pb10">
												<h3 class="deep-black">خارج شدن از محوطه بازی</h3>
											</div>
											<div class="features-text-dec text-right">
												<span>اگر شما به هر نحوی از بازی خارج شدید باید از محوطه ای که بازی در حال اجرا است خارج شوید که باعث وارد شدن اطلاعات به بازی نشوید و باعث بهم ریختن تمرکز بقیه بازکنان نشود .</span>
											</div>
										</div>
									</div>
								</div>
								<!-- // extra-left-content -->

								<div class="extra-left-content">
									<div class="extra-icon-text text-right">

										<div class="features-text pt25">
											<div class="features-text-title text-center pb10">
												<h3 class="deep-black">تایم های صحبت کردن</h3>
											</div>
											<div class="features-text-dec text-right">
												<span><b>روز معارفه </b>: <br>در روز معارفه چالش نداریم و تایم صحبت هرشخص 30 ثانیه است . <br><b>روز های عادی </b>: <br>در زور های عادی نوبت صحبت هرشخص 35 ثانیه و تایم چالش 25 ثانیه است . <br><b>لابی</b> : <br>لابی ها 3 نفره برگزار می شود و تایم صحبت هرنفر 30 ثانیه است .</span>
											</div>
										</div>
									</div>
								</div>
								<!-- // extra-left-content -->
							</div><!-- /extra-left -->
						</div>
						<!-- /col-sm-3 -->
					</div><!-- /row -->
				</div><!-- /extra-features-content -->
			</div><!-- /row -->
		</div><!-- /container -->
	</section>
	<!-- End of some extra features ============================================= -->

@endsection
