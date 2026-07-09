<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[1440px] mx-auto pb-12">

<!-- Back Button & Header -->
<div class="mb-8 flex items-center gap-4">
    <a href="<?= base_url('users') ?>" class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 hover:text-[#1C222E] transition-colors shadow-sm">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
    </a>
    <div>
        <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight leading-tight">User Profile</h1>
        <p class="text-sm text-gray-500 mt-1 font-medium">Manage details, permissions, and history</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

<!-- LEFT SIDEBAR: Employee Profile Card -->
<section class="lg:col-span-4 space-y-6">
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden relative">
        <!-- Cover Background -->
        <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-br from-[#1C222E] to-[#2A3143]"></div>
        
        <div class="relative z-10 pt-16 px-6 pb-8 text-center">
            <!-- Avatar -->
            <div class="w-28 h-28 rounded-full border-4 border-white shadow-md mx-auto overflow-hidden bg-indigo-50 mb-4 flex items-center justify-center">
                <?php if (!empty($user['avatar_url'])): ?>
                    <img alt="User Portrait" src="<?= esc($user['avatar_url']) ?>" class="w-full h-full object-cover"/>
                <?php else: ?>
                    <span class="text-3xl font-bold text-indigo-600 uppercase"><?= substr($user['name'], 0, 2) ?></span>
                <?php endif; ?>
            </div>
            
            <h3 class="text-2xl font-bold text-[#1C222E] tracking-tight"><?= esc($user['name']) ?></h3>
            <p class="text-sm font-bold text-[#B48A5E] uppercase tracking-wider mt-1 mb-4"><?= esc(ucwords(str_replace('_', ' ', $user['role']))) ?></p>
            
            <div class="flex justify-center mb-6">
                <?php if ($user['status'] === 'Active'): ?>
                    <span class="px-4 py-1.5 bg-emerald-50 text-emerald-700 text-xs rounded-lg font-bold uppercase tracking-wider border border-emerald-100">Active</span>
                <?php elseif ($user['status'] === 'Suspended'): ?>
                    <span class="px-4 py-1.5 bg-rose-50 text-rose-700 text-xs rounded-lg font-bold uppercase tracking-wider border border-rose-100">Suspended</span>
                <?php else: ?>
                    <span class="px-4 py-1.5 bg-gray-100 text-gray-700 text-xs rounded-lg font-bold uppercase tracking-wider border border-gray-200"><?= esc($user['status']) ?></span>
                <?php endif; ?>
            </div>
            
            <!-- Details List -->
            <div class="space-y-4 text-left pt-6 border-t border-gray-100">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Employee ID</p>
                    <p class="text-sm font-bold text-[#1C222E]">FO-USR-<?= esc($user['id']) ?></p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Department</p>
                    <p class="text-sm font-bold text-[#1C222E]"><?= esc($user['department'] ?? 'N/A') ?></p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Joined Date</p>
                    <p class="text-sm font-bold text-[#1C222E]"><?= date('M d, Y', strtotime($user['created_at'])) ?></p>
                </div>
                <div class="pt-2 flex flex-col gap-3">
                    <a href="mailto:<?= esc($user['email']) ?>" class="flex items-center gap-3 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <span class="material-symbols-outlined text-[18px]">mail</span>
                        <span class="truncate"><?= esc($user['email']) ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MAIN CONTENT AREA: Multi-tabbed interface -->
<section class="lg:col-span-8 space-y-6">
    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Tab Header -->
        <div class="flex border-b border-gray-100 bg-gray-50/50 px-2 pt-2">
            <button class="tab-btn active px-6 py-4 text-sm font-bold text-[#B48A5E] border-b-2 border-[#B48A5E] transition-all bg-white rounded-t-lg" onclick="switchTab(event, 'tab-overview')">Overview</button>
            <button class="tab-btn px-6 py-4 text-sm font-bold text-gray-500 hover:text-[#1C222E] border-b-2 border-transparent transition-all" onclick="switchTab(event, 'tab-appointments')">Appointments</button>
            <button class="tab-btn px-6 py-4 text-sm font-bold text-gray-500 hover:text-[#1C222E] border-b-2 border-transparent transition-all" onclick="switchTab(event, 'tab-permissions')">Permissions</button>
        </div>
        
        <!-- Tab Content -->
        <div class="p-8">
            
            <!-- TAB 1: Overview -->
            <form class="tab-panel block" id="tab-overview" method="POST" action="<?= base_url('users/update') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($user['id']) ?>">

                <h4 class="text-sm font-bold text-[#1C222E] uppercase tracking-wider flex items-center gap-2 mb-6 border-b border-gray-100 pb-3">
                    <span class="material-symbols-outlined text-[18px] text-[#B48A5E]">manage_accounts</span>
                    Edit Profile Details
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Full Name</label>
                        <input type="text" name="name" value="<?= esc($user['name']) ?>" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                        <input type="email" name="email" value="<?= esc($user['email']) ?>" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Department</label>
                        <select name="department" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] outline-none transition-all cursor-pointer font-medium">
                            <option value="">Select Department</option>
                            <?php 
                                $depts = ['Management', 'Sales', 'Marketing', 'Operations', 'Finance & Accounts', 'Legal & Compliance', 'Human Resources (HR)', 'Admin', 'IT & Technology'];
                                $userDept = $user['department'] ?? '';
                                foreach ($depts as $d) {
                                    $selected = ($userDept == $d) ? 'selected' : '';
                                    echo "<option value=\"$d\" $selected>$d</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Role / Title</label>
                        <select name="role" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] outline-none transition-all cursor-pointer font-medium">
                            <?php $r = $user['role']; ?>
                            <option value="">Select Role</option>
                            <optgroup label="Management">
                                <option value="CEO" <?= $r=='CEO'?'selected':'' ?>>CEO</option>
                                <option value="Managing Director" <?= $r=='Managing Director'?'selected':'' ?>>Managing Director</option>
                                <option value="Founder" <?= $r=='Founder'?'selected':'' ?>>Founder</option>
                                <option value="CBO" <?= $r=='CBO'?'selected':'' ?>>CBO</option>
                                <option value="Executive Director" <?= $r=='Executive Director'?'selected':'' ?>>Executive Director</option>
                                <option value="Chief People Growth Officer" <?= $r=='Chief People Growth Officer'?'selected':'' ?>>Chief People Growth Officer</option>
                            </optgroup>
                            <optgroup label="Sales & Marketing">
                                <option value="Sales Executive" <?= $r=='Sales Executive'?'selected':'' ?>>Sales Executive</option>
                                <option value="Senior Sales Executive" <?= $r=='Senior Sales Executive'?'selected':'' ?>>Senior Sales Executive</option>
                                <option value="Sales Manager" <?= $r=='Sales Manager'?'selected':'' ?>>Sales Manager</option>
                            </optgroup>
                            <optgroup label="Finance">
                                <option value="Accountant" <?= $r=='Accountant'?'selected':'' ?>>Accountant</option>
                                <option value="Finance Manager" <?= $r=='Finance Manager'?'selected':'' ?>>Finance Manager</option>
                                <option value="CFO" <?= $r=='CFO'?'selected':'' ?>>CFO</option>
                            </optgroup>
                            <optgroup label="Legal">
                                <option value="Legal Officer" <?= $r=='Legal Officer'?'selected':'' ?>>Legal Officer</option>
                            </optgroup>
                            <optgroup label="Administration">
                                <option value="Admin Executive" <?= $r=='Admin Executive'?'selected':'' ?>>Admin Executive</option>
                                <option value="Office Manager" <?= $r=='Office Manager'?'selected':'' ?>>Office Manager</option>
                            </optgroup>
                            <optgroup label="IT">
                                <option value="IT Administrator" <?= $r=='IT Administrator'?'selected':'' ?>>IT Administrator</option>
                            </optgroup>
                            <optgroup label="Human Resources">
                                <option value="HR Executive" <?= $r=='HR Executive'?'selected':'' ?>>HR Executive</option>
                                <option value="HR Manager" <?= $r=='HR Manager'?'selected':'' ?>>HR Manager</option>
                            </optgroup>
                            <!-- Fallbacks for legacy roles -->
                            <optgroup label="Legacy">
                                <option value="admin" <?= $r=='admin'?'selected':'' ?>>Administrator</option>
                                <option value="manager" <?= $r=='manager'?'selected':'' ?>>Manager</option>
                                <option value="sales_advisor" <?= $r=='sales_advisor'?'selected':'' ?>>Sales Advisor</option>
                                <option value="recruiter" <?= $r=='recruiter'?'selected':'' ?>>Recruiter</option>
                            </optgroup>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Account Status</label>
                        <select name="status" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm text-gray-900 focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] outline-none transition-all cursor-pointer font-medium">
                            <option value="Active" <?= ($user['status'] === 'Active') ? 'selected' : '' ?>>Active</option>
                            <option value="Suspended" <?= ($user['status'] === 'Suspended') ? 'selected' : '' ?>>Suspended</option>
                            <option value="Inactive" <?= ($user['status'] === 'Inactive') ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end mt-8 pt-6 border-t border-gray-100">
                    <button type="submit" class="bg-[#1C222E] text-white px-6 py-3 rounded-xl text-sm font-semibold hover:bg-[#2A3143] transition-all shadow-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Save Profile Changes
                    </button>
                </div>
            </form>

            <!-- TAB 3: Appointments -->
            <div class="tab-panel hidden" id="tab-appointments">
                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Lead / Contact</th>
                                <th class="py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date/Time</th>
                                <th class="py-4 px-6 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                        <?php if (!empty($user_appointments)): ?>
                            <?php foreach ($user_appointments as $app): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-6 text-sm font-bold text-[#1C222E]">
                                        <?= esc($app['lead_name']) ?>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-600">
                                        <?= esc(ucwords(str_replace('_', ' ', $app['appointment_type']))) ?>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-600">
                                        <?= date('M d, Y h:i A', strtotime($app['preferred_date'])) ?>
                                    </td>
                                    <td class="py-4 px-6">
                                        <?php
                                        $statusClass = 'bg-gray-100 text-gray-700';
                                        if ($app['status'] === 'confirmed') $statusClass = 'bg-emerald-50 text-emerald-700';
                                        if ($app['status'] === 'pending') $statusClass = 'bg-amber-50 text-amber-700';
                                        if ($app['status'] === 'completed') $statusClass = 'bg-blue-50 text-blue-700';
                                        ?>
                                        <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider <?= esc($statusClass) ?>">
                                            <?= esc(ucfirst($app['status'])) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="py-12 px-6 text-center text-gray-500 font-medium">No appointments scheduled for this user.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB 5: Permissions -->
            <div class="tab-panel hidden" id="tab-permissions">
                <?php
                $userPerms = json_decode($user['permissions'] ?? '[]', true) ?: [];
                $currentUserRole = session()->get('role');
                $isAdmin = (session()->get('user_email') === 'admin@fortuneone.co');
                
                $modules = [
                    'dashboard_access' => ['name' => 'Dashboard Access', 'desc' => 'View performance metrics and global charts.'],
                    'appointments_access' => ['name' => 'Appointments (View)', 'desc' => 'View scheduled appointments and visits.'],
                    'appointments_manage' => ['name' => 'Appointments (Manage)', 'desc' => 'Create and modify appointments.'],
                    'careers_access' => ['name' => 'Career Applications (View)', 'desc' => 'View job applications.'],
                    'careers_manage' => ['name' => 'Career Applications (Manage)', 'desc' => 'Review and process applications.'],
                    'enquiries_access' => ['name' => 'Enquiries (View)', 'desc' => 'View incoming website enquiries.'],
                    'enquiries_manage' => ['name' => 'Enquiries (Manage)', 'desc' => 'Reply to or close website enquiries.'],
                    'users_manage' => ['name' => 'User Management', 'desc' => 'Modify system users and permissions (Admins only).'],
                ];
                ?>
                <form id="form-permissions" method="POST" action="<?= base_url('users/update_permissions') ?>" class="space-y-4">
                    <?= csrf_field() ?>
                    <input type="hidden" name="user_id" value="<?= esc($user['id']) ?>">
                    
                    <h4 class="text-sm font-bold text-[#1C222E] uppercase tracking-wider flex items-center gap-2 mb-6 border-b border-gray-100 pb-3">
                        <span class="material-symbols-outlined text-[18px] text-[#B48A5E]">admin_panel_settings</span>
                        System Access Control
                    </h4>

                    <?php foreach ($modules as $key => $module): ?>
                    <div class="flex items-center justify-between p-5 bg-gray-50 border border-gray-100 rounded-xl hover:bg-white hover:border-gray-200 transition-all shadow-sm">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center <?= in_array($key, $userPerms) ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-200 text-gray-400' ?>">
                                <span class="material-symbols-outlined"><?= in_array($key, $userPerms) ? 'check_circle' : 'lock' ?></span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-[#1C222E]"><?= esc($module['name']) ?></p>
                                <p class="text-xs font-medium text-gray-500 mt-0.5"><?= esc($module['desc']) ?></p>
                            </div>
                        </div>
                        <?php if ($isAdmin): ?>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="permissions[]" value="<?= esc($key) ?>" <?= in_array($key, $userPerms) ? 'checked' : '' ?> class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#B48A5E]"></div>
                            </label>
                        <?php else: ?>
                            <span class="px-3 py-1.5 <?= in_array($key, $userPerms) ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-600' ?> text-xs rounded-lg font-bold uppercase tracking-wider">
                                <?= in_array($key, $userPerms) ? 'Allowed' : 'Restricted' ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>

                    <?php if ($isAdmin): ?>
                        <div class="flex justify-end pt-6 mt-4 border-t border-gray-100">
                            <button type="submit" class="bg-[#B48A5E] hover:bg-[#9d7852] text-white px-6 py-3 rounded-xl text-sm font-semibold transition-colors shadow-sm flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">security</span>
                                Save Permissions
                            </button>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
            
        </div>
    </div>
</section>

</div>
</div>
</main>

<script>
function switchTab(event, tabId) {
    event.preventDefault();
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanels = document.querySelectorAll('.tab-panel');

    tabBtns.forEach(btn => {
        btn.classList.remove('active', 'text-[#B48A5E]', 'border-[#B48A5E]', 'bg-white', 'rounded-t-lg');
        btn.classList.add('text-gray-500', 'border-transparent');
    });
    
    event.currentTarget.classList.remove('text-gray-500', 'border-transparent');
    event.currentTarget.classList.add('active', 'text-[#B48A5E]', 'border-[#B48A5E]', 'bg-white', 'rounded-t-lg');

    tabPanels.forEach(panel => {
        panel.classList.add('hidden');
        panel.classList.remove('block');
    });
    
    document.getElementById(tabId).classList.remove('hidden');
    document.getElementById(tabId).classList.add('block');
}
</script>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/crm/js/userdetails.js') ?>"></script>
<?= $this->endSection() ?>
