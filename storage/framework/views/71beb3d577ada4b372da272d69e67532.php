<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'sidebar' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'sidebar' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($sidebar): ?>
    <?php if (!function_exists('_2e5684d917805e217920e9d7e3443919')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/sidebar/brand.blade.php', $__blaze->compiledPath.'/2e5684d917805e217920e9d7e3443919.php'); require $__blaze->compiledPath.'/2e5684d917805e217920e9d7e3443919.php'; } ?>
<?php if (isset($__slots2e5684d917805e217920e9d7e3443919)) { $__slotsStack2e5684d917805e217920e9d7e3443919[] = $__slots2e5684d917805e217920e9d7e3443919; } ?>
<?php if (isset($__attrs2e5684d917805e217920e9d7e3443919)) { $__attrsStack2e5684d917805e217920e9d7e3443919[] = $__attrs2e5684d917805e217920e9d7e3443919; } ?>
<?php $__attrs2e5684d917805e217920e9d7e3443919 = ['name' => config('app.name', 'Laravel'),'attributes' => $attributes]; ?>
<?php $__slots2e5684d917805e217920e9d7e3443919 = []; ?>
<?php $__blaze->pushData($__attrs2e5684d917805e217920e9d7e3443919); ?>
<?php ob_start(); ?>
         <?php ob_start(); ?>
            <?php if (isset($component)) { $__componentOriginal159d6670770cb479b1921cea6416c26c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal159d6670770cb479b1921cea6416c26c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo-icon','data' => ['class' => 'size-5 fill-current text-white dark:text-black']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 fill-current text-white dark:text-black']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $attributes = $__attributesOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__attributesOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $component = $__componentOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__componentOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
        <?php $__slots2e5684d917805e217920e9d7e3443919['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground']); ?>
    <?php $__slots2e5684d917805e217920e9d7e3443919['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots2e5684d917805e217920e9d7e3443919); ?>
<?php _2e5684d917805e217920e9d7e3443919($__blaze, $__attrs2e5684d917805e217920e9d7e3443919, $__slots2e5684d917805e217920e9d7e3443919, ['name', 'attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack2e5684d917805e217920e9d7e3443919)) { $__slots2e5684d917805e217920e9d7e3443919 = array_pop($__slotsStack2e5684d917805e217920e9d7e3443919); } ?>
<?php if (! empty($__attrsStack2e5684d917805e217920e9d7e3443919)) { $__attrs2e5684d917805e217920e9d7e3443919 = array_pop($__attrsStack2e5684d917805e217920e9d7e3443919); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php if (!function_exists('_873c22d06261bc8b24d5ab7143b653a7')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/brand.blade.php', $__blaze->compiledPath.'/873c22d06261bc8b24d5ab7143b653a7.php'); require $__blaze->compiledPath.'/873c22d06261bc8b24d5ab7143b653a7.php'; } ?>
<?php if (isset($__slots873c22d06261bc8b24d5ab7143b653a7)) { $__slotsStack873c22d06261bc8b24d5ab7143b653a7[] = $__slots873c22d06261bc8b24d5ab7143b653a7; } ?>
<?php if (isset($__attrs873c22d06261bc8b24d5ab7143b653a7)) { $__attrsStack873c22d06261bc8b24d5ab7143b653a7[] = $__attrs873c22d06261bc8b24d5ab7143b653a7; } ?>
<?php $__attrs873c22d06261bc8b24d5ab7143b653a7 = ['name' => config('app.name', 'Laravel'),'attributes' => $attributes]; ?>
<?php $__slots873c22d06261bc8b24d5ab7143b653a7 = []; ?>
<?php $__blaze->pushData($__attrs873c22d06261bc8b24d5ab7143b653a7); ?>
<?php ob_start(); ?>
         <?php ob_start(); ?>
            <?php if (isset($component)) { $__componentOriginal159d6670770cb479b1921cea6416c26c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal159d6670770cb479b1921cea6416c26c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-logo-icon','data' => ['class' => 'size-5 fill-current text-white dark:text-black']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-logo-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-5 fill-current text-white dark:text-black']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $attributes = $__attributesOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__attributesOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal159d6670770cb479b1921cea6416c26c)): ?>
<?php $component = $__componentOriginal159d6670770cb479b1921cea6416c26c; ?>
<?php unset($__componentOriginal159d6670770cb479b1921cea6416c26c); ?>
<?php endif; ?>
        <?php $__slots873c22d06261bc8b24d5ab7143b653a7['logo'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), ['class' => 'flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground']); ?>
    <?php $__slots873c22d06261bc8b24d5ab7143b653a7['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slots873c22d06261bc8b24d5ab7143b653a7); ?>
<?php _873c22d06261bc8b24d5ab7143b653a7($__blaze, $__attrs873c22d06261bc8b24d5ab7143b653a7, $__slots873c22d06261bc8b24d5ab7143b653a7, ['name', 'attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack873c22d06261bc8b24d5ab7143b653a7)) { $__slots873c22d06261bc8b24d5ab7143b653a7 = array_pop($__slotsStack873c22d06261bc8b24d5ab7143b653a7); } ?>
<?php if (! empty($__attrsStack873c22d06261bc8b24d5ab7143b653a7)) { $__attrs873c22d06261bc8b24d5ab7143b653a7 = array_pop($__attrsStack873c22d06261bc8b24d5ab7143b653a7); } ?>
<?php $__blaze->popData(); ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /home/ab/Desktop/Abinot/peyvand/resources/views/components/app-logo.blade.php ENDPATH**/ ?>