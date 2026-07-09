<?= $this->extend('FortuneOneCRM/common/master') ?>

<?= $this->section('content') ?>

<main class="absolute top-16 left-0 md:left-64 right-0 bottom-0 overflow-y-auto p-8 custom-scrollbar bg-[#F8F9FB]">
<div class="max-w-[1600px] mx-auto pb-12">

<!-- Page Header -->
<div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h1 class="text-[28px] font-bold text-[#1C222E] tracking-tight">Users Management</h1>
        <p class="text-[14px] text-gray-500 mt-1 font-medium">Manage advisor permissions, departments, and system access.</p>
    </div>
    <button type="button" onclick="document.getElementById('addUserModal').classList.remove('hidden')" class="bg-[#1C222E] hover:bg-[#2A3143] text-white py-2.5 px-5 rounded-xl font-semibold transition-colors text-sm shadow-sm flex items-center gap-2">
        <span class="material-symbols-outlined text-[20px]">person_add</span>
        Add New User
    </button>
</div>

<!-- KPI Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Users -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
            <span class="material-symbols-outlined">group</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Users</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($totalUsers ?? 0) ?></h3>
        </div>
    </div>
    <!-- Active -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600">
            <span class="material-symbols-outlined">how_to_reg</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Active</p>
            <div class="flex items-baseline gap-2">
                <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($activeUsers ?? 0) ?></h3>
                <span class="text-xs font-bold text-emerald-600"><?= esc($activePercent ?? 0) ?>%</span>
            </div>
        </div>
    </div>
    <!-- Management & Admins -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
            <span class="material-symbols-outlined">shield_person</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Management / Admins</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc(($managerUsers ?? 0) + ($adminUsers ?? 0)) ?></h3>
        </div>
    </div>
    <!-- Sales Advisors -->
    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
            <span class="material-symbols-outlined">support_agent</span>
        </div>
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Sales Team</p>
            <h3 class="text-2xl font-bold text-[#1C222E]"><?= esc($advisorUsers ?? 0) ?></h3>
        </div>
    </div>
</div>

<!-- Filters Bar -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 mb-8 flex flex-col md:flex-row items-center gap-4">
    <form id="filterForm" class="flex flex-col md:flex-row items-center gap-4 w-full">
        
        <!-- Search Input -->
        <div class="relative flex-1 w-full">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 material-symbols-outlined text-[20px]">search</span>
            <input type="text" id="searchInput" placeholder="Search users by name, email or role..." autocomplete="off" class="w-full pl-12 pr-4 py-3 bg-gray-50 border-transparent focus:border-[#B48A5E] focus:bg-white focus:ring-0 rounded-xl text-sm transition-all outline-none">
        </div>
        
        <!-- Department Filter -->
        <div class="w-full md:w-64">
            <select id="deptSelect" class="w-full px-4 py-3 bg-gray-50 border-transparent focus:border-[#B48A5E] focus:bg-white focus:ring-0 rounded-xl text-sm font-medium text-gray-700 transition-all outline-none cursor-pointer">
                <option value="">All Departments</option>
                <option value="Management">Management</option>
                <option value="Sales">Sales</option>
                <option value="Marketing">Marketing</option>
                <option value="Operations">Operations</option>
                <option value="Finance & Accounts">Finance & Accounts</option>
                <option value="Legal & Compliance">Legal & Compliance</option>
                <option value="Human Resources (HR)">Human Resources (HR)</option>
                <option value="Admin">Admin</option>
                <option value="IT & Technology">IT & Technology</option>
            </select>
        </div>
        
        <!-- Submit Button (Hidden because JS handles it instantly) -->
        <button type="submit" class="hidden">Apply Filters</button>
        
        <!-- Custom Clear Button (Controlled by JS) -->
        <button type="button" id="clearBtn" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-semibold transition-colors hidden">
            Clear
        </button>
    </form>
</div>

<!-- Table Container -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <?php if (empty($users)): ?>
        <div class="px-6 py-16 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                <span class="material-symbols-outlined text-[32px] text-gray-400">group_off</span>
            </div>
            <h3 class="text-base font-bold text-[#1C222E]">No users found</h3>
            <p class="text-sm text-gray-500 mt-1">There are currently no users in the system.</p>
        </div>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="dataTable">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="py-4 px-6">User</th>
                        <th class="py-4 px-6">Role</th>
                        <th class="py-4 px-6">Department</th>
                        <th class="py-4 px-6">Phone</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ($users as $u): ?>
                        <tr class="hover:bg-gray-50 transition-colors app-row">
                            <td class="py-4 px-6 user-col">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        <?php if (!empty($u['avatar_url'])): ?>
                                            <img alt="User" class="w-10 h-10 rounded-full object-cover border border-gray-200" src="<?= esc($u['avatar_url']) ?>"/>
                                        <?php else: ?>
                                            <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center font-bold text-indigo-600 border border-indigo-100 text-sm uppercase">
                                                <?= substr($u['name'], 0, 2) ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($u['status'] === 'Active'): ?>
                                            <div class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></div>
                                        <?php else: ?>
                                            <div class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-gray-400 border-2 border-white rounded-full"></div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="font-bold text-[#1C222E] text-sm"><?= esc($u['name']) ?></div>
                                        <div class="text-xs text-gray-500 font-medium"><?= esc($u['email']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 role-col">
                                <span class="px-3 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider border bg-gray-50 border-gray-200 text-gray-700">
                                    <?= esc(ucwords(str_replace('_', ' ', $u['role']))) ?>
                                </span>
                            </td>
                            <td class="py-4 px-6 dept-col text-sm font-semibold text-gray-800">
                                <?= esc($u['department'] ?? 'N/A') ?>
                            </td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-700"><?= esc($u['phone'] ?? 'N/A') ?></td>
                            <td class="py-4 px-6 status-col">
                                <?php if ($u['status'] === 'Active'): ?>
                                    <div class="flex items-center gap-2 text-emerald-600 text-xs font-bold uppercase tracking-wider bg-emerald-50 px-3 py-1.5 rounded-lg w-max">
                                        <div class="w-1.5 h-1.5 rounded-full bg-emerald-600"></div>
                                        Active
                                    </div>
                                <?php elseif ($u['status'] === 'Suspended'): ?>
                                    <div class="flex items-center gap-2 text-rose-600 text-xs font-bold uppercase tracking-wider bg-rose-50 px-3 py-1.5 rounded-lg w-max">
                                        <div class="w-1.5 h-1.5 rounded-full bg-rose-600"></div>
                                        Suspended
                                    </div>
                                <?php else: ?>
                                    <div class="flex items-center gap-2 text-gray-500 text-xs font-bold uppercase tracking-wider bg-gray-100 px-3 py-1.5 rounded-lg w-max">
                                        <div class="w-1.5 h-1.5 rounded-full bg-gray-500"></div>
                                        Inactive
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="<?= base_url('users/details/' . $u['id']) ?>" class="w-8 h-8 inline-flex rounded-full hover:bg-indigo-50 items-center justify-center text-gray-400 hover:text-indigo-600 transition-colors" title="Edit User">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <!-- Empty State Row (Hidden by default) -->
                    <tr id="emptyRow" style="display: none;">
                        <td colspan="6" class="px-6 py-16 text-center border-t border-gray-100">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                <span class="material-symbols-outlined text-[32px] text-gray-400">search_off</span>
                            </div>
                            <h3 class="text-base font-bold text-[#1C222E]">No users match your filter</h3>
                            <p class="text-sm text-gray-500 mt-1">Try typing something else or clear the filters.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-100 bg-gray-50/50">
            <?= view('FortuneOneCRM/common/pagination', [
                'page' => $page ?? 1,
                'totalRows' => $totalRows ?? 0,
                'perPage' => 10,
                'baseUrl' => 'users',
                'item_name' => 'users'
            ]) ?>
        </div>
    <?php endif; ?>
</div>

</div>

<!-- Premium Add User Modal -->
<div id="addUserModal" class="hidden fixed inset-0 bg-[#1C222E]/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col overflow-hidden">
        
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-100 bg-[#1C222E]">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-[#B48A5E]">person_add</span>
                Add New User
            </h3>
            <button type="button" onclick="document.getElementById('addUserModal').classList.add('hidden')" class="text-gray-400 hover:text-white transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="overflow-y-auto p-8 bg-[#F8F9FB]">
            <form action="<?= base_url('users/create') ?>" method="POST" id="addUserForm" class="space-y-8">
                <?= csrf_field() ?>
                
                <!-- Personal Info Section -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-5">
                    <h4 class="text-sm font-bold text-[#1C222E] uppercase tracking-wider flex items-center gap-2 mb-4 border-b border-gray-100 pb-3">
                        <span class="material-symbols-outlined text-[18px] text-[#B48A5E]">person</span>
                        Personal Information
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Full Name <span class="text-rose-500">*</span></label>
                            <input type="text" name="name" required placeholder="John Doe" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all">
                        </div>
                        
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Email Address <span class="text-rose-500">*</span></label>
                            <input type="email" name="email" required placeholder="john@fortuneone.co" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all">
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Phone Number</label>
                            <input type="text" name="phone" placeholder="+1 234 567 8900" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all">
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Temporary Password <span class="text-rose-500">*</span></label>
                            <input type="text" name="password" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all font-mono font-bold" value="<?= bin2hex(random_bytes(4)) ?>">
                        </div>
                    </div>
                </div>

                <!-- Organization Section -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-5">
                    <h4 class="text-sm font-bold text-[#1C222E] uppercase tracking-wider flex items-center gap-2 mb-4 border-b border-gray-100 pb-3">
                        <span class="material-symbols-outlined text-[18px] text-[#B48A5E]">corporate_fare</span>
                        Organization & Role
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Department <span class="text-rose-500">*</span></label>
                            <select name="department" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all cursor-pointer font-medium">
                                <option value="">Select Department</option>
                                <option value="Management">Management</option>
                                <option value="Sales">Sales</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Operations">Operations</option>
                                <option value="Finance & Accounts">Finance & Accounts</option>
                                <option value="Legal & Compliance">Legal & Compliance</option>
                                <option value="Human Resources (HR)">Human Resources (HR)</option>
                                <option value="Admin">Admin</option>
                                <option value="IT & Technology">IT & Technology</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Role / Title <span class="text-rose-500">*</span></label>
                            <select name="role" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all cursor-pointer font-medium">
                                <option value="">Select Role</option>
                                <optgroup label="Management">
                                    <option value="CEO">CEO</option>
                                    <option value="Managing Director">Managing Director</option>
                                    <option value="Founder">Founder</option>
                                    <option value="CBO">CBO</option>
                                    <option value="Executive Director">Executive Director</option>
                                    <option value="Chief People Growth Officer">Chief People Growth Officer</option>
                                </optgroup>
                                <optgroup label="Sales & Marketing">
                                    <option value="Sales Executive">Sales Executive</option>
                                    <option value="Senior Sales Executive">Senior Sales Executive</option>
                                    <option value="Sales Manager">Sales Manager</option>
                                </optgroup>
                                <optgroup label="Finance">
                                    <option value="Accountant">Accountant</option>
                                    <option value="Finance Manager">Finance Manager</option>
                                    <option value="CFO">CFO</option>
                                </optgroup>
                                <optgroup label="Legal">
                                    <option value="Legal Officer">Legal Officer</option>
                                </optgroup>
                                <optgroup label="Administration">
                                    <option value="Admin Executive">Admin Executive</option>
                                    <option value="Office Manager">Office Manager</option>
                                </optgroup>
                                <optgroup label="IT">
                                    <option value="IT Administrator">IT Administrator</option>
                                </optgroup>
                                <optgroup label="Human Resources">
                                    <option value="HR Executive">HR Executive</option>
                                    <option value="HR Manager">HR Manager</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-2">Account Status</label>
                            <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#B48A5E]/20 focus:border-[#B48A5E] transition-all cursor-pointer font-medium">
                                <option value="Active">Active</option>
                                <option value="Suspended">Suspended</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Permissions Section -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm space-y-5">
                    <h4 class="text-sm font-bold text-[#1C222E] uppercase tracking-wider flex items-center gap-2 mb-4 border-b border-gray-100 pb-3">
                        <span class="material-symbols-outlined text-[18px] text-[#B48A5E]">admin_panel_settings</span>
                        Module Access & Permissions
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="permissions[]" value="dashboard_access" checked class="w-4 h-4 rounded text-[#B48A5E] focus:ring-[#B48A5E]">
                            <span class="text-sm font-medium text-gray-800">Dashboard Access</span>
                        </label>
                        <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="permissions[]" value="appointments_access" class="w-4 h-4 rounded text-[#B48A5E] focus:ring-[#B48A5E]">
                            <span class="text-sm font-medium text-gray-800">Appointments (View)</span>
                        </label>
                        <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="permissions[]" value="appointments_manage" class="w-4 h-4 rounded text-[#B48A5E] focus:ring-[#B48A5E]">
                            <span class="text-sm font-medium text-gray-800">Appointments (Manage)</span>
                        </label>
                        <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="permissions[]" value="careers_access" class="w-4 h-4 rounded text-[#B48A5E] focus:ring-[#B48A5E]">
                            <span class="text-sm font-medium text-gray-800">Career Apps (View)</span>
                        </label>
                        <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="permissions[]" value="careers_manage" class="w-4 h-4 rounded text-[#B48A5E] focus:ring-[#B48A5E]">
                            <span class="text-sm font-medium text-gray-800">Career Apps (Manage)</span>
                        </label>
                        <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="permissions[]" value="enquiries_access" class="w-4 h-4 rounded text-[#B48A5E] focus:ring-[#B48A5E]">
                            <span class="text-sm font-medium text-gray-800">Enquiries (View)</span>
                        </label>
                        <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="permissions[]" value="enquiries_manage" class="w-4 h-4 rounded text-[#B48A5E] focus:ring-[#B48A5E]">
                            <span class="text-sm font-medium text-gray-800">Enquiries (Manage)</span>
                        </label>
                        <label class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">
                            <input type="checkbox" name="permissions[]" value="users_manage" class="w-4 h-4 rounded text-rose-500 focus:ring-rose-500">
                            <span class="text-sm font-bold text-rose-600">User Management (Admins)</span>
                        </label>
                    </div>
                </div>

            </form>
        </div>
        
        <!-- Modal Footer -->
        <div class="p-6 border-t border-gray-100 bg-white flex items-center justify-end gap-3 rounded-b-2xl">
            <button type="button" onclick="document.getElementById('addUserModal').classList.add('hidden')" class="px-6 py-3 border border-gray-200 text-gray-700 hover:bg-gray-50 rounded-xl font-semibold transition-colors text-sm">
                Cancel
            </button>
            <button type="submit" form="addUserForm" class="px-6 py-3 bg-[#B48A5E] hover:bg-[#9d7852] text-white rounded-xl font-semibold transition-colors text-sm shadow-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Create User
            </button>
        </div>
    </div>
</div>
</main>

<script>
// --- STRICT VISUAL CLIENT-SIDE FILTERING FOR USERS ---
const searchInput = document.getElementById('searchInput');
const deptSelect = document.getElementById('deptSelect');
const clearBtn = document.getElementById('clearBtn');
const rows = document.querySelectorAll('.app-row');
const emptyRow = document.getElementById('emptyRow');

function filterTable() {
    const query = searchInput.value.toLowerCase().trim();
    const deptVal = deptSelect.value.toLowerCase();
    
    if (query.length > 0 || deptVal.length > 0) {
        clearBtn.classList.remove('hidden');
    } else {
        clearBtn.classList.add('hidden');
    }

    let visibleCount = 0;

    rows.forEach(row => {
        const userText = row.querySelector('.user-col').innerText.toLowerCase();
        const roleText = row.querySelector('.role-col').innerText.toLowerCase();
        const deptText = row.querySelector('.dept-col').innerText.toLowerCase();
        
        const matchesSearch = (query === '') || userText.includes(query) || roleText.includes(query);
        const matchesDept = (deptVal === '') || deptText.includes(deptVal);
        
        if (matchesSearch && matchesDept) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    if (emptyRow) {
        if (visibleCount === 0) {
            emptyRow.style.display = '';
        } else {
            emptyRow.style.display = 'none';
        }
    }
}

searchInput.addEventListener('input', filterTable);
deptSelect.addEventListener('change', filterTable);

document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    filterTable();
});

clearBtn.addEventListener('click', function() {
    searchInput.value = '';
    deptSelect.value = '';
    filterTable();
});
</script>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/crm/js/users.js') ?>"></script>
<?= $this->endSection() ?>
