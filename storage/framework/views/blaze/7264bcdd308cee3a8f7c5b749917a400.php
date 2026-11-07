<?php
if (!function_exists('__7264bcdd308cee3a8f7c5b749917a400')):
function __7264bcdd308cee3a8f7c5b749917a400($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'name',
    'descriptionTrailing',
    'description',
    'label',
    'badge',
]));
?>

<?php $descriptionTrailing = $descriptionTrailing ??= $attributes->pluck('description:trailing'); ?>

<?php
$__defaults = [
    'name' => $attributes->whereStartsWith('wire:model')->first(),
    'descriptionTrailing' => null,
    'description' => null,
    'label' => null,
    'badge' => null,
];
$name ??= $attributes['name'] ?? $__defaults['name']; unset($attributes['name']);
$descriptionTrailing ??= $attributes['description-trailing'] ?? $attributes['descriptionTrailing'] ?? $__defaults['descriptionTrailing']; unset($attributes['descriptionTrailing'], $attributes['description-trailing']);
$description ??= $attributes['description'] ?? $__defaults['description']; unset($attributes['description']);
$label ??= $attributes['label'] ?? $__defaults['label']; unset($attributes['label']);
$badge ??= $attributes['badge'] ?? $__defaults['badge']; unset($attributes['badge']);
unset($__defaults);
?>

<?php if (isset($label) || isset($description) || isset($descriptionTrailing)): ?>
    <?php

        $fieldAttributes = Flux::attributesAfter('field:', $attributes, []);
        $labelAttributes = Flux::attributesAfter('label:', $attributes, ['badge' => $badge]);
        $descriptionAttributes = Flux::attributesAfter('description:', $attributes, []);
        $errorAttributes = Flux::attributesAfter('error:', $attributes, ['name' => $name]);
    ?>
    <?php if (!function_exists('__3fa19a2a04063b5fd2f9f3c576ec9f80')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/field.blade.php', $__blaze->compiledPath.'/3fa19a2a04063b5fd2f9f3c576ec9f80.php'); require $__blaze->compiledPath.'/3fa19a2a04063b5fd2f9f3c576ec9f80.php'; } ?>
<?php if (isset($__slots3fa19a2a04063b5fd2f9f3c576ec9f80)) { $__slotsStack3fa19a2a04063b5fd2f9f3c576ec9f80[] = $__slots3fa19a2a04063b5fd2f9f3c576ec9f80; } ?>
<?php if (isset($__attrs3fa19a2a04063b5fd2f9f3c576ec9f80)) { $__attrsStack3fa19a2a04063b5fd2f9f3c576ec9f80[] = $__attrs3fa19a2a04063b5fd2f9f3c576ec9f80; } ?>
<?php $__attrs3fa19a2a04063b5fd2f9f3c576ec9f80 = ['attributes' => $fieldAttributes]; ?>
<?php $__slots3fa19a2a04063b5fd2f9f3c576ec9f80 = []; ?>
<?php $__blaze->pushData($__attrs3fa19a2a04063b5fd2f9f3c576ec9f80); ?>
<?php ob_start(); ?>
        <?php if (isset($label)): ?>
            <?php if (!function_exists('__e37278de39e473a8fac2094954725535')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/label.blade.php', $__blaze->compiledPath.'/e37278de39e473a8fac2094954725535.php'); require $__blaze->compiledPath.'/e37278de39e473a8fac2094954725535.php'; } ?>
<?php if (isset($__slotse37278de39e473a8fac2094954725535)) { $__slotsStacke37278de39e473a8fac2094954725535[] = $__slotse37278de39e473a8fac2094954725535; } ?>
<?php if (isset($__attrse37278de39e473a8fac2094954725535)) { $__attrsStacke37278de39e473a8fac2094954725535[] = $__attrse37278de39e473a8fac2094954725535; } ?>
<?php $__attrse37278de39e473a8fac2094954725535 = ['attributes' => $labelAttributes]; ?>
<?php $__slotse37278de39e473a8fac2094954725535 = []; ?>
<?php $__blaze->pushData($__attrse37278de39e473a8fac2094954725535); ?>
<?php ob_start(); ?><?php echo e($label); ?><?php $__slotse37278de39e473a8fac2094954725535['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotse37278de39e473a8fac2094954725535); ?>
<?php __e37278de39e473a8fac2094954725535($__blaze, $__attrse37278de39e473a8fac2094954725535, $__slotse37278de39e473a8fac2094954725535, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStacke37278de39e473a8fac2094954725535)) { $__slotse37278de39e473a8fac2094954725535 = array_pop($__slotsStacke37278de39e473a8fac2094954725535); } ?>
<?php if (! empty($__attrsStacke37278de39e473a8fac2094954725535)) { $__attrse37278de39e473a8fac2094954725535 = array_pop($__attrsStacke37278de39e473a8fac2094954725535); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php if (isset($description)): ?>
            <?php if (!function_exists('__b681f061a3560bccc9f513be26a13b3b')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/b681f061a3560bccc9f513be26a13b3b.php'); require $__blaze->compiledPath.'/b681f061a3560bccc9f513be26a13b3b.php'; } ?>
<?php if (isset($__slotsb681f061a3560bccc9f513be26a13b3b)) { $__slotsStackb681f061a3560bccc9f513be26a13b3b[] = $__slotsb681f061a3560bccc9f513be26a13b3b; } ?>
<?php if (isset($__attrsb681f061a3560bccc9f513be26a13b3b)) { $__attrsStackb681f061a3560bccc9f513be26a13b3b[] = $__attrsb681f061a3560bccc9f513be26a13b3b; } ?>
<?php $__attrsb681f061a3560bccc9f513be26a13b3b = ['attributes' => $descriptionAttributes]; ?>
<?php $__slotsb681f061a3560bccc9f513be26a13b3b = []; ?>
<?php $__blaze->pushData($__attrsb681f061a3560bccc9f513be26a13b3b); ?>
<?php ob_start(); ?><?php echo e($description); ?><?php $__slotsb681f061a3560bccc9f513be26a13b3b['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsb681f061a3560bccc9f513be26a13b3b); ?>
<?php __b681f061a3560bccc9f513be26a13b3b($__blaze, $__attrsb681f061a3560bccc9f513be26a13b3b, $__slotsb681f061a3560bccc9f513be26a13b3b, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackb681f061a3560bccc9f513be26a13b3b)) { $__slotsb681f061a3560bccc9f513be26a13b3b = array_pop($__slotsStackb681f061a3560bccc9f513be26a13b3b); } ?>
<?php if (! empty($__attrsStackb681f061a3560bccc9f513be26a13b3b)) { $__attrsb681f061a3560bccc9f513be26a13b3b = array_pop($__attrsStackb681f061a3560bccc9f513be26a13b3b); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>

        <?php echo e($slot); ?>


        
        [STARTCOMPILEDUNBLAZE:faRiRWzghh]<?php \Livewire\Blaze\Unblaze::storeScope("faRiRWzghh", scope: ['attributes' => $errorAttributes->getAttributes()]) ?><?php \Livewire\Blaze\Unblaze::storeReplacement("faRiRWzghh", "CiAgICAgICAgPGZsdXg6ZXJyb3IgOmF0dHJpYnV0ZXM9Im5ldyBcSWxsdW1pbmF0ZVxWaWV3XENvbXBvbmVudEF0dHJpYnV0ZUJhZygkc2NvcGVbJ2F0dHJpYnV0ZXMnXSkiIC8+CiAgICAgICAg") ?>[ENDCOMPILEDUNBLAZE:faRiRWzghh]

        <?php if (isset($descriptionTrailing)): ?>
            <?php if (!function_exists('__b681f061a3560bccc9f513be26a13b3b')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/description.blade.php', $__blaze->compiledPath.'/b681f061a3560bccc9f513be26a13b3b.php'); require $__blaze->compiledPath.'/b681f061a3560bccc9f513be26a13b3b.php'; } ?>
<?php if (isset($__slotsb681f061a3560bccc9f513be26a13b3b)) { $__slotsStackb681f061a3560bccc9f513be26a13b3b[] = $__slotsb681f061a3560bccc9f513be26a13b3b; } ?>
<?php if (isset($__attrsb681f061a3560bccc9f513be26a13b3b)) { $__attrsStackb681f061a3560bccc9f513be26a13b3b[] = $__attrsb681f061a3560bccc9f513be26a13b3b; } ?>
<?php $__attrsb681f061a3560bccc9f513be26a13b3b = ['attributes' => $descriptionAttributes]; ?>
<?php $__slotsb681f061a3560bccc9f513be26a13b3b = []; ?>
<?php $__blaze->pushData($__attrsb681f061a3560bccc9f513be26a13b3b); ?>
<?php ob_start(); ?><?php echo e($descriptionTrailing); ?><?php $__slotsb681f061a3560bccc9f513be26a13b3b['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slotsb681f061a3560bccc9f513be26a13b3b); ?>
<?php __b681f061a3560bccc9f513be26a13b3b($__blaze, $__attrsb681f061a3560bccc9f513be26a13b3b, $__slotsb681f061a3560bccc9f513be26a13b3b, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStackb681f061a3560bccc9f513be26a13b3b)) { $__slotsb681f061a3560bccc9f513be26a13b3b = array_pop($__slotsStackb681f061a3560bccc9f513be26a13b3b); } ?>
<?php if (! empty($__attrsStackb681f061a3560bccc9f513be26a13b3b)) { $__attrsb681f061a3560bccc9f513be26a13b3b = array_pop($__attrsStackb681f061a3560bccc9f513be26a13b3b); } ?>
<?php $__blaze->popData(); ?>
        <?php endif; ?>
    <?php $__slots3fa19a2a04063b5fd2f9f3c576ec9f80['slot'] = new \Illuminate\View\ComponentSlot($__blaze->processPassthroughContent('trim', trim(ob_get_clean())), []); ?>
<?php $__blaze->pushSlots($__slots3fa19a2a04063b5fd2f9f3c576ec9f80); ?>
<?php __3fa19a2a04063b5fd2f9f3c576ec9f80($__blaze, $__attrs3fa19a2a04063b5fd2f9f3c576ec9f80, $__slots3fa19a2a04063b5fd2f9f3c576ec9f80, ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php if (! empty($__slotsStack3fa19a2a04063b5fd2f9f3c576ec9f80)) { $__slots3fa19a2a04063b5fd2f9f3c576ec9f80 = array_pop($__slotsStack3fa19a2a04063b5fd2f9f3c576ec9f80); } ?>
<?php if (! empty($__attrsStack3fa19a2a04063b5fd2f9f3c576ec9f80)) { $__attrs3fa19a2a04063b5fd2f9f3c576ec9f80 = array_pop($__attrsStack3fa19a2a04063b5fd2f9f3c576ec9f80); } ?>
<?php $__blaze->popData(); ?>
<?php else: ?>
    <?php echo e($slot); ?>

<?php endif; ?>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/with-field.blade.php ENDPATH**/ ?>