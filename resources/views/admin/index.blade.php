@extends('admin.layouts.master')

@section('head-tag')
<title>داشبورد اصلی</title>
@endsection

@section('content')

            <section class="row">
                <section class="col-lg-3 col-md-6 col-12">

                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-custom-yellow text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>تعداد کاربران سایت</h5>
                                        <h6>{{ $users->count() ?? 0 }}</h6>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-users"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> تاریخ آخرین ثبت نام : {{ !empty($users->toArray()) ? jalaliDate($users->last()->created_at) : 'نام معلوم' }}
                            </section>
                        </section>
                    </a>

                </section>
                <section class="col-lg-3 col-md-6 col-12">

                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-custom-green text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>تعداد ادمین های سایت</h5>
                                        <h6>{{ $admins->count() ?? 0 }}</h6>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-user-shield"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> تاریخ آخرین ثبت نام : {{ $admins->last() ? jalaliDate($admins->last()->created_at) : 'نامعلوم' }}
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-custom-pink text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>تعداد کاربران بن شده</h5>
                                        <h6>0</h6>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-ban"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> تاریخ آخرین بن : نامعلوم
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-custom-blue text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>تعداد بازی های انجام شده</h5>
                                        <h6>{{ $games->count() }}</h6>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-user-secret"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> تاریخ آخرین بازی : {{ $games->last() ? jalaliDate($games->last()->created_at) : 'نامعلوم' }}                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-danger text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>میزان درامد کل</h5>
                                        <h6>{{ priceFormat($allPrice) }} تومان</h6>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{ jalaliDate(now()) }}
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-success text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>میزان سود خالص</h5>
                                        <h6>{{ priceFormat($profitPrice) }} تومان</h6>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{ jalaliDate(now()) }}
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-warning text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>تعداد پرداخت های حضوری</h5>
                                        <h6>{{ $cashPayment }}</h6>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-dollar-sign"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{ jalaliDate(now()) }}
                            </section>
                        </section>
                    </a>
                </section>
                <section class="col-lg-3 col-md-6 col-12">
                    <a href="#" class="text-decoration-none d-block mb-4">
                        <section class="card bg-primary text-white">
                            <section class="card-body">
                                <section class="d-flex justify-content-between">
                                    <section class="info-box-body">
                                        <h5>تعداد پرداخت های آنلاین</h5>
                                        <h6>0</h6>
                                    </section>
                                    <section class="info-box-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </section>
                                </section>
                            </section>
                            <section class="card-footer info-box-footer">
                                <i class="fas fa-clock mx-2"></i> به روز رسانی شده در : {{ jalaliDate(now()) }}
                            </section>
                        </section>
                    </a>
                </section>

            </section>
{{--
            <section class="row">
                <section class="col-12">
                    <section class="main-body-container">
                        <section class="main-body-container-header">
                            <h5>
                                بخش کاربران
                            </h5>
                            <p>
                                در این بخش اطلاعاتی در مورد کاربران به شما داده می شود
                            </p>
                        </section>
                        <section class="body-content">
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت
                                می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </p>
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت
                                می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </p>
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت
                                می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </p>
                        </section>
                    </section>
                </section>
            </section> --}}

            @endsection

