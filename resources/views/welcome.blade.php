{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aurora Theater - Where Stories Come Alive</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            height: 100vh;
        }

        .ticket-btn {
            background: linear-gradient(45deg, #9333ea, #3b82f6);
            transition: all 0.3s ease;
        }

        .ticket-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px rgba(147, 51, 234, 0.3);
        }
    </style>
</head>
<body class="bg-slate-900 text-white">
    {{-- Include navbar --}}
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="hero relative flex items-center justify-center">
        <div class="max-w-7xl mx-auto px-6 md:px-12 text-center">
            <div class="flex justify-center mb-6">
                <i class="fas fa-theater-masks text-4xl text-purple-500"></i>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                <span class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">AURORA</span>
                <br>Where Stories Come Alive
            </h1>
            <p class="text-lg md:text-xl max-w-2xl mx-auto mb-8 text-slate-300">
                Experience the magic of live performance at Aurora Theater. World-class productions in an intimate setting.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="ticket-btn px-8 py-3 rounded-full font-bold">
                    Book Tickets <i class="fas fa-ticket-alt ml-2"></i>
                </button>
                <button class="border border-purple-500 px-8 py-3 rounded-full font-bold hover:bg-purple-900/30 transition-all">
                    Current Shows <i class="fas fa-play ml-2"></i>
                </button>
            </div>
        </div>

        <!-- Scrolling Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-2xl text-purple-400"></i>
        </div>
    </section>

    <!-- Over Aurora Theater -->
    <section class="py-20 px-6 md:px-12 bg-slate-800 text-white">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Over Aurora Theater</h2>
            <p class="text-lg text-slate-300">
                Het Aurora Theater is een plek waar verhalen tot leven komen. Van meeslepende toneelstukken tot moderne dansvoorstellingen – wij bieden een podium voor elke vorm van expressie.
            </p>
        </div>
    </section>

    <!-- Onze Missie -->
    <section class="py-20 px-6 md:px-12 bg-slate-900 text-white">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Onze Missie</h2>
            <p class="text-lg text-slate-300">
                Wij geloven in de kracht van live entertainment. Onze missie is om een inclusieve en inspirerende ervaring te bieden voor iedereen, jong en oud, door middel van hoogwaardige producties.
            </p>
        </div>
    </section>

    <!-- Kom Bij Ons Langs -->
    <section class="py-20 px-6 md:px-12 bg-slate-800 text-white">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Kom Bij Ons Langs</h2>
            <p class="text-lg text-slate-300">
                Bezoek ons theater in het hart van de stad en laat je betoveren door unieke voorstellingen, een warme sfeer en gastvrije service.
            </p>
        </div>
    </section>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>