<?php
$statusClass = 'bg-surface-container text-on-surface-variant border-outline-variant';
$label = esc($status ?? 'Unknown');

$lowerStatus = strtolower($status ?? '');

if (in_array($lowerStatus, ['new'])) {
    $statusClass = 'bg-blue-50 text-blue-700 border-blue-200';
    $label = 'New';
} elseif (in_array($lowerStatus, ['warm', 'interested', 'contacted'])) {
    $statusClass = 'bg-amber-50 text-amber-700 border-amber-200';
} elseif (in_array($lowerStatus, ['hot'])) {
    $statusClass = 'bg-red-50 text-red-700 border-red-200';
} elseif (in_array($lowerStatus, ['ready', 'booked', 'completed', 'selected', 'active'])) {
    $statusClass = 'bg-green-50 text-green-700 border-green-200';
} elseif (in_array($lowerStatus, ['lost', 'cancelled', 'rejected', 'inactive'])) {
    $statusClass = 'bg-surface-container-high text-on-surface-variant border-outline-variant';
} elseif (in_array($lowerStatus, ['scheduled'])) {
    $statusClass = 'bg-purple-50 text-purple-700 border-purple-200';
}
?>
<span class="px-2.5 py-1 rounded-full <?= esc($statusClass) ?> text-[11px] font-bold border whitespace-nowrap"><?= esc($label) ?></span>
