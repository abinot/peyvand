<?php # [BlazeFolded]:{flux::main}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/main.blade.php}:{1790619292} ?>
<?php if (isset($component)) { $__componentOriginal6dc4121bc431495fca9ae0c45cebd96e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6dc4121bc431495fca9ae0c45cebd96e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'f4ac99e09542ff494432bc959d4fee61::app.header','data' => ['title' => $title ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts::app.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title ?? null)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php ob_start(); ?><div class="[grid-area:main] p-6 lg:p-8   [[data-flux-container]_&amp;]:px-0" data-flux-main >
            <?php ob_start(); ?>
        <?php echo e($slot); ?>

    <?php echo trim(ob_get_clean()); ?>

    </div>
<?php echo ltrim(ob_get_clean()); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6dc4121bc431495fca9ae0c45cebd96e)): ?>
<?php $attributes = $__attributesOriginal6dc4121bc431495fca9ae0c45cebd96e; ?>
<?php unset($__attributesOriginal6dc4121bc431495fca9ae0c45cebd96e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6dc4121bc431495fca9ae0c45cebd96e)): ?>
<?php $component = $__componentOriginal6dc4121bc431495fca9ae0c45cebd96e; ?>
<?php unset($__componentOriginal6dc4121bc431495fca9ae0c45cebd96e); ?>
<?php endif; ?>
<?php /**PATH /home/ab/Desktop/Abinot/peyvand/resources/views/layouts/app.blade.php ENDPATH**/ ?>