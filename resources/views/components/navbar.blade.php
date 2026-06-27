<nav id="navbar" class="fixed w-full z-50 transition-all duration-500 bg-transparent py-5">
    <div class="container mx-auto px-6 flex justify-between items-center relative">
        <!-- Logo -->
        <a href="/" class="relative z-50 group">
            <span class="text-3xl font-heading font-light tracking-wider text-gradient-gold transition-all duration-300 group-hover:tracking-widest">Jass</span>
            <span class="text-gold-base text-3xl font-heading">.</span>
        </a>
        
        <!-- Desktop Nav -->
        <div class="hidden md:flex gap-10 items-center">
            <a href="/#about" class="nav-link text-sm font-accent uppercase tracking-[0.15em] text-text-secondary hover:text-gold-base transition-all duration-300 relative group">
                About
                <span class="nav-underline absolute -bottom-1 left-0 w-0 h-px bg-gradient-to-r from-gold-base to-transparent transition-all duration-500 group-hover:w-full"></span>
            </a>
            <a href="/#skills" class="nav-link text-sm font-accent uppercase tracking-[0.15em] text-text-secondary hover:text-gold-base transition-all duration-300 relative group">
                Skills
                <span class="nav-underline absolute -bottom-1 left-0 w-0 h-px bg-gradient-to-r from-gold-base to-transparent transition-all duration-500 group-hover:w-full"></span>
            </a>
            <a href="/#projects" class="nav-link text-sm font-accent uppercase tracking-[0.15em] text-text-secondary hover:text-gold-base transition-all duration-300 relative group">
                Projects
                <span class="nav-underline absolute -bottom-1 left-0 w-0 h-px bg-gradient-to-r from-gold-base to-transparent transition-all duration-500 group-hover:w-full"></span>
            </a>
            <a href="/#experience" class="nav-link text-sm font-accent uppercase tracking-[0.15em] text-text-secondary hover:text-gold-base transition-all duration-300 relative group">
                Experience
                <span class="nav-underline absolute -bottom-1 left-0 w-0 h-px bg-gradient-to-r from-gold-base to-transparent transition-all duration-500 group-hover:w-full"></span>
            </a>
            <a href="/#contact" class="nav-link text-sm font-accent uppercase tracking-[0.15em] text-text-secondary hover:text-gold-base transition-all duration-300 relative group">
                Contact
                <span class="nav-underline absolute -bottom-1 left-0 w-0 h-px bg-gradient-to-r from-gold-base to-transparent transition-all duration-500 group-hover:w-full"></span>
            </a>
        </div>

        <!-- Mobile Toggle -->
        <button id="mobile-menu-btn" aria-label="Toggle navigation menu" aria-expanded="false" class="md:hidden text-text-primary focus:outline-none relative z-50 w-8 h-8 flex flex-col justify-center items-center gap-1.5">
            <span class="w-6 h-0.5 bg-current transition-all duration-300 origin-center"></span>
            <span class="w-4 h-0.5 bg-current transition-all duration-300 origin-center ml-auto"></span>
            <span class="w-6 h-0.5 bg-current transition-all duration-300 origin-center"></span>
        </button>
    </div>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 bg-brand-primary/98 backdrop-blur-2xl flex-col items-center justify-center gap-10 text-3xl hidden z-40 opacity-0 transition-all duration-500">
        <a href="/#about" class="mobile-link font-heading font-light tracking-wider text-text-secondary hover:text-gradient-gold transition-all duration-300">About</a>
        <a href="/#skills" class="mobile-link font-heading font-light tracking-wider text-text-secondary hover:text-gradient-gold transition-all duration-300">Skills</a>
        <a href="/#projects" class="mobile-link font-heading font-light tracking-wider text-text-secondary hover:text-gradient-gold transition-all duration-300">Projects</a>
        <a href="/#experience" class="mobile-link font-heading font-light tracking-wider text-text-secondary hover:text-gradient-gold transition-all duration-300">Experience</a>
        <a href="/#contact" class="mobile-link font-heading font-light tracking-wider text-text-secondary hover:text-gradient-gold transition-all duration-300">Contact</a>
    </div>
</nav>
