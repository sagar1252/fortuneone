<div class="mb-xl">
    <h2 class="font-headline-lg text-headline-lg font-bold text-on-surface"><?= esc($title ?? 'Title') ?></h2>
    <?php if (isset($subtitle) && $subtitle !== ''): ?>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1"><?= esc($subtitle) ?></p>
    <?php endif; ?>
    <?php if (isset($actions)): ?>
        <div class="mt-4 flex flex-wrap gap-3">
            <?= $actions ?>
        </div>
    <?php endif; ?>
</div>
