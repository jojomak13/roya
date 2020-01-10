// Start Slideshow
let slideshow = $("#slideshow").owlCarousel({
	items: 1,
	dots: false,
	lazyLoad: true
});

$(".slideshow .next").click(function() {
	slideshow.trigger("next.owl.carousel");
});

$(".slideshow .prev").click(function() {
	slideshow.trigger("prev.owl.carousel", [300]);
});
// End Slideshow

// Start Category Dropdown
$(".category-dropdown").on("click", function() {
	$(this).toggleClass("active");
	$(this)
		.find("ul")
		.slideToggle(400);
});
// End Category Dropdown

// Start Offers
$("#offers").owlCarousel({
	// margin: 10,
	lazyLoad: true,
	dots: false,
	items: 1
});
// End Offers

// Start new products
let newProducts = $("#new-products").owlCarousel({
	margin: 10,
	responsiveClass: true,
	lazyLoad: true,
	dots: false,
	responsive: {
		0: {
			items: 1
		},
		600: {
			items: 2
		},
		1000: {
			items: 3
		}
	}
});

$(".new-products .next").click(function() {
	newProducts.trigger("next.owl.carousel");
});

$(".new-products .prev").click(function() {
	newProducts.trigger("prev.owl.carousel", [300]);
});
// End new products

// Start best seller
let bestSeller = $("#best-seller").owlCarousel({
	margin: 10,
	responsiveClass: true,
	lazyLoad: true,
	dots: false,
	responsive: {
		0: {
			items: 1
		},
		600: {
			items: 2
		},
		1000: {
			items: 3
		}
	}
});

$(".best-seller .next").click(function() {
	bestSeller.trigger("next.owl.carousel");
});

$(".best-seller .prev").click(function() {
	bestSeller.trigger("prev.owl.carousel", [300]);
});
// End best seller

// Start Latest Blogs
let latestBlogs = $("#latest-blogs").owlCarousel({
	margin: 10,
	responsiveClass: true,
	lazyLoad: true,
	dots: false,
	responsive: {
		0: {
			items: 1
		},
		600: {
			items: 2
		},
		1000: {
			items: 3
		}
	}
});

$(".latest-blogs .next").click(function() {
	latestBlogs.trigger("next.owl.carousel");
});

$(".latest-blogs .prev").click(function() {
	latestBlogs.trigger("prev.owl.carousel", [300]);
});
// End Latest Blogs

// Start Brands
$("#brands").owlCarousel({
	loop: true,
	margin: 10,
	responsiveClass: true,
	dots: false,
	lazyLoad: true,
	responsive: {
		0: {
			items: 2
		},
		600: {
			items: 4
		},
		1000: {
			items: 6
		}
	}
});
// End Brands

// Start Single product
let product = $("#product").owlCarousel({
	items: 1,
	dots: false,
	lazyLoad: true
});
// Edit Single product

// Start Related Products
let relatedProducts = $("#related-products").owlCarousel({
	margin: 10,
	responsiveClass: true,
	lazyLoad: true,
	dots: false,
	responsive: {
		0: {
			items: 1
		},
		600: {
			items: 2
		},
		1000: {
			items: 3
		}
	}
});

$(".related-products .next").click(function() {
	relatedProducts.trigger("next.owl.carousel");
});

$(".related-products .prev").click(function() {
	relatedProducts.trigger("prev.owl.carousel", [300]);
});
// End Related Products

window.addEventListener("load", function() {
	let form = document.getElementById("needs-validation");
	if (form) {
		form.addEventListener("submit", function(event) {
			if (form.checkValidity() === false) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add("was-validated");
		});
	}
});
