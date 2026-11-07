<?php # [BlazeFolded]:{flux::icon}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::icon}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::button}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/button/index.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::menu.heading}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/heading.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::icon}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/icon/index.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::menu.item}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/item.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::menu.separator}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/separator.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::menu.item}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/item.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::modal.trigger}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/modal/trigger.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::menu}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/menu/index.blade.php}:{1790619292} ?>
<?php # [BlazeFolded]:{flux::dropdown}:{/home/ab/Desktop/Abinot/peyvand/vendor/livewire/flux/src/../stubs/resources/views/flux/dropdown.blade.php}:{1790619292} ?>
<?php
use App\Data\UserTeam;
use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
?>

<div>
    <?php ob_start(); ?><ui-dropdown position="bottom start"  data-flux-dropdown>
    <?php ob_start(); ?>
        <?php ob_start(); ?><button type="button" class="relative items-center font-medium justify-center whitespace-nowrap disabled:opacity-50 dark:disabled:opacity-50 disabled:cursor-default disabled:pointer-events-none disabled:shadow-none justify-center h-10 text-sm rounded-lg gap-2 ps-4 pe-4 inline-flex  bg-transparent hover:bg-zinc-800/5 dark:hover:bg-white/15 text-zinc-800 dark:text-white       group w-full justify-start in-data-flux-sidebar-collapsed-desktop:justify-center" data-flux-button="data-flux-button" data-test="team-switcher-trigger">
        <?php ob_start(); ?>
            <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 hidden size-4 in-data-flux-sidebar-collapsed-desktop:block" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
            <span class="truncate font-semibold in-data-flux-sidebar-collapsed-desktop:hidden"><?php echo e($this->currentTeam()['name'] ?? __('Select team')); ?></span>
            <?php ob_start(); ?><svg
    class="shrink-0 [:where(&amp;)]:size-4 ms-auto size-4 in-data-flux-sidebar-collapsed-desktop:hidden"
    data-flux-icon
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    fill="none"
    stroke="currentColor"
    stroke-width="2.5"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
    data-slot="icon"
>
    <path d="m7 15 5 5 5-5" />
    <path d="m7 9 5-5 5 5" />
</svg>
<?php echo ltrim(ob_get_clean()); ?>
        <?php echo trim(ob_get_clean()); ?>

    </button>
<?php echo ltrim(ob_get_clean()); ?>

        <?php ob_start(); ?><ui-menu
    class="[:where(&amp;)]:min-w-48 p-[.3125rem] rounded-lg shadow-xs border border-zinc-200 dark:border-zinc-600 bg-white dark:bg-zinc-700 focus:outline-hidden min-w-56"
    popover="manual"
    data-flux-menu
>
    <?php ob_start(); ?>
            <?php ob_start(); ?><div class="p-2 pb-1 w-full flex items-center text-start text-xs font-medium text-zinc-500 font-medium dark:text-zinc-300" data-flux-menu-heading>
    <div class="w-7 hidden [[data-flux-menu]:has(>[data-flux-menu-item-has-icon])_&]:block"></div>

    <div><?php ob_start(); ?><?php echo e(__('Teams')); ?><?php echo trim(ob_get_clean()); ?></div>
</div>
<?php echo ltrim(ob_get_clean()); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $this->teams(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php ob_start(); ?><button type="button" class="flex items-center px-2 py-1.5 w-full focus:outline-hidden select-none rounded-md text-start text-sm font-medium [&amp;[disabled]]:opacity-50 text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 **:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&amp;[data-active]_[data-flux-menu-item-icon]]:text-current cursor-pointer" data-flux-menu-item="data-flux-menu-item" wire:click="switchTeam('<?php echo e($team->slug); ?>')" data-test="team-switcher-item">
        <div class="w-7 hidden [[data-flux-menu]:has(>[data-flux-menu-item-has-icon])_&]:block"></div>
    
    <?php ob_start(); ?>
                    <div class="flex w-full items-center justify-between">
                        <span><?php echo e($team->name); ?></span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($team->isCurrent): ?>
                            <?php ob_start(); ?><svg class="shrink-0 [:where(&amp;)]:size-6 size-4" data-flux-icon xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
</svg>

        <?php echo ltrim(ob_get_clean()); ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php echo trim(ob_get_clean()); ?>

    </button>
<?php echo ltrim(ob_get_clean()); ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <?php ob_start(); ?><div class="-mx-[.3125rem] my-[.3125rem] h-px"  data-flux-menu-separator>
    <div data-orientation="horizontal" role="none" class="border-0 [print-color-adjust:exact] bg-zinc-800/15 dark:bg-white/20 h-px w-full dark:bg-zinc-600!" data-flux-separator></div>
</div>
<?php echo ltrim(ob_get_clean()); ?>

            <?php ob_start(); ?><div
    class="contents"
    x-data
    x-on:click="$el.querySelector('button[disabled]') || $dispatch('modal-show', { name: 'create-team-switcher' })"
        data-flux-modal-trigger
>
    <?php ob_start(); ?>
                <?php ob_start(); ?><button type="button" class="flex items-center px-2 py-1.5 w-full focus:outline-hidden select-none rounded-md text-start text-sm font-medium [&amp;[disabled]]:opacity-50 text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 **:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&amp;[data-active]_[data-flux-menu-item-icon]]:text-current cursor-pointer" data-flux-menu-item="data-flux-menu-item" data-flux-menu-item-has-icon="data-flux-menu-item-has-icon" data-test="team-switcher-new-team">
        <svg class="shrink-0 [:where(&amp;)]:size-5 me-2" data-flux-menu-item-icon="data-flux-menu-item-icon" data-flux-icon xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
  <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"/>
</svg>

            
    <?php ob_start(); ?>
                    <?php echo e(__('New team')); ?>

                <?php echo trim(ob_get_clean()); ?>

    </button>
<?php echo ltrim(ob_get_clean()); ?>
            <?php echo trim(ob_get_clean()); ?>

</div>
<?php echo ltrim(ob_get_clean()); ?>
        <?php echo trim(ob_get_clean()); ?>

</ui-menu>
<?php echo ltrim(ob_get_clean()); ?>
    <?php echo trim(ob_get_clean()); ?>

</ui-dropdown>
<?php echo ltrim(ob_get_clean()); ?>
</div><?php /**PATH /home/ab/Desktop/Abinot/peyvand/storage/framework/views/livewire/views/08ba276b.blade.php ENDPATH**/ ?>