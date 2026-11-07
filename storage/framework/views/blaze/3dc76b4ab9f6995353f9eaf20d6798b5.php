<?php
if (!function_exists('__3dc76b4ab9f6995353f9eaf20d6798b5')):
function __3dc76b4ab9f6995353f9eaf20d6798b5($__blaze, $__data = [], $__slots = [], $__bound = [], $__keys = [], $__this = null) {
$__env = $__blaze->env;

if (($__data['attributes'] ?? null) instanceof \Illuminate\View\ComponentAttributeBag) { $__data = $__data + $__data['attributes']->all(); unset($__data['attributes']); }
extract($__slots, EXTR_SKIP); unset($__slots);
extract($__data, EXTR_SKIP);
$attributes = \Livewire\Blaze\Runtime\BlazeAttributeBag::make($__data, $__bound, $__keys);
unset($__data, $__bound, $__keys);
ob_start();
?>


<div class="-mx-[.3125rem] my-[.3125rem] h-px" <?php echo e($attributes); ?> data-flux-menu-separator>
    <?php if (!function_exists('__4ae44561174fc1434411bd982412e83d')) { $__blaze->compile('/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/separator.blade.php', $__blaze->compiledPath.'/4ae44561174fc1434411bd982412e83d.php'); require $__blaze->compiledPath.'/4ae44561174fc1434411bd982412e83d.php'; } ?>
<?php $__blaze->pushData(['class' => 'dark:bg-zinc-600!']); ?>
<?php __4ae44561174fc1434411bd982412e83d($__blaze, ['class' => 'dark:bg-zinc-600!'], [], [], [], $__this ?? (isset($this) ? $this : null)); ?>
<?php $__blaze->popData(); ?>
</div>
<?php
echo $__blaze->processPassthroughContent('ltrim', ltrim(ob_get_clean()));
} endif; ?><?php /**PATH /home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/separator.blade.php ENDPATH**/ ?>