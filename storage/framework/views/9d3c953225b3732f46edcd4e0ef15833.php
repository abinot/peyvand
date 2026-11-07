<?php
if (!function_exists('_9d3c953225b3732f46edcd4e0ef15833')):
function _9d3c953225b3732f46edcd4e0ef15833($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
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
    'paginate' => null,
    'bleed' => false,
];
$paginate ??= $attributes['paginate'] ?? $__defaults['paginate']; unset($attributes['paginate']);
$bleed ??= $attributes['bleed'] ?? $__defaults['bleed']; unset($attributes['bleed']);
unset($__defaults);
?>

<?php
$classes = Flux::classes()
    ->add('[:where(&)]:min-w-full table-fixed border-separate border-spacing-0 isolate')
    ->add('text-zinc-800')
    // We want whitespace-nowrap for the table, but not for modals and dropdowns...
    ->add('whitespace-nowrap [&_dialog]:whitespace-normal [&_[popover]]:whitespace-normal')
    ->add($bleed ? [
        '[&_[data-flux-column]:first-child]:ps-[var(--flux-bleed,1.5rem)]',
        '[&_[data-flux-cell]:first-child]:ps-[var(--flux-bleed,1.5rem)]',
        '[&_[data-flux-column]:last-child]:pe-[var(--flux-bleed,1.5rem)]',
        '[&_[data-flux-cell]:last-child]:pe-[var(--flux-bleed,1.5rem)]',
    ] : '')
    ;

$containerClasses = Flux::classes()
    ->add('flex flex-col')
    ->add($bleed ? '-mx-[var(--flux-bleed,1.5rem)]' : '')
    ->add($attributes->pluck('container:class'))
    ;
?>

<div class="<?php echo e($containerClasses); ?>" <?php if($bleed): ?> data-flux-table-bleed <?php endif; ?>>
    <?php echo e($header ?? ''); ?>


    <ui-table-scroll-area class="overflow-auto">
        <table <?php echo e($attributes->class($classes)); ?> data-flux-table>
            <?php echo e($slot); ?>

        </table>
    </ui-table-scroll-area>

    <?php echo e($footer ?? ''); ?>


    <?php if ($paginate): ?>
        <?php $paginationAttributes = Flux::attributesAfter('pagination:', $attributes, [
            'paginator' => $paginate,
            'class' => Flux::classes()
                ->add('shrink-0')
                ->add($bleed ? 'px-[var(--flux-bleed,1.5rem)]' : ''),
        ]); ?>
        <?php if (!function_exists('_c199d90d5652335adb813ea87aa7c166')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/pagination.blade.php', $__blaze->compiledPath.'/c199d90d5652335adb813ea87aa7c166.php'); require $__blaze->compiledPath.'/c199d90d5652335adb813ea87aa7c166.php'; } ?>
<?php $__blaze->pushData(['attributes' => $paginationAttributes]); ?>
<?php _c199d90d5652335adb813ea87aa7c166($__blaze, ['attributes' => $paginationAttributes], [], ['attributes'], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
    <?php endif; ?>
</div>
<?php
echo ltrim(ob_get_clean());
} endif; ?><?php /**PATH /home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/table/index.blade.php ENDPATH**/ ?>