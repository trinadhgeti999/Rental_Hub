document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }

    // Typewriter Effect
    const typewriterElement = document.querySelector('.typewriter');
    const words = ["Cars", "Stays"];
    let wordIndex = 0;
    let charIndex = 0;
    let isDeleting = false;

    function type() {
        if (!typewriterElement) return;

        const currentWord = words[wordIndex];
        if (isDeleting) {
            typewriterElement.textContent = currentWord.substring(0, charIndex - 1);
            charIndex--;
        } else {
            typewriterElement.textContent = currentWord.substring(0, charIndex + 1);
            charIndex++;
        }

        let speed = 150;
        if (isDeleting) {
            speed /= 2;
        }

        if (!isDeleting && charIndex === currentWord.length) {
            isDeleting = true;
            speed = 1000;
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            wordIndex = (wordIndex + 1) % words.length;
            speed = 500;
        }

        setTimeout(type, speed);
    }

    type();

    // Smooth Scrolling for Navigation Links and Hero Buttons
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });

            // Close mobile menu after clicking a link
            if (navLinks.classList.contains('active')) {
                navLinks.classList.remove('active');
            }
        });
    });

                // Scroll Down Arrow Functionality
    // const scrollDownArrow = document.querySelector('.scroll-down');
    // if (scrollDownArrow) {
    //     scrollDownArrow.addEventListener('click', () => {
    //         document.querySelector('#featured').scrollIntoView({
    //             behavior: 'smooth'
    //         });
    //     });
    // }


      // Smooth Infinite Auto-Scrolling Car Carousel
      const carsTrack = document.querySelector('.cars-track');
      if (carsTrack) {
          const carCards = Array.from(carsTrack.children);
          const cardWidth = carCards[0].offsetWidth + 30; // Include margin
          const numberOfCards = carCards.length;
          let carsScrollPosition = 0;
  
          // Duplicate car cards (duplicate enough to ensure continuous scroll)
          carsTrack.innerHTML += carsTrack.innerHTML + carsTrack.innerHTML;
  
          function scrollCars() {
              carsScrollPosition += 0.75;
              carsTrack.style.transform = `translateX(-${carsScrollPosition}px)`;
  
              // When the scroll position is about to reach the end of the first set of duplicates,
              // instantly reset it to the beginning of the duplicated content.
              if (carsScrollPosition >= numberOfCards * cardWidth) {
                  carsScrollPosition = 0;
              }
  
              requestAnimationFrame(scrollCars);
          }
  
          requestAnimationFrame(scrollCars);
      }
  
      // Smooth Infinite Auto-Scrolling Rooms Carousel
      const roomsTrack = document.querySelector('.rooms-track');
      if (roomsTrack) {
          const roomCards = Array.from(roomsTrack.children);
          const cardWidth = roomCards[0].offsetWidth + 30; // Include margin
          const numberOfCards = roomCards.length;
          let roomsScrollPosition = 0;
  
          // Duplicate room cards (duplicate enough to ensure continuous scroll)
          roomsTrack.innerHTML += roomsTrack.innerHTML + roomsTrack.innerHTML;
  
          function scrollRooms() {
              roomsScrollPosition += 0.75;
              roomsTrack.style.transform = `translateX(-${roomsScrollPosition}px)`;
  
              // When the scroll position is about to reach the end of the first set of duplicates,
              // instantly reset it to the beginning of the duplicated content.
              if (roomsScrollPosition >= numberOfCards * cardWidth) {
                  roomsScrollPosition = 0;
              }
  
              requestAnimationFrame(scrollRooms);
          }
  
          requestAnimationFrame(scrollRooms);
      }

});