<nav class="flex items-center text-sm font-medium text-slate-500 mb-4" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2">
        <?php foreach($items as $index => $item): ?>
            <li>
                <div class="flex items-center">
                    <?php if($index > 0): ?>
                        <svg class="h-4 w-4 text-slate-400 mx-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <?php endif; ?>
                    
                    <?php if(!empty($item['url'])): ?>
                        <a href="<?= esc($item['url']) ?>" class="hover:text-indigo-600 transition-colors">
                            <?= esc($item['title'] ?? $item['label'] ?? '') ?>
                        </a>
                    <?php else: ?>
                        <span class="text-slate-800" aria-current="page"><?= esc($item['title'] ?? $item['label'] ?? '') ?></span>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
