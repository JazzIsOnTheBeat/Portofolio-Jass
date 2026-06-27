import './bootstrap';

// ─── Toast Function (defined early so inline scripts can call it) ───
window.showToast = function(message, type = 'success') {
    const container = document.getElementById('toast-container');
    if (!container) return;
    
    const toast = document.createElement('div');
    const icon = type === 'success' 
        ? '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
        : '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
    
    toast.className = `toast-enter px-6 py-4 backdrop-blur-xl border flex items-center gap-3 font-accent text-sm uppercase tracking-wider ${type === 'success' ? 'bg-green-500/10 border-green-500/20 text-green-400' : 'bg-red-500/10 border-red-500/20 text-red-400'}`;
    toast.innerHTML = `${icon}<span>${message}</span>`;
    
    container.appendChild(toast);
    
    setTimeout(() => toast.classList.add('toast-enter-active'), 10);
    
    setTimeout(() => {
        toast.classList.remove('toast-enter', 'toast-enter-active');
        toast.classList.add('toast-leave');
        setTimeout(() => toast.remove(), 400);
    }, 3500);
};

document.addEventListener('DOMContentLoaded', () => {
    // ─── 0. Loader ───
    const loader = document.getElementById('loader');
    if (loader) {
        window.addEventListener('load', () => {
            setTimeout(() => {
                loader.style.opacity = '0';
                loader.style.pointerEvents = 'none';
                setTimeout(() => loader.remove(), 700);
            }, 600);
        });
    }

    // ─── 1. Cursor Glow (desktop only) ───
    if (window.innerWidth > 768) {
        const glow = document.createElement('div');
        glow.id = 'cursor-glow';
        document.body.appendChild(glow);

        let mouseX = 0, mouseY = 0, glowX = 0, glowY = 0;

        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        // Smooth interpolation for cursor glow
        function animateGlow() {
            glowX += (mouseX - glowX) * 0.08;
            glowY += (mouseY - glowY) * 0.08;
            glow.style.left = glowX + 'px';
            glow.style.top = glowY + 'px';
            requestAnimationFrame(animateGlow);
        }
        animateGlow();
    }

    // ─── 2. Typewriter Effect ───
    const typeTarget = document.querySelector('.typewriter');
    if (typeTarget) {
        const words = ['AI & Web Developer', 'Software Engineer', 'Tech Enthusiast'];
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function type() {
            const currentWord = words[wordIndex];
            if (isDeleting) {
                typeTarget.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typeTarget.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
            }

            let typeSpeed = isDeleting ? 40 : 80;

            if (!isDeleting && charIndex === currentWord.length) {
                typeSpeed = 2500;
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                typeSpeed = 600;
            }

            setTimeout(type, typeSpeed);
        }
        setTimeout(type, 1200);
    }

    // ─── 3. Scroll Reveal (with blur) ───
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.scroll-reveal').forEach(el => {
        revealObserver.observe(el);
    });

    // Also handle legacy scroll-animate class
    document.querySelectorAll('.scroll-animate').forEach(el => {
        el.classList.add('scroll-reveal');
        revealObserver.observe(el);
    });

    // ─── 4. Navbar Scroll Effect ───
    const navbar = document.getElementById('navbar');
    if (navbar) {
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.scrollY;
            
            if (currentScroll > 80) {
                navbar.style.background = 'rgba(6,6,8,0.85)';
                navbar.style.backdropFilter = 'blur(20px) saturate(1.5)';
                navbar.style.borderBottom = '1px solid rgba(255,255,255,0.03)';
                navbar.style.padding = '0.75rem 0';
            } else {
                navbar.style.background = 'transparent';
                navbar.style.backdropFilter = 'none';
                navbar.style.borderBottom = 'none';
                navbar.style.padding = '1.25rem 0';
            }
            
            lastScroll = currentScroll;
        });

        // Active section highlighting
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 200;
                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('nav-link-active');
                const href = link.getAttribute('href');
                if (href && href.includes(current) && current) {
                    link.classList.add('nav-link-active');
                }
            });
        });
    }

    // ─── 5. Mobile Menu ───
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            const isOpen = document.body.classList.toggle('menu-open');
            menuBtn.setAttribute('aria-expanded', isOpen);
        });
        document.querySelectorAll('.mobile-link').forEach(link => {
            link.addEventListener('click', () => document.body.classList.remove('menu-open'));
        });
    }

    // ─── 6. Particle Canvas ───
    const canvas = document.getElementById('particleCanvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        let width, height;
        let particles = [];
        let mouse = { x: null, y: null };

        function initCanvas() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        }

        class Particle {
            constructor() {
                this.reset();
            }
            reset() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.size = Math.random() * 1.5 + 0.5;
                this.speedX = (Math.random() - 0.5) * 0.3;
                this.speedY = (Math.random() - 0.5) * 0.3;
                this.opacity = Math.random() * 0.4 + 0.05;
                this.baseOpacity = this.opacity;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;

                // Mouse interaction
                if (mouse.x !== null) {
                    const dx = this.x - mouse.x;
                    const dy = this.y - mouse.y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 150) {
                        this.opacity = this.baseOpacity + (1 - dist / 150) * 0.5;
                    } else {
                        this.opacity += (this.baseOpacity - this.opacity) * 0.05;
                    }
                }

                if (this.x > width + 10 || this.x < -10 || this.y > height + 10 || this.y < -10) {
                    this.reset();
                }
            }
            draw() {
                ctx.fillStyle = `rgba(201, 168, 76, ${this.opacity})`;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        // Draw connections between nearby particles
        function drawConnections() {
            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const dx = particles[i].x - particles[j].x;
                    const dy = particles[i].y - particles[j].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    
                    if (dist < 120) {
                        const opacity = (1 - dist / 120) * 0.06;
                        ctx.strokeStyle = `rgba(201, 168, 76, ${opacity})`;
                        ctx.lineWidth = 0.5;
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(particles[j].x, particles[j].y);
                        ctx.stroke();
                    }
                }
            }
        }

        function animateCanvas() {
            ctx.clearRect(0, 0, width, height);
            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].draw();
            }
            drawConnections();
            requestAnimationFrame(animateCanvas);
        }

        initCanvas();
        const particleCount = Math.min(60, Math.floor(width / 25));
        for (let i = 0; i < particleCount; i++) particles.push(new Particle());
        animateCanvas();

        canvas.addEventListener('mousemove', (e) => {
            const rect = canvas.getBoundingClientRect();
            mouse.x = e.clientX - rect.left;
            mouse.y = e.clientY - rect.top;
        });
        canvas.addEventListener('mouseleave', () => {
            mouse.x = null;
            mouse.y = null;
        });

        window.addEventListener('resize', () => {
            initCanvas();
        });
    }

    // ─── 7. Animated Counters ───
    const counters = document.querySelectorAll('.counter');
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const end = parseInt(target.getAttribute('data-target'));
                let start = 0;
                const duration = 2000;
                const startTime = performance.now();

                function easeOutCubic(t) {
                    return 1 - Math.pow(1 - t, 3);
                }

                function update(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const easedProgress = easeOutCubic(progress);
                    
                    target.innerText = Math.round(easedProgress * end);
                    
                    if (progress < 1) {
                        requestAnimationFrame(update);
                    } else {
                        target.innerText = end;
                    }
                }
                requestAnimationFrame(update);
                counterObserver.unobserve(target);
            }
        });
    }, { threshold: 0.5 });
    counters.forEach(c => counterObserver.observe(c));

    // ─── 8. Skill Progress Bars ───
    const skillBars = document.querySelectorAll('.skill-progress');
    const skillObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                setTimeout(() => {
                    bar.style.width = bar.getAttribute('data-width');
                    bar.style.opacity = '1';
                }, 200);
                skillObserver.unobserve(bar);
            }
        });
    }, { threshold: 0.3 });
    skillBars.forEach(bar => skillObserver.observe(bar));

    // ─── 9. Testimonial Carousel ───
    const track = document.querySelector('.testimonial-carousel');
    const dots = document.querySelectorAll('.carousel-dots button');
    if (track && dots.length > 0) {
        let currentIndex = 0;
        let interval;

        function goToSlide(index) {
            track.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach(d => {
                d.className = 'h-1.5 rounded-full transition-all duration-500 bg-white/10 w-3 hover:bg-white/30';
            });
            if (dots[index]) {
                dots[index].className = 'h-1.5 rounded-full transition-all duration-500 bg-gold-base w-8';
            }
            currentIndex = index;
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                goToSlide(index);
                resetInterval();
            });
        });

        function resetInterval() {
            clearInterval(interval);
            interval = setInterval(() => {
                currentIndex = (currentIndex + 1) % dots.length;
                goToSlide(currentIndex);
            }, 6000);
        }
        resetInterval();
    }

    // ─── 10. Back to Top ───
    const backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 600) {
                backToTop.classList.remove('opacity-0', 'translate-y-4');
                backToTop.classList.add('opacity-100', 'translate-y-0');
            } else {
                backToTop.classList.add('opacity-0', 'translate-y-4');
                backToTop.classList.remove('opacity-100', 'translate-y-0');
            }
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ─── 11. Magnetic Buttons ───
    document.querySelectorAll('.magnetic-btn').forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            btn.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0, 0)';
        });
    });

    // ─── 12. Tilt Cards ───
    document.querySelectorAll('.tilt-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            card.style.transform = `perspective(800px) rotateY(${x * 6}deg) rotateX(${-y * 6}deg) translateY(-8px)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(800px) rotateY(0) rotateX(0) translateY(0)';
        });
    });

    // ─── 14. Smooth Scroll for Anchor Links ───
    document.querySelectorAll('a[href^="/#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const hash = this.getAttribute('href').replace('/', '');
            const target = document.querySelector(hash);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                history.pushState(null, '', hash);
            }
        });
    });
});
