

$('.banner-sliders').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})


$('.book-slides').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 5
        },
        1000: {
            items: 5
        }
    }
})


$('.mybooks-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 3
        }
    }
})


$('.reviews-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    dots: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 3
        }
    }
})

const images = [
    "assets/images/banner-back-1.png",
    "assets/images/banner-back-2.png",
    "assets/images/banner-back-3.png",
];

const banner = document.getElementById("banner");
let i = 0;


banner.style.backgroundImage = `url(${images[i]})`;

setInterval(() => {
    i = (i + 1) % images.length;
    banner.style.backgroundImage = `url(${images[i]})`;
}, 6000); 