<div class="bg-surface-container-lowest p-md rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase"><?= esc($title ?? 'Metric') ?></p>
    <p class="font-headline-md text-headline-md font-bold mt-2"><?= esc($value ?? '0') ?></p>
    
    <?php if (isset($icon) && isset($change_text) && isset($icon_color)): ?>
        <div class="flex items-center gap-1 <?= esc($icon_color) ?> mt-2">
            <span class="material-symbols-outlined text-[16px]"><?= esc($icon) ?></span>
            <span class="font-label-sm text-label-sm"><?= esc($change_text) ?></span>
        </div>
    <?php endif; ?>
</div>
