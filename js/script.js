        // Load navbar from partials/navbar.html
fetch('partials/navbar.html')
  .then(res => res.text())
  .then(data => {
    document.getElementById('navbar-placeholder').innerHTML = data;

    // Reattach navbar event listeners after it's loaded
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
      mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
      });
    }

    // You can reattach other event listeners here too
  });
        
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        aurora: {
                            primary: '#6d28d9',
                            dark: '#0f172a',
                            light: '#1e293b',
                            accent: '#8b5cf6',
                        }
                    },
                    fontFamily: {
                        'sans': ['"Open Sans"', 'sans-serif'],
                        'display': ['"Playfair Display"', 'serif'],
                    },
                    backgroundImage: {
                        'hero-pattern': "url('https://images.unsplash.com/photo-1492684223066-81342ee5ff30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80')",
                        'stage-lights': "linear-gradient(to bottom, rgba(109, 40, 217, 0.3), rgba(13, 4, 28, 0.9))",
                    }
                }
            }
        }

         // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Modal functionality
        const loginBtn = document.getElementById('login-btn');
        const registerBtn = document.getElementById('register-btn');
        const loginModal = document.getElementById('login-modal');
        const registerModal = document.getElementById('register-modal');
        const closeLoginModal = document.getElementById('close-login-modal');
        const closeRegisterModal = document.getElementById('close-register-modal');
        const switchToRegister = document.getElementById('switch-to-register');
        const switchToLogin = document.getElementById('switch-to-login');
        const adminPreviewBtn = document.getElementById('admin-preview-btn');
        const adminModal = document.getElementById('admin-modal');
        const closeAdminModal = document.getElementById('close-admin-modal');
        
        function openModal(modal) {
            modal.classList.add('active');
        }
        
        function closeModal(modal) {
            modal.classList.remove('active');
        }
        
        loginBtn.addEventListener('click', () => openModal(loginModal));
        registerBtn.addEventListener('click', () => openModal(registerModal));
        closeLoginModal.addEventListener('click', () => closeModal(loginModal));
        closeRegisterModal.addEventListener('click', () => closeModal(registerModal));
        switchToRegister.addEventListener('click', () => {
            closeModal(loginModal);
            setTimeout(() => openModal(registerModal), 300);
        });
        switchToLogin.addEventListener('click', () => {
            closeModal(registerModal);
            setTimeout(() => openModal(loginModal), 300);
        });
        adminPreviewBtn.addEventListener('click', () => openModal(adminModal));
        closeAdminModal.addEventListener('click', () => closeModal(adminModal));
        
        // Close modals when clicking outside
        window.addEventListener('click', (e) => {
            if (e.target === loginModal) closeModal(loginModal);
            if (e.target === registerModal) closeModal(registerModal);
            if (e.target === adminModal) closeModal(adminModal);
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });