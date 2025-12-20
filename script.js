// NAVIGACIJA
// Hamburger meni + mobile behaviors

const hamburger = document.querySelector('.hamburger');
const navContainer = document.getElementById('nav');
const navUl = navContainer ? navContainer.querySelector('nav ul') : null;

function openMenu() {
	if (!navUl) return;
	hamburger.classList.add('active');
	navContainer.classList.add('open');
	navUl.style.display = 'flex';
	document.body.style.overflow = 'hidden'; // lock body scroll on mobile
}

function closeMenu() {
	if (!navUl) return;
	hamburger.classList.remove('active');
	navContainer.classList.remove('open');
	navUl.style.display = '';
	document.body.style.overflow = ''; // restore scroll
}

if (hamburger && navContainer && navUl) {
	hamburger.addEventListener('click', (e) => {
		e.stopPropagation();
		if (navContainer.classList.contains('open')) closeMenu();
		else openMenu();
	});

	// Close when clicking a nav link
	navContainer.querySelectorAll('a').forEach(a => {
		a.addEventListener('click', () => {
			setTimeout(closeMenu, 50);
		});
	});

	// Close when clicking outside the menu
	document.addEventListener('click', (e) => {
		if (!navContainer.classList.contains('open')) return;
		if (!navContainer.contains(e.target) && !hamburger.contains(e.target)) {
			closeMenu();
		}
	});

	// Close on Escape
	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape') closeMenu();
	});

	// Reset menu on resize (desktop)
	window.addEventListener('resize', () => {
		if (window.innerWidth > 768) {
			navUl.style.display = '';
			document.body.style.overflow = '';
			hamburger.classList.remove('active');
			navContainer.classList.remove('open');
		} else {
			if (!navContainer.classList.contains('open')) navUl.style.display = '';
		}
	});
}

// Smooth scroll for internal anchors
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
	anchor.addEventListener('click', function (e) {
		const targetId = this.getAttribute('href');
		if (targetId.length > 1 && document.querySelector(targetId)) {
			e.preventDefault();
			document.querySelector(targetId).scrollIntoView({ behavior: 'smooth' });
		}
	});
});

// ABOUT SECTION SLIDESHOW

 document.querySelectorAll('.slideshow').forEach(slideshow => {
        const images = slideshow.querySelectorAll('img');
        const prev = slideshow.querySelector('.left');
        const next = slideshow.querySelector('.right');
        let index = 0;
        let autoPlay;
        let pauseTimeout;

        function showSlide(i) {
            images.forEach(img => img.classList.remove('active'));
            images[i].classList.add('active');
        }

        function startAutoPlay() {
            autoPlay = setInterval(() => {
                index = (index + 1) % images.length;

                showSlide(index);
            }, 2000);
        }

        function stopAutoPlay() {
            clearInterval(autoPlay);
            clearTimeout(pauseTimeout);
            pauseTimeout = setTimeout
            (startAutoPlay, 3000);
        }

        prev.addEventListener('click', () => {
            index = (index - 1 + images.length) % images.length;
            showSlide(index);
            stopAutoPlay();
        });

        next.addEventListener('click', () => {
            index = (index + 1) % images.length;
            showSlide(index);
            stopAutoPlay();
        });

        startAutoPlay();

    });



