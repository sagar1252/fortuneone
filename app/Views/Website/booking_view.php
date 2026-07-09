<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Meeting</title>
    <!-- Fonts: DM Sans for body, Fraunces for heading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-indigo: #4F46E5;
            --bg-soft: #F5F5FF;
            --text-disabled: #D1D5DB;
        }
        body {
            background-color: var(--bg-soft);
            font-family: 'DM Sans', sans-serif;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Fraunces', serif;
        }
        .booking-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }
        .panel {
            padding: 2.5rem;
        }
        .left-panel {
            border-right: 1px solid #f0f0f0;
        }
        @media (max-width: 768px) {
            .left-panel { border-right: none; border-bottom: 1px solid #f0f0f0; }
        }
        
        /* Calendar Styles */
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .calendar-nav {
            cursor: pointer;
            padding: 0.5rem;
            color: #666;
            transition: all 0.2s ease;
        }
        .calendar-nav:hover { color: var(--primary-indigo); }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
            text-align: center;
        }
        .calendar-day-header {
            font-size: 0.8rem;
            font-weight: 600;
            color: #888;
            margin-bottom: 0.5rem;
        }
        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        .calendar-day:not(.disabled):not(.selected):not(.empty):hover {
            background-color: rgba(79, 70, 229, 0.1);
            color: var(--primary-indigo);
        }
        .calendar-day.today {
            border: 2px dashed var(--primary-indigo);
            color: var(--primary-indigo);
        }
        .calendar-day.selected {
            background-color: var(--primary-indigo);
            color: #fff;
            border-color: var(--primary-indigo);
        }
        .calendar-day.disabled {
            color: var(--text-disabled);
            cursor: not-allowed;
            background: none;
            border-color: transparent;
        }
        .calendar-day.empty {
            cursor: default;
        }

        /* Time Slots Styles */
        .time-slots-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 0.75rem;
            margin-bottom: 2rem;
            max-height: 250px;
            overflow-y: auto;
            padding-right: 0.5rem;
        }
        .time-slots-container::-webkit-scrollbar { width: 6px; }
        .time-slots-container::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }
        .time-pill {
            border: 1px solid var(--primary-indigo);
            color: var(--primary-indigo);
            background: #fff;
            border-radius: 50px;
            padding: 0.5rem;
            text-align: center;
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .time-pill:hover {
            background-color: rgba(79, 70, 229, 0.1);
        }
        .time-pill.selected {
            background-color: var(--primary-indigo);
            color: #fff;
        }

        /* Form Styles */
        .form-control:focus {
            border-color: var(--primary-indigo);
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
        }
        .btn-primary {
            background-color: var(--primary-indigo);
            border-color: var(--primary-indigo);
            border-radius: 8px;
            padding: 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: #4338ca;
            border-color: #4338ca;
        }
        
        .invalid-feedback { display: block; }
        .spinner-border { width: 1.2rem; height: 1.2rem; display: none; }
        .btn-loading .spinner-border { display: inline-block; }
        .btn-loading .btn-text { opacity: 0.5; }

        /* Success Card */
        #success-card {
            display: none;
            text-align: center;
            padding: 2rem 0;
            animation: fadeIn 0.5s ease;
        }
        #success-card svg {
            width: 80px;
            height: 80px;
            color: #10B981;
            margin-bottom: 1rem;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<!-- .env EMAIL CONFIG 
email.SMTPHost = smtp.gmail.com
email.SMTPUser = your@gmail.com
email.SMTPPass = your_app_password
email.SMTPPort = 587
email.SMTPCrypto = tls
email.fromEmail = your@gmail.com
email.fromName = Booking System
-->

<div class="booking-card row g-0">
    <!-- LEFT PANEL: Calendar -->
    <div class="col-md-5 left-panel panel">
        <h4 class="mb-4">Select a Date</h4>
        <div class="calendar-header">
            <div class="calendar-nav" id="prev-month">&larr;</div>
            <h5 id="month-year" class="mb-0"></h5>
            <div class="calendar-nav" id="next-month">&rarr;</div>
        </div>
        <div class="calendar-grid">
            <div class="calendar-day-header">SUN</div>
            <div class="calendar-day-header">MON</div>
            <div class="calendar-day-header">TUE</div>
            <div class="calendar-day-header">WED</div>
            <div class="calendar-day-header">THU</div>
            <div class="calendar-day-header">FRI</div>
            <div class="calendar-day-header">SAT</div>
        </div>
        <div class="calendar-grid" id="calendar-days">
            <!-- Calendar generated by JS -->
        </div>
    </div>

    <!-- RIGHT PANEL: Time Slots + Form -->
    <div class="col-md-7 panel">
        <div id="booking-flow">
            <div id="time-selection" style="display: none;">
                <h4 class="mb-4">Select a Time for <span id="display-date" style="color: var(--primary-indigo);"></span></h4>
                <div class="time-slots-container" id="time-slots">
                    <!-- Times generated by JS -->
                </div>
            </div>

            <div id="empty-state" class="text-center text-muted mt-5">
                <p>Please select a date from the calendar first.</p>
            </div>

            <div id="booking-form-container" style="display: none;">
                <h5 class="mb-3">Enter your details</h5>
                <form id="booking-form">
                    <?= csrf_field() ?>
                    <input type="hidden" id="selected_date" name="selected_date" required>
                    <input type="hidden" id="selected_time" name="selected_time" required>
                    
                    <div class="mb-3">
                        <label class="form-label">Full Name *</label>
                        <input type="text" class="form-control" name="full_name" required minlength="3">
                        <div class="invalid-feedback" id="err-full_name"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email Address *</label>
                        <input type="email" class="form-control" name="email" required>
                        <div class="invalid-feedback" id="err-email"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Phone Number (Optional)</label>
                        <input type="tel" class="form-control" name="phone">
                        <div class="invalid-feedback" id="err-phone"></div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Message (Optional)</label>
                        <textarea class="form-control" name="message" rows="3"></textarea>
                        <div class="invalid-feedback" id="err-message"></div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100" id="submit-btn">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="btn-text">Request Meeting</span>
                    </button>
                    <div class="invalid-feedback mt-2 text-center" id="err-server"></div>
                </form>
            </div>
        </div>

        <div id="success-card">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <h3 class="mb-3">Meeting Request Sent!</h3>
            <p class="text-muted mb-4">Your meeting request has been sent successfully. We will contact you shortly.</p>
            <div class="card bg-light border-0 text-start p-3 mx-auto" style="max-width: 300px;">
                <p class="mb-1"><strong>Date:</strong> <span id="summary-date"></span></p>
                <p class="mb-0"><strong>Time:</strong> <span id="summary-time"></span></p>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentDate = new Date();
    let selectedDateObj = null;
    let selectedTimeStr = null;
    let bookedSlots = [];

    // Fetch booked slots
    fetch('<?= base_url('booking/slots') ?>')
        .then(r => r.json())
        .then(d => {
            if (d.status) bookedSlots = d.booked_slots || [];
        })
        .catch(e => console.error("Could not load booked slots", e));

    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    
    const calendarDays = document.getElementById('calendar-days');
    const monthYear = document.getElementById('month-year');
    const inputDate = document.getElementById('selected_date');
    const inputTime = document.getElementById('selected_time');
    
    const timeSelection = document.getElementById('time-selection');
    const emptyState = document.getElementById('empty-state');
    const formContainer = document.getElementById('booking-form-container');
    const timeSlotsContainer = document.getElementById('time-slots');
    const displayDate = document.getElementById('display-date');

    function renderCalendar(date) {
        calendarDays.innerHTML = '';
        const year = date.getFullYear();
        const month = date.getMonth();
        monthYear.innerText = `${monthNames[month]} ${year}`;
        
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        
        const today = new Date();
        today.setHours(0,0,0,0);

        for (let i = 0; i < firstDay; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'calendar-day empty';
            calendarDays.appendChild(emptyDiv);
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'calendar-day';
            dayDiv.innerText = i;
            
            const cellDate = new Date(year, month, i);
            cellDate.setHours(0,0,0,0);
            
            if (cellDate.getTime() === today.getTime()) {
                dayDiv.classList.add('today');
            }
            if (cellDate < today) {
                dayDiv.classList.add('disabled');
            } else {
                dayDiv.addEventListener('click', () => selectDate(cellDate, dayDiv));
            }
            
            if (selectedDateObj && cellDate.getTime() === selectedDateObj.getTime()) {
                dayDiv.classList.add('selected');
            }
            
            calendarDays.appendChild(dayDiv);
        }
    }

    function selectDate(date, element) {
        document.querySelectorAll('.calendar-day').forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');
        
        selectedDateObj = date;
        const formattedDate = `${date.getFullYear()}-${String(date.getMonth()+1).padStart(2,'0')}-${String(date.getDate()).padStart(2,'0')}`;
        inputDate.value = formattedDate;
        displayDate.innerText = `${monthNames[date.getMonth()]} ${date.getDate()}, ${date.getFullYear()}`;
        
        selectedTimeStr = null;
        inputTime.value = '';
        
        emptyState.style.display = 'none';
        timeSelection.style.display = 'block';
        formContainer.style.display = 'none';
        
        renderTimeSlots();
    }

    function renderTimeSlots() {
        timeSlotsContainer.innerHTML = '';
        const times = [];
        for (let h = 9; h <= 17; h++) {
            const ampm = h >= 12 ? 'PM' : 'AM';
            const displayH = h > 12 ? h - 12 : h;
            times.push(`${displayH}:00 ${ampm}`);
            if (h !== 17) times.push(`${displayH}:30 ${ampm}`);
        }
        
        const dateStr = `${selectedDateObj.getFullYear()}-${String(selectedDateObj.getMonth()+1).padStart(2,'0')}-${String(selectedDateObj.getDate()).padStart(2,'0')}`;
        
        times.forEach(t => {
            const pill = document.createElement('div');
            pill.className = 'time-pill';
            pill.innerText = t;
            
            const slotKey = `${dateStr}_${t}`;
            
            if (bookedSlots.includes(slotKey)) {
                pill.classList.add('disabled');
                pill.style.opacity = '0.5';
                pill.style.cursor = 'not-allowed';
                pill.style.backgroundColor = '#f5f5f5';
                pill.style.borderColor = '#ccc';
                pill.style.color = '#888';
                pill.innerText = `${t} (Booked)`;
            } else {
                pill.addEventListener('click', () => {
                    document.querySelectorAll('.time-pill').forEach(el => el.classList.remove('selected'));
                    pill.classList.add('selected');
                    selectedTimeStr = t;
                    inputTime.value = t;
                    formContainer.style.display = 'block';
                    formContainer.scrollIntoView({behavior: "smooth", block: "start"});
                });
            }
            timeSlotsContainer.appendChild(pill);
        });
    }

    document.getElementById('prev-month').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    document.getElementById('next-month').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    renderCalendar(currentDate);

    // Form Submission
    const form = document.getElementById('booking-form');
    const submitBtn = document.getElementById('submit-btn');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        document.querySelectorAll('.invalid-feedback').forEach(el => el.innerText = '');
        
        submitBtn.classList.add('btn-loading');
        submitBtn.disabled = true;

        fetch('<?= base_url('booking/send') ?>', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: new FormData(form)
        })
        .then(res => res.json())
        .then(data => {
            submitBtn.classList.remove('btn-loading');
            submitBtn.disabled = false;

            if (data.status) {
                document.getElementById('booking-flow').style.display = 'none';
                document.getElementById('summary-date').innerText = displayDate.innerText;
                document.getElementById('summary-time').innerText = selectedTimeStr;
                document.getElementById('success-card').style.display = 'block';
                
                // Add to local cache
                const newSlotKey = `${inputDate.value}_${inputTime.value}`;
                bookedSlots.push(newSlotKey);
            } else {
                if (data.errors) {
                    for (const [key, msg] of Object.entries(data.errors)) {
                        const errEl = document.getElementById('err-' + key);
                        if (errEl) errEl.innerText = msg;
                    }
                }
            }
        })
        .catch(err => {
            submitBtn.classList.remove('btn-loading');
            submitBtn.disabled = false;
            document.getElementById('err-server').innerText = 'An unexpected error occurred.';
            console.error(err);
        });
    });
});
</script>
</body>
</html>
