<nav class="bg-white border-b border-gray-200 shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex-shrink-0 flex items-center space-x-2">
                <i class="fas fa-theater-masks text-2xl text-purple-500"></i>
                <a href="<?php echo e(url('/')); ?>" class="text-2xl font-bold text-indigo-600 hover:text-indigo-800 transition duration-200">
                    Aurora
                </a>
            </div>

            <div class="flex space-x-4 items-center">
                <!-- Always visible links -->
                <a href="<?php echo e(url('/')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">Home</a>
                <a href="<?php echo e(url('/about')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">About</a>
                <a href="<?php echo e(url('/contact')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">Contact</a>
                <a href="<?php echo e(url('/voorstellingen')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">Voorstellingen</a>

                <?php if(auth()->guard()->check()): ?>
                    <?php $role = auth()->user()->role; ?>

                    <!-- Role-specific Dashboard -->
                    <?php if($role === 'admin'): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">Dashboard</a>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">Admin Panel</a>
                    <?php elseif($role === 'medewerker'): ?>
                        <a href="<?php echo e(route('medewerker.dashboard')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">Dashboard</a>
                        <a href="<?php echo e(route('medewerker.dashboard')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">Medewerker Panel</a>
                    <?php elseif($role === 'bezoeker'): ?>
                         <a href="<?php echo e(route('bezoeker.dashboard')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">Mijn Tickets</a>
                    <?php endif; ?>

                    <!-- Profile Link -->
                    <a href="<?php echo e(route('profile.edit')); ?>" class="text-gray-700 hover:text-indigo-600 transition duration-150">Profiel</a>
                    <!-- Logout -->
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150">Logout</button>
                    </form>
                <?php else: ?>
                    <!-- Guest Links -->
                    <a href="<?php echo e(route('login')); ?>" class="text-blue-600 hover:text-blue-800 transition duration-150">Login</a>
                    <a href="<?php echo e(route('register')); ?>" class="text-green-600 hover:text-green-800 transition duration-150">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav><?php /**PATH /Users/hernanmartinomolina/Guessing game/Aurora/resources/views/partials/navbar.blade.php ENDPATH**/ ?>