<?php
if (!function_exists('_a3e2e86e9666a3148c2adc9b243af0ec')):
function _a3e2e86e9666a3148c2adc9b243af0ec($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
extract(Flux::forwardedAttributes($attributes, [
    'tooltipPosition',
    'tooltipKbd',
    'tooltip',
]));
?>

<?php $tooltipPosition = $tooltipPosition ??= $attributes->pluck('tooltip:position'); ?>
<?php $tooltipKbd = $tooltipKbd ??= $attributes->pluck('tooltip:kbd'); ?>
<?php $tooltip = $tooltip ??= $attributes->pluck('tooltip'); ?>

<?php
$__defaults = [
    'tooltipPosition' => 'top',
    'tooltipKbd' => null,
    'tooltip' => null,
];
$tooltipPosition ??= $attributes['tooltip-position'] ?? $attributes['tooltipPosition'] ?? $__defaults['tooltipPosition']; unset($attributes['tooltipPosition'], $attributes['tooltip-position']);
$tooltipKbd ??= $attributes['tooltip-kbd'] ?? $attributes['tooltipKbd'] ?? $__defaults['tooltipKbd']; unset($attributes['tooltipKbd'], $attributes['tooltip-kbd']);
$tooltip ??= $attributes['tooltip'] ?? $__defaults['tooltip']; unset($attributes['tooltip']);
unset($__defaults);
?>

<?php if ($tooltip): ?>
    <?php if (!function_exists('_eb4710937e3ca9686b1b14a6ac89991c')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/tooltip/index.blade.php', $__blaze->compiledPath.'/eb4710937e3ca9686b1b14a6ac89991c.php'); require $__blaze->compiledPath.'/eb4710937e3ca9686b1b14a6ac89991c.php'; } ?>
<?php if (isset($__slotseb4710937e3ca9686b1b14a6ac89991c)) { $__slotsStackeb4710937e3ca9686b1b14a6ac89991c[] = $__slotseb4710937e3ca9686b1b14a6ac89991c; } ?>
<?php if (isset($__attrseb4710937e3ca9686b1b14a6ac89991c)) { $__attrsStackeb4710937e3ca9686b1b14a6ac89991c[] = $__attrseb4710937e3ca9686b1b14a6ac89991c; } ?>
<?php $__attrseb4710937e3ca9686b1b14a6ac89991c = ['class' => 'inline-flex','content' => $tooltip,'position' => $tooltipPosition,'kbd' => $tooltipKbd]; ?>
<?php $__slotseb4710937e3ca9686b1b14a6ac89991c = []; ?>
<?php $__blaze->pushData($__attrseb4710937e3ca9686b1b14a6ac89991c); ?>
<?php ob_start(); ?>
        <?php echo e($slot); ?>

    <?php $__slotseb4710937e3ca9686b1b14a6ac89991c['slot'] = new \Illuminate\View\ComponentSlot(trim(ob_get_clean()), []); ?>
<?php $__blaze->pushSlots($__slotseb4710937e3ca9686b1b14a6ac89991c); ?>
<?php _eb4710937e3ca9686b1b14a6ac89991c($__blaze, $__attrseb4710937e3ca9686b1b14a6ac89991c, $__slotseb4710937e3ca9686b1b14a6ac89991c, ['content', 'position', 'kbd'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackeb4710937e3ca9686b1b14a6ac89991c)) { $__slotseb4710937e3ca9686b1b14a6ac89991c = array_pop($__slotsStackeb4710937e3ca9686b1b14a6ac89991c); } ?>
<?php if (! empty($__attrsStackeb4710937e3ca9686b1b14a6ac89991c)) { $__attrseb4710937e3ca9686b1b14a6ac89991c = array_pop($__attrsStackeb4710937e3ca9686b1b14a6ac89991c); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH /home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/with-tooltip.blade.php ENDPATH**/ ?>