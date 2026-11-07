<?php
if (!function_exists('__474b7e49bc608a3e30503b34483c2a71')):
function __474b7e49bc608a3e30503b34483c2a71($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php $iconTrailing ??= $attributes->pluck('icon:trailing'); ?>
<?php $iconLeading ??= $attributes->pluck('icon:leading'); ?>
<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>
<?php $maskDynamic ??= $attributes->pluck('mask:dynamic'); ?>

<?php
$__defaults = [
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'iconVariant' => 'mini',
    'variant' => 'outline',
    'iconTrailing' => null,
    'iconLeading' => null,
    'maskDynamic' => null,
    'expandable' => null,
    'clearable' => null,
    'copyable' => null,
    'viewable' => null,
    'invalid' => null,
    'loading' => null,
    'type' => 'text',
    'mask' => null,
    'size' => null,
    'icon' => null,
    'kbd' => null,
    'as' => null,
];
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$variant ??= $attributes['variant'] ?? $__defaults['variant']; unset($attributes['variant']);
$iconTrailing ??= $attributes['icon-trailing'] ?? $attributes['iconTrailing'] ?? $__defaults['iconTrailing']; unset($attributes['iconTrailing'], $attributes['icon-trailing']);
$iconLeading ??= $attributes['icon-leading'] ?? $attributes['iconLeading'] ?? $__defaults['iconLeading']; unset($attributes['iconLeading'], $attributes['icon-leading']);
$maskDynamic ??= $attributes['mask-dynamic'] ?? $attributes['maskDynamic'] ?? $__defaults['maskDynamic']; unset($attributes['maskDynamic'], $attributes['mask-dynamic']);
$expandable ??= $attributes['expandable'] ?? $__defaults['expandable']; unset($attributes['expandable']);
$clearable ??= $attributes['clearable'] ?? $__defaults['clearable']; unset($attributes['clearable']);
$copyable ??= $attributes['copyable'] ?? $__defaults['copyable']; unset($attributes['copyable']);
$viewable ??= $attributes['viewable'] ?? $__defaults['viewable']; unset($attributes['viewable']);
$invalid ??= $attributes['invalid'] ?? $__defaults['invalid']; unset($attributes['invalid']);
$loading ??= $attributes['loading'] ?? $__defaults['loading']; unset($attributes['loading']);
$type ??= $attributes['type'] ?? $__defaults['type']; unset($attributes['type']);
$mask ??= $attributes['mask'] ?? $__defaults['mask']; unset($attributes['mask']);
$size ??= $attributes['size'] ?? $__defaults['size']; unset($attributes['size']);
$icon ??= $attributes['icon'] ?? $__defaults['icon']; unset($attributes['icon']);
$kbd ??= $attributes['kbd'] ?? $__defaults['kbd']; unset($attributes['kbd']);
$as ??= $attributes['as'] ?? $__defaults['as']; unset($attributes['as']);
unset($__defaults);
?>

<?php

$inputAttributes = Flux::attributesAfter('input:', $attributes, []);

// There are a few loading scenarios that this covers:
// If `:loading="false"` then never show loading.
// If `:loading="true"` then always show loading.
// If `:loading="foo"` then show loading when `foo` request is happening.
// If `wire:model` then never show loading.
// If `wire:model.live` then show loading when the `wire:model` value request is happening.
$wireModel = $attributes->wire('model');
$wireTarget = null;

if ($loading !== false) {
    if ($loading === true) {
        $loading = true;
    } elseif ($wireModel?->directive) {
        $loading = $wireModel->hasModifier('live');
        $wireTarget = $loading ? $wireModel->value() : null;
    } else {
        $wireTarget = $loading;
        $loading = (bool) $loading;
    }
}

$iconLeading ??= $icon;

$hasLeadingIcon = (bool) ($iconLeading);
$countOfTrailingIcons = collect([
    (bool) $iconTrailing,
    (bool) $kbd,
    (bool) $clearable,
    (bool) $copyable,
    (bool) $viewable,
    (bool) $expandable,
])->filter()->count();

$iconClasses = Flux::classes()
    // When using the outline icon variant, we need to size it down to match the default icon sizes...
    ->add($iconVariant === 'outline' ? 'size-5' : '')
    ;

$inputLoadingClasses = Flux::classes()
    // When loading, we need to add some extra padding to the input to account for the loading icon...
    ->add(match ($countOfTrailingIcons) {
        0 => 'pe-10',
        1 => 'pe-16',
        2 => 'pe-23',
        3 => 'pe-30',
        4 => 'pe-37',
        5 => 'pe-44',
        6 => 'pe-51',
    })
    ;

$classes = Flux::classes()
    ->add('w-full border block disabled:shadow-none dark:shadow-none')
    ->add('appearance-none') // Without this, input[type="date"] on mobile doesn't respect w-full...
    ->add(match ($size) {
        default => 'text-base sm:text-sm rounded-lg py-2 h-10 leading-[1.375rem]', // This makes the height of the input 40px (same as buttons and such...)
        'sm' => 'text-sm rounded-md py-1.5 h-8 leading-[1.125rem]',
        'xs' => 'text-xs rounded-md py-1.5 h-6 leading-[1.125rem]',
    })
    ->add(match ($hasLeadingIcon) {
        true => 'ps-10',
        false => 'ps-3',
    })
    ->add(match ($countOfTrailingIcons) {
        // Make sure there's enough padding on the right side of the input to account for all the icons...
        0 => 'pe-3',
        1 => 'pe-10',
        2 => 'pe-16',
        3 => 'pe-23',
        4 => 'pe-30',
        5 => 'pe-37',
        6 => 'pe-44',
    })
    ->add(match ($variant) { // Background...
        'outline' => 'bg-white dark:bg-white/10 dark:disabled:bg-white/[7%]',
        'filled'  => 'bg-zinc-800/5 dark:bg-white/10 dark:disabled:bg-white/[7%]',
    })
    ->add(match ($variant) { // Text color
        'outline' => 'text-zinc-700 disabled:text-zinc-500 placeholder-zinc-400 disabled:placeholder-zinc-400/70 dark:text-zinc-300 dark:disabled:text-zinc-400 dark:placeholder-zinc-400 dark:disabled:placeholder-zinc-500',
        'filled'  => 'text-zinc-700 placeholder-zinc-500 disabled:placeholder-zinc-400 dark:text-zinc-200 dark:placeholder-white/60 dark:disabled:placeholder-white/40',
    })
    ->add(match ($variant) { // Border...
        'outline' => 'shadow-xs border-zinc-200 border-b-zinc-300/80 disabled:border-b-zinc-200 dark:border-white/10 dark:disabled:border-white/5',
        'filled'  => 'border-0',
    })
    ->add(match ($variant) { // Invalid...
        'outline' => 'data-invalid:shadow-none data-invalid:border-red-500 dark:data-invalid:border-red-500 disabled:data-invalid:border-red-500 dark:disabled:data-invalid:border-red-500',
        'filled' => 'data-invalid:border-red-500'
    })
    ->add($attributes->pluck('class:input'))
    ;
?>

<?php if ($type === 'file'): ?>
    <?php if (!function_exists('__7264bcdd308cee3a8f7c5b749917a400')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/with-field.blade.php', $__blaze->compiledPath.'/7264bcdd308cee3a8f7c5b749917a400.php'); require $__blaze->compiledPath.'/7264bcdd308cee3a8f7c5b749917a400.php'; } ?>
<?php if (isset($__slots7264bcdd308cee3a8f7c5b749917a400)) { $__slotsStack7264bcdd308cee3a8f7c5b749917a400[] = $__slots7264bcdd308cee3a8f7c5b749917a400; } ?>
<?php if (isset($__attrs7264bcdd308cee3a8f7c5b749917a400)) { $__attrsStack7264bcdd308cee3a8f7c5b749917a400[] = $__attrs7264bcdd308cee3a8f7c5b749917a400; } ?>
<?php $__attrs7264bcdd308cee3a8f7c5b749917a400 = ['attributes' => $attributes,'name' => $name]; ?>
<?php $__slots7264bcdd308cee3a8f7c5b749917a400 = []; ?>
<?php $__blaze->pushData($__attrs7264bcdd308cee3a8f7c5b749917a400); ?>
<?php ob_start(); ?>
        <?php if (!function_exists('__e023120033544decdf10a2d446c3e895')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/input/file.blade.php', $__blaze->compiledPath.'/e023120033544decdf10a2d446c3e895.php'); require $__blaze->compiledPath.'/e023120033544decdf10a2d446c3e895.php'; } ?>
<?php $__blaze->pushData(['attributes' => $attributes,'name' => $name,'size' => $size]); ?>
<?php __e023120033544decdf10a2d446c3e895($__blaze, ['attributes' => $attributes,'name' => $name,'size' => $size], [], ['attributes', 'name', 'size'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
    <?php $__slots7264bcdd308cee3a8f7c5b749917a400['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots7264bcdd308cee3a8f7c5b749917a400); ?>
<?php __7264bcdd308cee3a8f7c5b749917a400($__blaze, $__attrs7264bcdd308cee3a8f7c5b749917a400, $__slots7264bcdd308cee3a8f7c5b749917a400, ['attributes', 'name'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack7264bcdd308cee3a8f7c5b749917a400)) { $__slots7264bcdd308cee3a8f7c5b749917a400 = array_pop($__slotsStack7264bcdd308cee3a8f7c5b749917a400); } ?>
<?php if (! empty($__attrsStack7264bcdd308cee3a8f7c5b749917a400)) { $__attrs7264bcdd308cee3a8f7c5b749917a400 = array_pop($__attrsStack7264bcdd308cee3a8f7c5b749917a400); } ?>
<?php $__blaze->popData(); ?>
<?php elseif ($as !== 'button'): ?>
    <?php if (!function_exists('__7264bcdd308cee3a8f7c5b749917a400')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/with-field.blade.php', $__blaze->compiledPath.'/7264bcdd308cee3a8f7c5b749917a400.php'); require $__blaze->compiledPath.'/7264bcdd308cee3a8f7c5b749917a400.php'; } ?>
<?php if (isset($__slots7264bcdd308cee3a8f7c5b749917a400)) { $__slotsStack7264bcdd308cee3a8f7c5b749917a400[] = $__slots7264bcdd308cee3a8f7c5b749917a400; } ?>
<?php if (isset($__attrs7264bcdd308cee3a8f7c5b749917a400)) { $__attrsStack7264bcdd308cee3a8f7c5b749917a400[] = $__attrs7264bcdd308cee3a8f7c5b749917a400; } ?>
<?php $__attrs7264bcdd308cee3a8f7c5b749917a400 = ['attributes' => $attributes,'name' => $name]; ?>
<?php $__slots7264bcdd308cee3a8f7c5b749917a400 = []; ?>
<?php $__blaze->pushData($__attrs7264bcdd308cee3a8f7c5b749917a400); ?>
<?php ob_start(); ?>
        <div <?php echo e($attributes->only('class')->class('w-full relative block group/input')); ?> data-flux-input>
            <?php if (is_string($iconLeading) && $iconLeading !== ''): ?>
                <div class="pointer-events-none absolute top-0 bottom-0 border-s border-transparent flex items-center justify-center text-xs text-zinc-400/75 dark:text-white/60 ps-3 start-0">
                    <?php if (!function_exists('__3398e70f820e2fe274a1d1aaa7c5636c')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'); require $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'; } ?>
<?php $__blaze->pushData(['icon' => $iconLeading,'variant' => $iconVariant,'class' => $iconClasses]); ?>
<?php __3398e70f820e2fe274a1d1aaa7c5636c($__blaze, ['icon' => $iconLeading,'variant' => $iconVariant,'class' => $iconClasses], [], ['icon', 'variant', 'class'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                </div>
            <?php elseif ($iconLeading): ?>
                <div <?php echo e($iconLeading->attributes->class('absolute top-0 bottom-0 border-s border-transparent flex items-center justify-center text-xs text-zinc-400/75 dark:text-white/60 ps-3 start-0')); ?>>
                    <?php echo e($iconLeading); ?>

                </div>
            <?php endif; ?>

            <input
                type="<?php echo e($type); ?>"
                
                <?php echo e($attributes->except('class')->class($type === 'file' ? '' : $classes)->merge($inputAttributes->getAttributes())); ?>

                <?php if (isset($name)): ?> name="<?php echo e($name); ?>" <?php endif; ?>
                <?php if ($maskDynamic): ?> x-mask:dynamic="<?php echo e($maskDynamic); ?>" <?php elseif($mask): ?> x-mask="<?php echo e($mask); ?>" <?php endif; ?>
                <?php if (is_numeric($size)): ?> size="<?php echo e($size); ?>" <?php endif; ?>
                [STARTCOMPILEDUNBLAZE:IsyRhC0zYz]<?php \Livewire\Blaze\Unblaze::storeScope("IsyRhC0zYz", scope: ['name' => $name ?? null, 'invalid' => $invalid ?? false]) ?><?php \Livewire\Blaze\Unblaze::storeReplacement("IsyRhC0zYz", "CiAgICAgICAgICAgICAgICA8P3BocCBpZiAoJHNjb3BlWydpbnZhbGlkJ10gfHwgKCRzY29wZVsnbmFtZSddICYmICRlcnJvcnMtPmhhcygkc2NvcGVbJ25hbWUnXSkpKTogPz4KICAgICAgICAgICAgICAgIGFyaWEtaW52YWxpZD0idHJ1ZSIgZGF0YS1pbnZhbGlkCiAgICAgICAgICAgICAgICA8P3BocCBlbmRpZjsgPz4KICAgICAgICAgICAgICAgIA==") ?>[ENDCOMPILEDUNBLAZE:IsyRhC0zYz]
                data-flux-control
                data-flux-group-target
                <?php if($loading): ?> wire:loading.class="<?php echo e($inputLoadingClasses); ?>" <?php endif; ?>
                <?php if($loading && $wireTarget): ?> wire:target="<?php echo e($wireTarget); ?>" <?php endif; ?>
            >

            <?php if ($loading || $countOfTrailingIcons > 0): ?>
                <div class="absolute top-0 bottom-0 flex items-center gap-x-1.5 pe-2 border-e border-transparent end-0 text-xs text-zinc-400">
                    
                    <?php if ($loading): ?>
                        <?php if (!function_exists('__3398e70f820e2fe274a1d1aaa7c5636c')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'); require $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'; } ?>
<?php $__blaze->pushData(['name' => 'loading','variant' => $iconVariant,'class' => $iconClasses,'wire:loading' => true,'wire:target' => $wireTarget]); ?>
<?php __3398e70f820e2fe274a1d1aaa7c5636c($__blaze, ['name' => 'loading','variant' => $iconVariant,'class' => $iconClasses,'wire:loading' => true,'wire:target' => $wireTarget], [], ['variant', 'class', 'wire:loading', 'wire:target'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php endif; ?>

                    <?php if ($clearable): ?>
                        <?php if (!function_exists('__4cb2cb6f7e017b55c92b692d9880839e')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/input/clearable.blade.php', $__blaze->compiledPath.'/4cb2cb6f7e017b55c92b692d9880839e.php'); require $__blaze->compiledPath.'/4cb2cb6f7e017b55c92b692d9880839e.php'; } ?>
<?php $__blaze->pushData(['inset' => 'left right','size' => $size,'iconVariant' => $iconVariant]); ?>
<?php __4cb2cb6f7e017b55c92b692d9880839e($__blaze, ['inset' => 'left right','size' => $size,'iconVariant' => $iconVariant], [], ['size', 'iconVariant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php endif; ?>

                    <?php if ($kbd): ?>
                        <span class="pointer-events-none last:pe-2"><?php echo e($kbd); ?></span>
                    <?php endif; ?>

                    <?php if ($expandable): ?>
                        <?php if (!function_exists('__9abc2758a520257442aa9ab79b27923e')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/input/expandable.blade.php', $__blaze->compiledPath.'/9abc2758a520257442aa9ab79b27923e.php'); require $__blaze->compiledPath.'/9abc2758a520257442aa9ab79b27923e.php'; } ?>
<?php $__blaze->pushData(['inset' => 'left right','size' => $size,'iconVariant' => $iconVariant]); ?>
<?php __9abc2758a520257442aa9ab79b27923e($__blaze, ['inset' => 'left right','size' => $size,'iconVariant' => $iconVariant], [], ['size', 'iconVariant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php endif; ?>

                    <?php if ($copyable): ?>
                        <?php if (!function_exists('__708d2457b8c2949dc815098322dbc039')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/input/copyable.blade.php', $__blaze->compiledPath.'/708d2457b8c2949dc815098322dbc039.php'); require $__blaze->compiledPath.'/708d2457b8c2949dc815098322dbc039.php'; } ?>
<?php $__blaze->pushData(['inset' => 'left right','size' => $size,'iconVariant' => $iconVariant]); ?>
<?php __708d2457b8c2949dc815098322dbc039($__blaze, ['inset' => 'left right','size' => $size,'iconVariant' => $iconVariant], [], ['size', 'iconVariant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php endif; ?>

                    <?php if ($viewable): ?>
                        <?php if (!function_exists('__98cde5ba0c3e8f95dd6f9e69e9b02eb0')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/input/viewable.blade.php', $__blaze->compiledPath.'/98cde5ba0c3e8f95dd6f9e69e9b02eb0.php'); require $__blaze->compiledPath.'/98cde5ba0c3e8f95dd6f9e69e9b02eb0.php'; } ?>
<?php $__blaze->pushData(['inset' => 'left right','size' => $size,'iconVariant' => $iconVariant]); ?>
<?php __98cde5ba0c3e8f95dd6f9e69e9b02eb0($__blaze, ['inset' => 'left right','size' => $size,'iconVariant' => $iconVariant], [], ['size', 'iconVariant'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php endif; ?>

                    <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
                        <?php
                            $trailingIconClasses = clone $iconClasses;
                            $trailingIconClasses->add('text-zinc-400/75 dark:text-white/60 pointer-events-none');
                        ?>
                        <?php if (!function_exists('__3398e70f820e2fe274a1d1aaa7c5636c')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'); require $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'; } ?>
<?php $__blaze->pushData(['icon' => $iconTrailing,'variant' => $iconVariant,'class' => $trailingIconClasses]); ?>
<?php __3398e70f820e2fe274a1d1aaa7c5636c($__blaze, ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => $trailingIconClasses], [], ['icon', 'variant', 'class'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
                    <?php elseif ($iconTrailing): ?>
                        <?php echo e($iconTrailing); ?>

                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php $__slots7264bcdd308cee3a8f7c5b749917a400['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots7264bcdd308cee3a8f7c5b749917a400); ?>
<?php __7264bcdd308cee3a8f7c5b749917a400($__blaze, $__attrs7264bcdd308cee3a8f7c5b749917a400, $__slots7264bcdd308cee3a8f7c5b749917a400, ['attributes', 'name'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack7264bcdd308cee3a8f7c5b749917a400)) { $__slots7264bcdd308cee3a8f7c5b749917a400 = array_pop($__slotsStack7264bcdd308cee3a8f7c5b749917a400); } ?>
<?php if (! empty($__attrsStack7264bcdd308cee3a8f7c5b749917a400)) { $__attrs7264bcdd308cee3a8f7c5b749917a400 = array_pop($__attrsStack7264bcdd308cee3a8f7c5b749917a400); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <button <?php echo e($attributes->merge(['type' => 'button'])->class([$classes, 'w-full relative flex'])); ?>>
        <?php if (is_string($iconLeading) && $iconLeading !== ''): ?>
            <div class="absolute top-0 bottom-0 flex items-center justify-center text-xs text-zinc-400/75 ps-3 start-0">
                <?php if (!function_exists('__3398e70f820e2fe274a1d1aaa7c5636c')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'); require $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'; } ?>
<?php $__blaze->pushData(['icon' => $iconLeading,'variant' => $iconVariant,'class' => $iconClasses]); ?>
<?php __3398e70f820e2fe274a1d1aaa7c5636c($__blaze, ['icon' => $iconLeading,'variant' => $iconVariant,'class' => $iconClasses], [], ['icon', 'variant', 'class'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
            </div>
        <?php elseif ($iconLeading): ?>
            <div <?php echo e($iconLeading->attributes->class('absolute top-0 bottom-0 flex items-center justify-center text-xs text-zinc-400/75 ps-3 start-0')); ?>>
                <?php echo e($iconLeading); ?>

            </div>
        <?php endif; ?>

        <?php if ($attributes->has('placeholder')): ?>
            <div class="block self-center text-start flex-1 font-medium text-zinc-400 dark:text-white/40">
                <?php echo e($attributes->get('placeholder')); ?>

            </div>
        <?php else: ?>
            <div class="text-start self-center flex-1 font-medium text-zinc-800 dark:text-white">
                <?php echo e($slot); ?>

            </div>
        <?php endif; ?>

        <?php if ($kbd): ?>
            <div class="absolute top-0 bottom-0 flex items-center justify-center text-xs text-zinc-400/75 pe-4 end-0">
                <?php echo e($kbd); ?>

            </div>
        <?php endif; ?>

        <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
            <div class="absolute top-0 bottom-0 flex items-center justify-center text-xs text-zinc-400/75 pe-3 end-0">
                <?php if (!function_exists('__3398e70f820e2fe274a1d1aaa7c5636c')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'); require $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'; } ?>
<?php $__blaze->pushData(['icon' => $iconTrailing,'variant' => $iconVariant,'class' => $iconClasses]); ?>
<?php __3398e70f820e2fe274a1d1aaa7c5636c($__blaze, ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => $iconClasses], [], ['icon', 'variant', 'class'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
            </div>
        <?php elseif  ($iconTrailing): ?>
            <div <?php echo e($iconTrailing->attributes->class('absolute top-0 bottom-0 flex items-center justify-center text-xs text-zinc-400/75 pe-2 end-0')); ?>>
                <?php echo e($iconTrailing); ?>

            </div>
        <?php endif; ?>
    </button>
<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/input/index.blade.php ENDPATH**/ ?>