<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کمپین نگین طب سپاهان</title>
    <link rel="stylesheet" href="{{ asset('assets/companies/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/companies/libs/swiper/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/companies/css/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/companies/css/style.css') }}">
    <link rel="icon" href="{{ asset('assets/companies/img/icons/icon.png') }}">

</head>

<body>
    <div class="mobile-wrapper">

        <div class="modal" id="myModal">
            <div class="modal-content">
                <div class="modal-footer">
                    <div class="buttons">
                        <a target="_blank" class="btn btn-has-icon">
                            <span class="btn-text">دریافت از بازار</span>
                            <span class="btn-icon">
                                <img src="{{ asset('assets/companies/img/icons/bazaar.png') }}" alt="">
                            </span>
                        </a>
                        <a href="https://shimetebnegin.ir/app" target="_blank" class="btn btn-has-icon">
                            <span class="btn-text">دانلود مستقیم</span>
                            <span class="btn-icon">
                                <img src="{{ asset('assets/companies/img/icons/download.png') }}" alt="">
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <section class="profile-img">

                <div class="info">
                    <div class="name-wrapper">

                        <h2>نگین طب سپاهان</h2>

                        <span class="logo-container">
                            <img class="logo" src="{{ asset('assets/companies/img/icons/icon.png') }}" loading="lazy"
                                alt="">
                        </span>
                    </div>
                    <p>مواد اولیه واحد ساخت | ظروف | روغن و اسانس</p>
                    <div class="company">
                        <div class="company-logo"></div>
                        <span></span>
                    </div>

                </div>
            </section>

            <section class="table-section">
                <div class="buttons">
                    <button class="btn btn-has-icon" id="openModalBtn">
                        <span>اپلیکیشن اندروید</span>
                        <span class="btn-icon">
                            <img src="{{ asset('assets/companies/img/icons/android.png') }}" alt="">
                        </span>
                    </button>
                    <a href="https://shimetebnegin.ir/" target="_blank" class="btn btn-has-icon">
                        <span>فروشگاه اینترنتی</span>
                        <span class="btn-icon">
                            <img src="{{ asset('assets/companies/img/icons/shop.png') }}" alt="">
                        </span>
                    </a>
                </div>
            </section>

            <section class="table-section">
                <div class="table-section_wrapper">

                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/companies/img/contents/1611572734-im1.jpg') }}"
                                    loading="lazy" alt="انواع روغن های طبیعی">
                                <div class="slide-caption">انواع روغن های طبیعی</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/companies/img/contents/1611575300-im1.jpg') }}"
                                    loading="lazy" alt="انواع اسانس ها">
                                <div class="slide-caption">انواع اسانس ها</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/companies/img/contents/1713947206-im1.jpg') }}"
                                    loading="lazy" alt="ظروف واحد ساخت">
                                <div class="slide-caption">ظروف واحد ساخت</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/companies/img/contents/1741176006-im1.jpg') }}"
                                    loading="lazy" alt="محصولات آرایشی بهداشتی">
                                <div class="slide-caption">محصولات آرایشی بهداشتی</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/companies/img/contents/1754900435-im1.jpg') }}"
                                    loading="lazy" alt="اکسید آهن قرمز">
                                <div class="slide-caption">اکسید آهن قرمز</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/companies/img/contents/1754901687-im1.jpg') }}"
                                    loading="lazy" alt="اکسید آهن">
                                <div class="slide-caption">اکسید آهن</div>
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/companies/img/contents/1759138023-im1.jpg') }}"
                                    loading="lazy" alt="اکسید آهن زرد">
                                <div class="slide-caption">اکسید آهن زرد</div>
                            </div>
                        </div>

                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

            </section>
        </div>


        <section class="add-contact">

            <div class="icons">

                <a href="https://wa.me/+989130338785" target="_blank">
                    <img class="icon-img" src="{{ asset('assets/companies/img/icons/comment.png') }}" loading="lazy"
                        alt="واتساپ نگین طب سپاهان">
                </a>

                <a target=" _blank">
                    <img class="icon-img" src="{{ asset('assets/companies/img/icons/eitaa.jpg') }}" loading="lazy"
                        alt="ایتا نگین طب سپاهان">
                </a>

                <a href="https://t.me/asefi_031" target="_blank">
                    <img class="icon-img" src="{{ asset('assets/companies/img/icons/telegram.png') }}"
                        loading="lazy" alt="تلگرام نگین طب سپاهان">
                </a>

            </div>

            <a href="tel:09130338785" class="add-contact-button btn">تماس</a>

        </section>

    </div>

    <script>
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');
        const closeFooterBtn = document.getElementById('closeFooterBtn');
        const modal = document.querySelector('#myModal');

        openBtn.onclick = () => modal.style.display = 'flex';

        function closeModal(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        }

        window.addEventListener('click', closeModal);
        window.addEventListener('touchstart', closeModal);
    </script>

    <script src="{{ asset('assets/companies/libs/swiper/swiper.js') }}"></script>

    <script>
        const swiper = new Swiper('.swiper', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
</body>

</html>
