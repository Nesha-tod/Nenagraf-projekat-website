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



