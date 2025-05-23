
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Medewerker Dashboard
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <p class="text-lg font-medium text-gray-900 mb-4">Welkom terug, medewerker!</p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="<?php echo e(route('medewerker.accounten.index')); ?>" class="block p-6 bg-blue-100 hover:bg-blue-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Accounten overzicht</h3>
                        <p class="text-sm text-gray-700">Bekijk en beheer gebruikersaccounts.</p>
                    </a>

                    <a href="<?php echo e(url('/tickets')); ?>" class="block p-6 bg-green-100 hover:bg-green-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Tickets</h3>
                        <p class="text-sm text-gray-700">Beheer tickets van klanten.</p>
                    </a>

                    <a href="<?php echo e(url('/reserveringen')); ?>" class="block p-6 bg-yellow-100 hover:bg-yellow-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Reserveringen</h3>
                        <p class="text-sm text-gray-700">Bekijk geplande reserveringen.</p>
                    </a>

                    <a href="<?php echo e(url('/voorstellingen')); ?>" class="block p-6 bg-purple-100 hover:bg-purple-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Voorstellingen</h3>
                        <p class="text-sm text-gray-700">Overzicht van alle voorstellingen.</p>
                    </a>

                    <a href="<?php echo e(url('/contactaanvragen')); ?>" class="block p-6 bg-red-100 hover:bg-red-200 rounded-lg shadow transition">
                        <h3 class="text-lg font-semibold">Contactaanvragen</h3>
                        <p class="text-sm text-gray-700">Bekijk binnengekomen berichten.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /Users/hernanmartinomolina/Desktop/Aurora Project Periode 4/aurora/resources/views/medewerker/dashboard.blade.php ENDPATH**/ ?>