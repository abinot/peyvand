<?php
if (!function_exists('__eb4710937e3ca9686b1b14a6ac89991c')):
function __eb4710937e3ca9686b1b14a6ac89991c($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;
$__slots['slot'] ??= new \Illuminate\View\ComponentSlot('');
if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<?php
$__defaults = [
    'interactive' => null,
    'position' => 'top',
    'align' => 'center',
    'content' => null,
    'kbd' => null,
    'toggleable' => null,
];
$interactive ??= $attributes['interactive'] ?? $__defaults['interactive']; unset($attributes['interactive']);
$position ??= $attributes['position'] ?? $__defaults['position']; unset($attributes['position']);
$align ??= $attributes['align'] ?? $__defaults['align']; unset($attributes['align']);
$content ??= $attributes['content'] ?? $__defaults['content']; unset($attributes['content']);
$kbd ??= $attributes['kbd'] ?? $__defaults['kbd']; unset($attributes['kbd']);
$toggleable ??= $attributes['toggleable'] ?? $__defaults['toggleable']; unset($attributes['toggleable']);
unset($__defaults);
?>

<?php
// Support adding the .self modifier to the wire:model directive...
if (($wireModel = $attributes->wire('model')) && $wireModel->directive && ! $wireModel->hasModifier('self')) {
    unset($attributes[$wireModel->directive]);

    $wireModel->directive .= '.self';

    $attributes = $attributes->merge([$wireModel->directive => $wireModel->value]);
}
?>

<?php if ($toggleable): ?>
    <ui-dropdown position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php if (!function_exists('__f7e2ebc4faa3a0e0085fc99fd96db4fd')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/f7e2ebc4faa3a0e0085fc99fd96db4fd.php'); require $__blaze->compiledPath.'/f7e2ebc4faa3a0e0085fc99fd96db4fd.php'; } ?>
<?php if (isset($__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd)) { $__slotsStackf7e2ebc4faa3a0e0085fc99fd96db4fd[] = $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd; } ?>
<?php if (isset($__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd)) { $__attrsStackf7e2ebc4faa3a0e0085fc99fd96db4fd[] = $__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd; } ?>
<?php $__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd = ['kbd' => $kbd]; ?>
<?php $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd = []; ?>
<?php $__blaze->pushData($__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd); ?>
<?php __f7e2ebc4faa3a0e0085fc99fd96db4fd($__blaze, $__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd, $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackf7e2ebc4faa3a0e0085fc99fd96db4fd)) { $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd = array_pop($__slotsStackf7e2ebc4faa3a0e0085fc99fd96db4fd); } ?>
<?php if (! empty($__attrsStackf7e2ebc4faa3a0e0085fc99fd96db4fd)) { $__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd = array_pop($__attrsStackf7e2ebc4faa3a0e0085fc99fd96db4fd); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-dropdown>
<?php else: ?>
    <ui-tooltip position="<?php echo e($position); ?> <?php echo e($align); ?>" <?php echo e($attributes); ?> data-flux-tooltip <?php if($interactive): ?> interactive <?php endif; ?>>
        <?php echo e($slot); ?>


        <?php if ($content !== null): ?>
            <?php if (!function_exists('__f7e2ebc4faa3a0e0085fc99fd96db4fd')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/content.blade.php', $__blaze->compiledPath.'/f7e2ebc4faa3a0e0085fc99fd96db4fd.php'); require $__blaze->compiledPath.'/f7e2ebc4faa3a0e0085fc99fd96db4fd.php'; } ?>
<?php if (isset($__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd)) { $__slotsStackf7e2ebc4faa3a0e0085fc99fd96db4fd[] = $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd; } ?>
<?php if (isset($__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd)) { $__attrsStackf7e2ebc4faa3a0e0085fc99fd96db4fd[] = $__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd; } ?>
<?php $__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd = ['kbd' => $kbd]; ?>
<?php $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd = []; ?>
<?php $__blaze->pushData($__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd); ?>
<?php ob_start(); ?><?php echo e($content); ?><?php $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd); ?>
<?php __f7e2ebc4faa3a0e0085fc99fd96db4fd($__blaze, $__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd, $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd, ['kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackf7e2ebc4faa3a0e0085fc99fd96db4fd)) { $__slotsf7e2ebc4faa3a0e0085fc99fd96db4fd = array_pop($__slotsStackf7e2ebc4faa3a0e0085fc99fd96db4fd); } ?>
<?php if (! empty($__attrsStackf7e2ebc4faa3a0e0085fc99fd96db4fd)) { $__attrsf7e2ebc4faa3a0e0085fc99fd96db4fd = array_pop($__attrsStackf7e2ebc4faa3a0e0085fc99fd96db4fd); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    </ui-tooltip>
<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/index.blade.php ENDPATH**/ ?>