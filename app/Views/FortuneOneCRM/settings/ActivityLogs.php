<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<div class="space-y-md">
    <div class="flex justify-between items-center bg-white p-lg border-b border-outline-variant">
        <div>
            <h1 class="text-headline-md font-headline-md text-primary tracking-tight">Activity Logs</h1>
            <p class="text-body-md text-secondary mt-1">Monitor system-wide events and user actions securely.</p>
        </div>
    </div>

    <div class="p-gutter">
        <div class="bg-surface-container-lowest rounded-xl premium-shadow border border-outline-variant overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-surface-container-low border-b border-outline-variant text-on-surface-variant font-label-md">
                        <tr>
                            <th class="px-6 py-4">Timestamp</th>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Action</th>
                            <th class="px-6 py-4">Module</th>
                            <th class="px-6 py-4">IP Address</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant text-body-md">
                        <?php if (empty($logs)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-secondary">
                                    No activity logs found.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($logs as $log): ?>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-on-surface-variant"><?= esc($log['timestamp']) ?></td>
                                    <td class="px-6 py-4 font-medium text-primary"><?= esc($log['user_name']) ?></td>
                                    <td class="px-6 py-4 text-secondary"><?= esc($log['role']) ?></td>
                                    <td class="px-6 py-4 font-medium text-primary">
                                        <span class="px-2.5 py-1 rounded-full bg-surface-container border text-[11px] font-bold">
                                            <?= esc($log['action']) ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-secondary"><?= esc($log['module']) ?></td>
                                    <td class="px-6 py-4 text-secondary font-mono text-xs"><?= esc($log['ip_address']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
