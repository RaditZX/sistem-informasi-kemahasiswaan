<style>
    /* Custom styles for pagination */
    .swiper-pagination {
        bottom: 10px;
        /* Adjust the position */
    }

    .swiper-pagination-bullet {
        background: gray;
        /* Change bullet color */
        opacity: 1;
        /* Fully visible */
        width: 12px;
        /* Bullet width */
        height: 12px;
        /* Bullet height */
        margin: 0 4px;
        /* Spacing between bullets */
        border-radius: 50%;
        /* Make bullets circular */
    }

    .swiper-pagination-bullet-active {
        background: #FFCB25;
        /* Active bullet color */
    }

    /* Custom styles for navigation buttons */
    .swiper-button-next,
    .swiper-button-prev {
        color: #fff;
        /* Change button text color */
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent background */
        border-radius: 50%;
        /* Rounded buttons */
        width: 40px;
        /* Button width */
        height: 40px;
        /* Button height */
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 20px;
        /* Change icon size */
    }

    .swiper-button-next {
        right: 10px;
        /* Position the next button */
    }

    .swiper-button-prev {
        left: 10px;
        /* Position the previous button */
    }

    /* Optional: Change hover effect */
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: rgba(0, 0, 0, 0.8);
        /* Darker background on hover */
    }


</style>

@if ($isBenefit)
    <div class="swiper swiper-syarat p-0 m-0">
        <div class="swiper-wrapper p-0 m-0">
            <!-- Slide 1 -->
            @foreach ($beasiswa->syaratBeasiswa as $syarat)
                <div class="swiper-slide p-10 bg-white">
                    <div class="rounded flex items-center bg-white-100 shadow-xl h-80">
                        <div class="basis-1/4 h-full overflow-hidden rounded-t-lg md:rounded-t-none md:rounded-l-lg">
                            <img class="w-full h-full object-cover object-center"
                                src="https://th.bing.com/th/id/OIP.DmPQAB4t3Na-Xf7Vy2TGCQHaE8?rs=1&pid=ImgDetMain"
                                alt="Image 1">
                        </div>
                        <div class="p-6 basis-3/4">
                            <h2 class="text-xl font-bold">{{ $syarat->syarat }}</h2>
                            <p class="mt-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam sit
                                reprehenderit perferendis dolorem architecto earum fugit et ad exercitationem autem
                                itaque.
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam sit reprehenderit
                                perferendis dolorem architecto earum fugit et ad exercitationem autem itaque</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination swiper-pagination-1"></div>

        <!-- Navigation buttons -->
        <div class="swiper-button-next swiper-button-next-1"></div>
        <div class="swiper-button-prev swiper-button-prev-1"></div>
    </div>
@else
    <div class="swiper swiper-benefit p-0 m-0">
        <div class="swiper-wrapper p-0 m-0">
            @foreach ($beasiswa->benefitBeasiswa as $syarat)
                <div class="swiper-slide">
                    <div>
                        <p>{{ $syarat->benefit }}</p>
                        <div>
                            <img src="https://mdbcdn.b-cdn.net/img/new/slides/041.webp" class="block w-full"
                                alt="Wild Landscape" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="swiper-pagination swiper-pagination-2"></div>

        <!-- Navigation buttons -->
        <div class="swiper-button-next swiper-button-next-2"></div>
        <div class="swiper-button-prev swiper-button-prev-2"></div>
    </div>

@endif

<!-- Display Container END -->

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  // Initialize the first Swiper for Syarat
  const swiperSyarat = new Swiper('.swiper-syarat', {
      slidesPerView: 1,
      centeredSlides: true,
      loop: true,
      spaceBetween: 10,
      autoplay: {
          delay: 3000,
          disableOnInteraction: false,
      },
      pagination: {
          el: '.swiper-pagination-1', // Ensure this is unique
          clickable: true,
      },
      navigation: {
          nextEl: '.swiper-button-next-1', // Ensure this is unique
          prevEl: '.swiper-button-prev-1', // Ensure this is unique
      },
  });

  // Initialize the second Swiper for Benefit
  const swiperBenefit = new Swiper('.swiper-benefit', {
      slidesPerView: 1,
      centeredSlides: true,
      loop: true,
      spaceBetween: 10,
      autoplay: {
          delay: 3000,
          disableOnInteraction: false,
      },
      pagination: {
          el: '.swiper-pagination-2', // Ensure this is unique
          clickable: true,
      },
      navigation: {
          nextEl: '.swiper-button-next-2', // Ensure this is unique
          prevEl: '.swiper-button-prev-2', // Ensure this is unique
      },
  });
</script>

