export default {
	init() {

		// Zmiana tła dla header dark przy scrollu
		const targetElement = document.querySelector('.header-relacje-dark');
		function toggleClassOnScroll() {
			const scrollPosition = window.scrollY;
			const threshold = 20;

			if (scrollPosition > threshold) {
				targetElement.classList.add('add-bg');
			} else {
				targetElement.classList.remove('add-bg');
			}
		}
		window.addEventListener('scroll', toggleClassOnScroll);

		gsap.registerPlugin(ScrollTrigger);

		// Gsap portfolio - poruszanie się napisów na obrazkach 

		gsap.to(".relacje-portfolio .text-under, .relacje-portfolio .text-below", {
			scrollTrigger: {
				trigger: ".relacje-portfolio .text-under, .relacje-portfolio .text-below",
				start: "top bottom",
				end: "bottom top",
				scrub: 1
			},
			x: 200
		});

		gsap.to(".relacje-portfolio .image", {
			scrollTrigger: {
				trigger: ".relacje-portfolio .image",
				start: "top bottom",
				end: "bottom top",
				scrub: 1,
				//markers: true
			},
			x: -250,
		});

		// Gsap - sticky dla pozycji w portfolio

		// gsap.utils.toArray('.relacje-portfolio').forEach(section => {
		// 	ScrollTrigger.create({
		// 		trigger: section,
		// 		start: 'top top',
		// 		pin: true,
		// 		pinSpacing: false
		// 	});
		// });

		// Gsap - opóźnienie podczas scrollowania sekcji z treścią

		gsap.set(".delayed-scroll", { autoAlpha: 0, y: 50 });
		ScrollTrigger.batch(".delayed-scroll", {
			onEnter: batch => gsap.to(batch, {
				autoAlpha: 1,
				y: 0,
				stagger: 0.2,
				overwrite: true
			}),
			onLeaveBack: batch => gsap.to(batch, {
				autoAlpha: 0,
				y: 200,
				stagger: 0.2,
				overwrite: true
			}),
		});
		ScrollTrigger.addEventListener("refreshInit", () => gsap.set(".delayed-scroll", { autoAlpha: 1, y: 0 }));

		// Menu overlay
		let open_nav = document.getElementById( 'open-navigation' );
		let close_nav = document.getElementById( 'close-navigation' );
		let nav = document.getElementById( 'navigation' );
		let check = document.getElementById( 'check' );

		open_nav.addEventListener( 'click', (event) => {
			event.preventDefault();
			check.setAttribute("checked", "checked");
			document.body.classList.add( 'overflow-hidden' );
			nav.classList.add( 'top-0' );
			nav.classList.remove( '-top-full' );
		} );

		close_nav.addEventListener( 'click', (event) => {
			event.preventDefault();
			check.removeAttribute("checked", "checked");
			document.body.classList.remove( 'overflow-hidden' );
			nav.classList.remove( 'top-0' );
			nav.classList.add( '-top-full' );
		} );
	}
}



