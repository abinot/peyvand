<?php
if (!function_exists('__40395aa7e0a6075aae41a792dfcea7b0')):
function __40395aa7e0a6075aae41a792dfcea7b0($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'value' => null,
];
$value ??= $attributes['value'] ?? $__defaults['value']; unset($attributes['value']);
unset($__defaults);
?>

<option
    <?php echo e($attributes); ?>

    <?php if(isset($value)): ?> value="<?php echo e($value); ?>" <?php endif; ?>
    <?php if(isset($value)): ?> wire:key="<?php echo e($value); ?>" <?php endif; ?>
><?php echo e($slot); ?></option><?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/select/option/variants/default.blade.php ENDPATH**/ ?>