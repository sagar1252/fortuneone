<?php if (isset($totalRows) && $totalRows > 0): ?>
<div class="px-lg py-4 bg-surface-container-low border-t border-outline-variant flex justify-between items-center">
    <?php 
    $perPage = $perPage ?? 10;
    $currentPage = $page ?? 1;
    $startRange = ($currentPage - 1) * $perPage + 1;
    $endRange = min($currentPage * $perPage, $totalRows);
    $totalPages = $totalPages ?? ceil($totalRows / $perPage);
    
    // Maintain query string
    $queryParams = $_GET;
    ?>
    <p class="font-label-sm text-label-sm text-on-surface-variant">Showing <?= esc($startRange) ?>-<?= esc($endRange) ?> of <?= number_format($totalRows) ?> <?= esc($item_name ?? 'items') ?></p>
    <div class="flex items-center gap-2">
        <a href="<?= $currentPage > 1 ? base_url($baseUrl . '?' . http_build_query(array_merge($queryParams, ['page' => $currentPage - 1]))) : '#' ?>" class="p-2 border border-outline-variant rounded-md hover:bg-white <?= $currentPage <= 1 ? 'opacity-50 pointer-events-none' : '' ?>">
            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
        </a>
        
        <?php if (isset($showPages) && $showPages): ?>
            <span class="px-3 py-1 text-xs border border-surface-container rounded bg-white font-bold"><?= esc($currentPage) ?> / <?= max(1, $totalPages) ?></span>
        <?php endif; ?>

        <a href="<?= $currentPage < $totalPages ? base_url($baseUrl . '?' . http_build_query(array_merge($queryParams, ['page' => $currentPage + 1]))) : '#' ?>" class="p-2 border border-outline-variant rounded-md hover:bg-white <?= $currentPage >= $totalPages ? 'opacity-50 pointer-events-none' : '' ?>">
            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
        </a>
    </div>
</div>
<?php endif; ?>
