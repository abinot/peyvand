<?php
if (!function_exists('__bf4c35ace2a8590b61b8fe4c8a388342')):
function __bf4c35ace2a8590b61b8fe4c8a388342($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
<?php $iconVariant ??= $attributes->pluck('icon:variant'); ?>

<?php
$__defaults = [
    'iconTrailing' => null,
    'iconVariant' => 'mini',
    'variant' => 'default',
    'suffix' => null,
    'value' => null,
    'icon' => null,
    'kbd' => null,
];
$iconTrailing ??= $attributes['icon-trailing'] ?? $attributes['iconTrailing'] ?? $__defaults['iconTrailing']; unset($attributes['iconTrailing'], $attributes['icon-trailing']);
$iconVariant ??= $attributes['icon-variant'] ?? $attributes['iconVariant'] ?? $__defaults['iconVariant']; unset($attributes['iconVariant'], $attributes['icon-variant']);
$variant ??= $attributes['variant'] ?? $__defaults['variant']; unset($attributes['variant']);
$suffix ??= $attributes['suffix'] ?? $__defaults['suffix']; unset($attributes['suffix']);
$value ??= $attributes['value'] ?? $__defaults['value']; unset($attributes['value']);
$icon ??= $attributes['icon'] ?? $__defaults['icon']; unset($attributes['icon']);
$kbd ??= $attributes['kbd'] ?? $__defaults['kbd']; unset($attributes['kbd']);
unset($__defaults);
?>

<?php
if ($kbd) $suffix = $kbd;

$iconClasses = Flux::classes()
    ->add('me-2')
    // When using the outline icon variant, we need to size it down to match the default icon sizes...
    ->add($iconVariant === 'outline' ? 'size-5' : null)
    ;

$trailingIconClasses = Flux::classes()
    ->add('ms-auto text-zinc-400 [[data-flux-menu-item-icon]:hover_&]:text-current')
    // When using the outline icon variant, we need to size it down to match the default icon sizes...
    ->add($iconVariant === 'outline' ? 'size-5' : null)
    ;

$classes = Flux::classes()
    ->add('flex items-center px-2 py-1.5 w-full focus:outline-hidden select-none')
    ->add('rounded-md')
    ->add('text-start text-sm font-medium')
    ->add('[&[disabled]]:opacity-50')
    ->add(match ($variant) {
        'danger' => [
            'text-zinc-800 data-active:text-red-600 data-active:bg-red-50 dark:text-white dark:data-active:bg-red-400/20 dark:data-active:text-red-400',
            '**:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&[data-active]_[data-flux-menu-item-icon]]:text-current',
        ],
        'default' => [
            'text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600',
            '**:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&[data-active]_[data-flux-menu-item-icon]]:text-current',
        ]
    })
    ;

$suffixClasses = Flux::classes()
    ->add('ms-auto text-xs text-zinc-400')
    ;
?>

<?php if (!function_exists('__8732dc76dd501fd27112457dabf83403')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/button-or-link-pure.blade.php', $__blaze->compiledPath.'/8732dc76dd501fd27112457dabf83403.php'); require $__blaze->compiledPath.'/8732dc76dd501fd27112457dabf83403.php'; } ?>
<?php if (isset($__slots8732dc76dd501fd27112457dabf83403)) { $__slotsStack8732dc76dd501fd27112457dabf83403[] = $__slots8732dc76dd501fd27112457dabf83403; } ?>
<?php if (isset($__attrs8732dc76dd501fd27112457dabf83403)) { $__attrsStack8732dc76dd501fd27112457dabf83403[] = $__attrs8732dc76dd501fd27112457dabf83403; } ?>
<?php $__attrs8732dc76dd501fd27112457dabf83403 = ['attributes' => $attributes->class($classes),'dataFluxMenuItem' => true,'dataFluxMenuItemHasIcon' => !! $icon]; ?>
<?php $__slots8732dc76dd501fd27112457dabf83403 = []; ?>
<?php $__blaze->pushData($__attrs8732dc76dd501fd27112457dabf83403); ?>
<?php ob_start(); ?>
    <?php if (is_string($icon) && $icon !== ''): ?>
        <?php if (!function_exists('__3398e70f820e2fe274a1d1aaa7c5636c')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'); require $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'; } ?>
<?php $__blaze->pushData(['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses,'dataFluxMenuItemIcon' => true]); ?>
<?php __3398e70f820e2fe274a1d1aaa7c5636c($__blaze, ['icon' => $icon,'variant' => $iconVariant,'class' => $iconClasses,'dataFluxMenuItemIcon' => true], [], ['icon', 'variant', 'class', 'dataFluxMenuItemIcon'], ['dataFluxMenuItemIcon' => 'data-flux-menu-item-icon'], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
    <?php elseif ($icon): ?>
        <?php echo e($icon); ?>

    <?php else: ?>
        <div class="w-7 hidden [[data-flux-menu]:has(>[data-flux-menu-item-has-icon])_&]:block"></div>
    <?php endif; ?>

    <?php echo e($slot); ?>


    <?php if (is_string($suffix) && $suffix !== ''): ?>
        <div class="<?php echo e($suffixClasses); ?>">
            <?php echo e($suffix); ?>

        </div>
    <?php elseif ($suffix): ?>
        <?php echo e($suffix); ?>

    <?php endif; ?>

    <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
        <?php if (!function_exists('__3398e70f820e2fe274a1d1aaa7c5636c')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php', $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'); require $__blaze->compiledPath.'/3398e70f820e2fe274a1d1aaa7c5636c.php'; } ?>
<?php $__blaze->pushData(['icon' => $iconTrailing,'variant' => $iconVariant,'class' => $trailingIconClasses,'dataFluxMenuItemIcon' => true]); ?>
<?php __3398e70f820e2fe274a1d1aaa7c5636c($__blaze, ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => $trailingIconClasses,'dataFluxMenuItemIcon' => true], [], ['icon', 'variant', 'class', 'dataFluxMenuItemIcon'], ['dataFluxMenuItemIcon' => 'data-flux-menu-item-icon'], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
    <?php elseif ($iconTrailing): ?>
        <?php echo e($iconTrailing); ?>

    <?php endif; ?>

    <?php echo e($submenu ?? ''); ?>

<?php $__slots8732dc76dd501fd27112457dabf83403['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots8732dc76dd501fd27112457dabf83403); ?>
<?php __8732dc76dd501fd27112457dabf83403($__blaze, $__attrs8732dc76dd501fd27112457dabf83403, $__slots8732dc76dd501fd27112457dabf83403, ['attributes', 'dataFluxMenuItem', 'dataFluxMenuItemHasIcon'], ['dataFluxMenuItem' => 'data-flux-menu-item', 'dataFluxMenuItemHasIcon' => 'data-flux-menu-item-has-icon'], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack8732dc76dd501fd27112457dabf83403)) { $__slots8732dc76dd501fd27112457dabf83403 = array_pop($__slotsStack8732dc76dd501fd27112457dabf83403); } ?>
<?php if (! empty($__attrsStack8732dc76dd501fd27112457dabf83403)) { $__attrs8732dc76dd501fd27112457dabf83403 = array_pop($__attrsStack8732dc76dd501fd27112457dabf83403); } ?>
<?php $__blaze->popData(); ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/item.blade.php ENDPATH**/ ?>