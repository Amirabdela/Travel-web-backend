// Main JavaScript File

document.addEventListener("DOMContentLoaded", function () {
	// Initialize all interactive features
	initializeAnimations();
	initializeMobileMenu();
	initializeDropdowns();
	initializeBackToTop();
	initializeFormValidation();
	initializeLazyLoading();
	initializeScrollSpy();
	initializeTooltips();
	initializeCarousels();
	initializeTabs();

	// Initialize hero slider
	initHeroSlider();

	// Initialize scroll animations
	initScrollAnimations();
});

// Animation on Scroll
function initializeAnimations() {
	const animatedElements = document.querySelectorAll(".animate-in");

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add("show");
				}
			});
		},
		{
			threshold: 0.1,
		}
	);

	animatedElements.forEach((element) => observer.observe(element));
}

// Mobile Menu
function initializeMobileMenu() {
	const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
	const navMenu = document.querySelector(".nav-menu");

	if (mobileMenuToggle && navMenu) {
		mobileMenuToggle.addEventListener("click", () => {
			mobileMenuToggle.classList.toggle("active");
			navMenu.classList.toggle("active");
		});

		// Close menu when clicking outside
		document.addEventListener("click", (e) => {
			if (!navMenu.contains(e.target) && e.target !== mobileMenuToggle) {
				mobileMenuToggle.classList.remove("active");
				navMenu.classList.remove("active");
			}
		});
	}
}

// Dropdown Menus
function initializeDropdowns() {
	const dropdowns = document.querySelectorAll(".dropdown");

	dropdowns.forEach((dropdown) => {
		const trigger = dropdown.querySelector(".dropdown-toggle");
		const menu = dropdown.querySelector(".dropdown-menu");

		if (trigger && menu) {
			trigger.addEventListener("click", (e) => {
				e.preventDefault();
				menu.classList.toggle("show");
			});

			// Close dropdown when clicking outside
			document.addEventListener("click", (e) => {
				if (!dropdown.contains(e.target)) {
					menu.classList.remove("show");
				}
			});
		}
	});
}

// Back to Top Button
function initializeBackToTop() {
	const backToTopButton = document.getElementById("backToTop");

	if (backToTopButton) {
		window.addEventListener("scroll", () => {
			if (window.pageYOffset > 300) {
				backToTopButton.classList.add("show");
			} else {
				backToTopButton.classList.remove("show");
			}
		});

		backToTopButton.addEventListener("click", () => {
			window.scrollTo({
				top: 0,
				behavior: "smooth",
			});
		});
	}
}

// Form Validation
function initializeFormValidation() {
	const forms = document.querySelectorAll("form[data-validate]");

	forms.forEach((form) => {
		form.addEventListener("submit", (e) => {
			let isValid = true;
			const requiredFields = form.querySelectorAll("[required]");

			requiredFields.forEach((field) => {
				if (!field.value.trim()) {
					isValid = false;
					field.classList.add("error");

					// Add error message if not exists
					let errorMessage = field.nextElementSibling;
					if (
						!errorMessage ||
						!errorMessage.classList.contains("error-message")
					) {
						errorMessage = document.createElement("div");
						errorMessage.className = "error-message";
						field.parentNode.insertBefore(
							errorMessage,
							field.nextSibling
						);
					}
					errorMessage.textContent = "This field is required";
				} else {
					field.classList.remove("error");
					const errorMessage = field.nextElementSibling;
					if (
						errorMessage &&
						errorMessage.classList.contains("error-message")
					) {
						errorMessage.remove();
					}
				}
			});

			if (!isValid) {
				e.preventDefault();
			}
		});
	});
}

// Lazy Loading Images
function initializeLazyLoading() {
	if ("loading" in HTMLImageElement.prototype) {
		const images = document.querySelectorAll('img[loading="lazy"]');
		images.forEach((img) => {
			img.src = img.dataset.src;
		});
	} else {
		// Fallback for browsers that don't support lazy loading
		const script = document.createElement("script");
		script.src =
			"https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js";
		document.body.appendChild(script);
	}
}

// Scroll Spy
function initializeScrollSpy() {
	const sections = document.querySelectorAll("section[id]");
	const navLinks = document.querySelectorAll(".nav-link");

	window.addEventListener("scroll", () => {
		let current = "";

		sections.forEach((section) => {
			const sectionTop = section.offsetTop;
			const sectionHeight = section.clientHeight;

			if (window.pageYOffset >= sectionTop - 60) {
				current = section.getAttribute("id");
			}
		});

		navLinks.forEach((link) => {
			link.classList.remove("active");
			if (link.getAttribute("href").slice(1) === current) {
				link.classList.add("active");
			}
		});
	});
}

// Tooltips
function initializeTooltips() {
	const tooltips = document.querySelectorAll("[data-tooltip]");

	tooltips.forEach((tooltip) => {
		tooltip.addEventListener("mouseenter", (e) => {
			const tooltipText = tooltip.getAttribute("data-tooltip");
			const tooltipEl = document.createElement("div");
			tooltipEl.className = "tooltip";
			tooltipEl.textContent = tooltipText;

			document.body.appendChild(tooltipEl);

			const rect = tooltip.getBoundingClientRect();
			tooltipEl.style.top = rect.top - tooltipEl.offsetHeight - 10 + "px";
			tooltipEl.style.left =
				rect.left + (rect.width - tooltipEl.offsetWidth) / 2 + "px";
		});

		tooltip.addEventListener("mouseleave", () => {
			const tooltipEl = document.querySelector(".tooltip");
			if (tooltipEl) {
				tooltipEl.remove();
			}
		});
	});
}

// Carousels
function initializeCarousels() {
	const carousels = document.querySelectorAll(".carousel");

	carousels.forEach((carousel) => {
		const slides = carousel.querySelectorAll(".carousel-slide");
		const prevBtn = carousel.querySelector(".carousel-prev");
		const nextBtn = carousel.querySelector(".carousel-next");
		let currentSlide = 0;

		function showSlide(index) {
			slides.forEach((slide, i) => {
				slide.style.display = i === index ? "block" : "none";
			});
		}

		if (prevBtn && nextBtn) {
			prevBtn.addEventListener("click", () => {
				currentSlide =
					(currentSlide - 1 + slides.length) % slides.length;
				showSlide(currentSlide);
			});

			nextBtn.addEventListener("click", () => {
				currentSlide = (currentSlide + 1) % slides.length;
				showSlide(currentSlide);
			});
		}

		// Auto-advance slides
		setInterval(() => {
			currentSlide = (currentSlide + 1) % slides.length;
			showSlide(currentSlide);
		}, 5000);
	});
}

// Tabs
function initializeTabs() {
	const tabContainers = document.querySelectorAll(".tabs");

	tabContainers.forEach((container) => {
		const tabs = container.querySelectorAll(".tab");
		const contents = container.querySelectorAll(".tab-content");

		tabs.forEach((tab) => {
			tab.addEventListener("click", () => {
				const target = tab.getAttribute("data-target");

				// Update active states
				tabs.forEach((t) => t.classList.remove("active"));
				contents.forEach((c) => c.classList.remove("active"));

				tab.classList.add("active");
				container
					.querySelector(`.tab-content[data-content="${target}"]`)
					.classList.add("active");
			});
		});
	});
}

// Animation initialization
function initAnimations() {
	// Initialize animation observer
	const animationObserver = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add("show");
				}
			});
		},
		{
			threshold: 0.1,
		}
	);

	// Observe all elements with animate-in class
	document.querySelectorAll(".animate-in").forEach((element) => {
		animationObserver.observe(element);
	});

	// Hero Slider
	const heroSlider = document.querySelector(".hero-slider");
	if (heroSlider) {
		const slides = heroSlider.querySelectorAll(".hero-slide");
		const dots = heroSlider.querySelectorAll(".nav-dot");
		let currentSlide = 0;
		let slideInterval;

		function showSlide(index) {
			slides.forEach((slide) => slide.classList.remove("active"));
			dots.forEach((dot) => dot.classList.remove("active"));

			slides[index].classList.add("active");
			dots[index].classList.add("active");
			currentSlide = index;
		}

		function nextSlide() {
			currentSlide = (currentSlide + 1) % slides.length;
			showSlide(currentSlide);
		}

		// Initialize slider
		if (slides.length > 0) {
			showSlide(0);
			slideInterval = setInterval(nextSlide, 5000);

			// Add click handlers to dots
			dots.forEach((dot, index) => {
				dot.addEventListener("click", () => {
					clearInterval(slideInterval);
					showSlide(index);
					slideInterval = setInterval(nextSlide, 5000);
				});
			});
		}
	}

	// Scroll Animations
	const scrollObserver = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add("animate-in");
				}
			});
		},
		{
			threshold: 0.1,
		}
	);

	document.querySelectorAll(".scroll-animate").forEach((element) => {
		scrollObserver.observe(element);
	});

	// Smooth Scroll
	document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
		anchor.addEventListener("click", function (e) {
			e.preventDefault();
			const target = document.querySelector(this.getAttribute("href"));
			if (target) {
				target.scrollIntoView({
					behavior: "smooth",
					block: "start",
				});
			}
		});
	});
}

// Initialize animations when elements come into view
const animateOnScroll = () => {
	const elements = document.querySelectorAll(".animate-in");

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (entry.isIntersecting) {
					entry.target.classList.add("show");
					observer.unobserve(entry.target);
				}
			});
		},
		{
			threshold: 0.1,
		}
	);

	elements.forEach((element) => {
		observer.observe(element);
	});
};

// Hero Slider
const initHeroSlider = () => {
	const slides = document.querySelectorAll(".hero-slide");
	const dots = document.querySelectorAll(".slider-dot");
	let currentSlide = 0;

	const showSlide = (index) => {
		slides.forEach((slide) => slide.classList.remove("active"));
		dots.forEach((dot) => dot.classList.remove("active"));

		slides[index].classList.add("active");
		dots[index].classList.add("active");
	};

	const nextSlide = () => {
		currentSlide = (currentSlide + 1) % slides.length;
		showSlide(currentSlide);
	};

	// Auto slide every 5 seconds
	setInterval(nextSlide, 5000);

	// Manual navigation
	dots.forEach((dot, index) => {
		dot.addEventListener("click", () => {
			currentSlide = index;
			showSlide(currentSlide);
		});
	});
};

// Mobile Menu Toggle
const initMobileMenu = () => {
	const menuToggle = document.querySelector(".mobile-menu-toggle");
	const navMenu = document.querySelector(".nav-menu");
	const dropdowns = document.querySelectorAll(".dropdown > .nav-link");

	menuToggle?.addEventListener("click", () => {
		menuToggle.classList.toggle("active");
		navMenu.classList.toggle("active");
	});

	// Handle dropdowns in mobile view
	dropdowns.forEach((dropdown) => {
		dropdown.addEventListener("click", (e) => {
			if (window.innerWidth <= 992) {
				e.preventDefault();
				const menu = dropdown.nextElementSibling;
				menu.style.display =
					menu.style.display === "block" ? "none" : "block";
			}
		});
	});

	// Close menu when clicking outside
	document.addEventListener("click", (e) => {
		if (!navMenu?.contains(e.target) && e.target !== menuToggle) {
			menuToggle?.classList.remove("active");
			navMenu?.classList.remove("active");
		}
	});
};

// Smooth Scroll
const initSmoothScroll = () => {
	document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
		anchor.addEventListener("click", function (e) {
			e.preventDefault();
			const target = document.querySelector(this.getAttribute("href"));
			if (target) {
				target.scrollIntoView({
					behavior: "smooth",
					block: "start",
				});
			}
		});
	});
};

// Back to Top Button
const initBackToTop = () => {
	const backToTop = document.querySelector(".back-to-top");

	window.addEventListener("scroll", () => {
		if (window.pageYOffset > 300) {
			backToTop?.classList.add("show");
		} else {
			backToTop?.classList.remove("show");
		}
	});

	backToTop?.addEventListener("click", () => {
		window.scrollTo({
			top: 0,
			behavior: "smooth",
		});
	});
};

// Form Validation
const initFormValidation = () => {
	const forms = document.querySelectorAll("form");

	forms.forEach((form) => {
		form.addEventListener("submit", (e) => {
			const requiredFields = form.querySelectorAll("[required]");
			let isValid = true;

			requiredFields.forEach((field) => {
				if (!field.value.trim()) {
					isValid = false;
					field.classList.add("error");

					// Add error message if not exists
					let errorMessage = field.nextElementSibling;
					if (
						!errorMessage ||
						!errorMessage.classList.contains("error-message")
					) {
						errorMessage = document.createElement("span");
						errorMessage.className = "error-message";
						field.parentNode.insertBefore(
							errorMessage,
							field.nextSibling
						);
					}
					errorMessage.textContent = "This field is required";
				} else {
					field.classList.remove("error");
					const errorMessage = field.nextElementSibling;
					if (
						errorMessage &&
						errorMessage.classList.contains("error-message")
					) {
						errorMessage.remove();
					}
				}
			});

			if (!isValid) {
				e.preventDefault();
			}
		});

		// Clear error on input
		form.querySelectorAll("input, textarea").forEach((field) => {
			field.addEventListener("input", () => {
				field.classList.remove("error");
				const errorMessage = field.nextElementSibling;
				if (
					errorMessage &&
					errorMessage.classList.contains("error-message")
				) {
					errorMessage.remove();
				}
			});
		});
	});
};

// Image Lazy Loading
const initLazyLoading = () => {
	if ("loading" in HTMLImageElement.prototype) {
		const images = document.querySelectorAll('img[loading="lazy"]');
		images.forEach((img) => {
			img.src = img.dataset.src;
		});
	} else {
		// Fallback for browsers that don't support lazy loading
		const script = document.createElement("script");
		script.src =
			"https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js";
		document.body.appendChild(script);
	}
};
