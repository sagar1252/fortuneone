<style>
    /* Base Modal */
    .booking-modal-overlay {
        position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
        background: rgba(26, 37, 48, 0.85); z-index: 999999;
        display: none; align-items: center; justify-content: center;
        opacity: 0; transition: opacity 0.3s ease; backdrop-filter: blur(5px);
        font-family: 'DM Sans', sans-serif;
    }
    .booking-modal-overlay.active { display: flex; opacity: 1; }
    
    .bm-wrapper {
        display: flex; flex-direction: column; width: 95%; max-width: 1050px;
        transform: translateY(20px); transition: transform 0.3s ease;
    }
    .booking-modal-overlay.active .bm-wrapper { transform: translateY(0); }

    /* Header above card */
    .bm-top-bar {
        background: #1A2530; color: #ffffff; text-align: center; padding: 15px;
        border-top-left-radius: 12px; border-top-right-radius: 12px;
        font-size: 14px; font-weight: 400; position: relative;
    }
    .bm-top-bar strong { font-weight: 600; color: #D4A574;}
    .bm-close {
        position: absolute; top: 12px; right: 20px; font-size: 28px;
        cursor: pointer; color: #ffffff; line-height: 1; transition: color 0.2s;
    }
    .bm-close:hover { color: #D4A574; }

    /* Card Body */
    .booking-modal-card {
        background: #ffffff; display: flex; flex-direction: row;
        border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3); overflow: hidden;
        min-height: 520px;
    }

    /* Columns */
    .bm-col-left {
        width: 30%; padding: 40px 30px; border-right: 1px solid #eaeaea;
        background: #ffffff;
    }
    .bm-col-mid {
        width: 45%; padding: 40px 30px; border-right: 1px solid #eaeaea;
        display: flex; flex-direction: column;
    }
    .bm-col-right {
        width: 25%; padding: 40px 20px; max-height: 520px; overflow-y: auto;
    }

    @media(max-width: 850px) {
        .booking-modal-overlay {
            align-items: flex-start;
            overflow-y: auto;
            padding: 20px 0;
            display: none; /* JS toggles active which is flex */
        }
        .booking-modal-overlay.active {
            display: flex !important;
        }
        .bm-wrapper {
            margin: auto;
            width: 92%;
            max-width: 480px;
        }
        .booking-modal-card {
            flex-direction: column;
            max-height: none;
            min-height: auto;
        }
        .bm-col-left, .bm-col-mid, .bm-col-right {
            width: 100%;
            border-right: none;
            border-bottom: 1px solid #eaeaea;
            max-height: none;
        }
        
        /* Compact left column for mobile */
        .bm-col-left {
            padding: 25px 20px 20px;
            text-align: center;
        }
        .bm-logo-box {
            margin: 0 auto 15px;
            width: 50px;
            height: 50px;
        }
        .bm-logo-box img {
            max-width: 30px;
        }
        .bm-meeting-title {
            font-size: 22px;
            margin-bottom: 15px;
        }
        .bm-detail-row {
            justify-content: center;
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        /* Compact mid column for mobile */
        .bm-col-mid {
            padding: 25px 20px;
        }
        .bm-cal-grid {
            gap: 6px;
        }
        .bm-day {
            font-size: 14px;
        }
        
        /* Compact right column for mobile */
        .bm-col-right {
            padding: 25px 20px;
        }

        /* Compact form area & success card for mobile */
        .bm-form-area, .bm-success {
            width: 100% !important;
            padding: 30px 20px !important;
            max-height: none !important;
            overflow-y: visible !important;
        }
    }

    /* Left Details */
    .bm-logo-box {
        width: 60px; height: 60px; border-radius: 50%; background: #1A2530;
        display: flex; align-items: center; justify-content: center; margin-bottom: 20px;
    }
    .bm-logo-box img { max-width: 40px; filter: brightness(0) invert(1); }
    .bm-host-name { font-size: 14px; color: #666; margin-bottom: 5px; font-weight: 500; }
    .bm-meeting-title { font-size: 24px; font-weight: bold; color: #1A2530; margin-bottom: 30px; line-height: 1.2; font-family: 'Cormorant Garamond', serif;}
    .bm-detail-row { display: flex; align-items: center; font-size: 15px; color: #444; margin-bottom: 15px; font-weight: 500;}
    .bm-detail-row svg { margin-right: 12px; width: 20px; height: 20px; color: #666; }
    .gmeet-icon { width: 20px; height: 20px; margin-right: 12px; }

    /* Middle Calendar */
    .bm-cal-title { text-align: center; color: #888; font-size: 13px; font-weight: 600; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px;}
    .bm-cal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .bm-month-year { font-size: 18px; font-weight: bold; color: #1A2530; }
    .bm-cal-nav { cursor: pointer; color: #9E693D; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: #F5F3F0; transition: 0.2s;}
    .bm-cal-nav:hover { background: #e8e4dc; }
    
    .bm-cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 8px; text-align: center; margin-bottom: auto;}
    .bm-day-hdr { font-size: 12px; color: #666; font-weight: 600; margin-bottom: 10px; }
    .bm-day {
        aspect-ratio: 1; display: flex; align-items: center; justify-content: center;
        border-radius: 50%; cursor: pointer; transition: all 0.2s; font-size: 14px; font-weight: 500; color: #1A2530;
        background: #f9f9f9;
    }
    .bm-day:not(.disabled):not(.selected):not(.empty):hover { background: #F5F3F0; color: #9E693D; }
    .bm-day.today { border: 1px solid #9E693D; color: #9E693D; background: transparent; }
    .bm-day.selected { background: #1A2530; color: white; border-color: #1A2530; }
    .bm-day.disabled { color: #ccc; cursor: not-allowed; background: transparent; }
    .bm-day.empty { background: transparent; cursor: default; }

    .bm-timezone { margin-top: 30px; text-align: center; font-size: 13px; color: #666; display: flex; align-items: center; justify-content: center; }
    .bm-timezone svg { width: 16px; height: 16px; margin-right: 8px; }

    /* Right Timeslots */
    .bm-slot-title { text-align: center; color: #1A2530; font-size: 16px; font-weight: bold; margin-bottom: 20px; }
    .bm-time-list { display: flex; flex-direction: column; gap: 12px; }
    .bm-time-pill {
        border: 1px solid #9E693D; color: #9E693D; background: white;
        padding: 12px; text-align: center; border-radius: 6px; font-size: 15px; cursor: pointer; transition: 0.2s; font-weight: 600;
    }
    .bm-time-pill:hover { background: #9E693D; color: white;}

    /* Form Section (Takes up Mid & Right space) */
    .bm-form-area { width: 70%; padding: 40px 50px; display: none; overflow-y: auto; max-height: 520px; position: relative;}
    @media(max-width: 850px) { .bm-form-area { width: 100%; padding: 30px 20px; } }
    
    .bm-form-header { margin-bottom: 25px; display: flex; align-items: center; }
    .bm-back-btn { cursor: pointer; color: #1A2530; width: 36px; height: 36px; border: 1px solid #e0e0e0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; transition: 0.2s;}
    .bm-back-btn:hover { background: #f0f0f0; }
    .bm-form-title { font-size: 22px; font-weight: bold; color: #1A2530; }
    
    .bm-form-group { margin-bottom: 18px; }
    .bm-form-group label { display: block; margin-bottom: 6px; font-size: 13px; font-weight: 600; color: #444; }
    .bm-input {
        width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; font-family: inherit;
        background: #f9f9f9; box-sizing: border-box; font-size: 14px;
    }
    .bm-input:focus { outline: none; border-color: #9E693D; background: white;}
    .bm-btn {
        width: 100%; padding: 14px; background: #1A2530; color: white; border: none; border-radius: 6px;
        font-family: inherit; font-weight: 600; cursor: pointer; transition: 0.3s; font-size: 15px; margin-top: 10px;
    }
    .bm-btn:hover { background: #9E693D; }
    .bm-btn:disabled { opacity: 0.6; cursor: wait; }
    .bm-error { color: #d32f2f; font-size: 12px; margin-top: 5px; }

    /* Success */
    .bm-success { text-align: center; padding: 60px 40px; display: none; width: 70%; align-items: center; justify-content: center; flex-direction: column;}
    @media(max-width: 850px) { .bm-success { width: 100%; padding: 40px 20px; } }
    .bm-success h3 { font-family: 'Cormorant Garamond', serif; font-size: 32px; color: #1A2530; margin-bottom: 15px; }
    .bm-success p { color: #666; margin-bottom: 30px; font-size: 16px; line-height: 1.5; }
    .bm-success svg { width: 60px; height: 60px; color: #4CAF50; margin-bottom: 20px; }
    
    /* Alert */
    #bm-slot-alert {
        display:none; background:#1A2530; color:#D4A574; padding:15px; border-radius:6px; margin-bottom:20px; text-align:center; font-weight:bold; border: 1px solid #D4A574; box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    
    /* Custom scrollbar for right panel */
    .bm-col-right::-webkit-scrollbar { width: 6px; }
    .bm-col-right::-webkit-scrollbar-track { background: transparent; }
    .bm-col-right::-webkit-scrollbar-thumb { background: #e0e0e0; border-radius: 10px; }
</style>

<div class="booking-modal-overlay" id="bookingModal">
    <div class="bm-wrapper">
        <div class="bm-top-bar">
            Powered by <strong>Fortune One Bookings</strong>
            <div class="bm-close" onclick="closeBookingModal()">&times;</div>
        </div>
        
        <div class="booking-modal-card">
            
            <!-- Left Column: Details -->
            <div class="bm-col-left" id="bm-col-left">
                <div class="bm-logo-box">
                    <img src="<?= base_url('assets/website/images/logo.png') ?>" alt="Logo">
                </div>
                <div class="bm-host-name">Fortune One</div>
                <div class="bm-meeting-title">Fortune One Meeting</div>
                
                <div class="bm-detail-row" style="margin-top: 30px;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    30 min
                </div>
                <div class="bm-detail-row">
                    <!-- Google Meet Icon SVG -->
                    <svg class="gmeet-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M21.1306 7.85292L17.7061 5.92646C17.0754 5.57161 16.2877 6.02742 16.2877 6.75338V10.2877H13.7123V5.28766C13.7123 4.18309 12.8169 3.28766 11.7123 3.28766H5.71234C4.60777 3.28766 3.71234 4.18309 3.71234 5.28766V18.7123C3.71234 19.8169 4.60777 20.7123 5.71234 20.7123H11.7123C12.8169 20.7123 13.7123 19.8169 13.7123 18.7123V13.7123H16.2877V17.2466C16.2877 17.9726 17.0754 18.4284 17.7061 18.0735L21.1306 16.1471C21.6705 15.8434 22.0001 15.2638 22.0001 14.6466V9.35338C22.0001 8.73616 21.6705 8.15657 21.1306 7.85292ZM11.7123 18.7123H5.71234V5.28766H11.7123V18.7123Z" fill="#00832D"/>
                        <path d="M12.5684 9.14441L15.424 7.50005V16.5001L12.5684 14.8557V9.14441Z" fill="#0066DA"/>
                        <path d="M5.71234 10.7123H8.71234V13.7123H5.71234V10.7123Z" fill="#EA4335"/>
                        <path d="M8.71234 10.7123H11.7123V13.7123H8.71234V10.7123Z" fill="#FBBC04"/>
                    </svg>
                    Google meet
                </div>
            </div>

            <!-- Middle Column: Calendar -->
            <div class="bm-col-mid" id="bm-col-mid">
                <div class="bm-cal-title">Select Date</div>
                <div class="bm-cal-header">
                    <span class="bm-cal-nav" id="bm-prev-month">&larr;</span>
                    <span class="bm-month-year" id="bm-month-year"></span>
                    <span class="bm-cal-nav" id="bm-next-month">&rarr;</span>
                </div>
                <div class="bm-cal-grid">
                    <div class="bm-day-hdr">SU</div><div class="bm-day-hdr">MO</div><div class="bm-day-hdr">TU</div>
                    <div class="bm-day-hdr">WE</div><div class="bm-day-hdr">TH</div><div class="bm-day-hdr">FR</div><div class="bm-day-hdr">SA</div>
                </div>
                <div class="bm-cal-grid" id="bm-calendar-days"></div>
                
                <div class="bm-timezone">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                    <span id="bm-tz-text">Asia/Kolkata</span>
                </div>
            </div>

            <!-- Right Column: Time Slots -->
            <div class="bm-col-right" id="bm-col-right" style="display: none;">
                <div style="display: flex; align-items: center; justify-content: center; position: relative; margin-bottom: 20px;">
                    <div class="bm-back-btn" id="bm-back-to-cal" onclick="goBackToCalFromTimes()" style="position: absolute; left: 0; margin-right: 0; display: none;">&larr;</div>
                    <div class="bm-slot-title" id="bm-slot-title" style="margin-bottom: 0;">Select slot</div>
                </div>
                <div class="bm-time-list" id="bm-time-slots"></div>
            </div>

            <!-- Form Area (Replaces Mid & Right) -->
            <div class="bm-form-area" id="bm-form-sec">
                <div id="bm-slot-alert">
                    This time slot is already booked. Please choose a different slot.
                </div>
                
                <div class="bm-form-header">
                    <div class="bm-back-btn" onclick="goBackToCalendar()">&larr;</div>
                    <div class="bm-form-title">Enter Details</div>
                </div>
                
                <div class="bm-detail-row" style="margin-bottom: 20px;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span id="bm-final-dt-text" style="color: #9E693D; font-weight: bold;"></span>
                </div>

                <form id="bm-form">
                    <?= csrf_field() ?>
                    <input type="hidden" id="bm_selected_date" name="selected_date">
                    <input type="hidden" id="bm_selected_time" name="selected_time">
                    
                    <div class="bm-form-group">
                        <label>Full Name *</label>
                        <input type="text" class="bm-input" name="full_name" required>
                        <div class="bm-error" id="err-full_name"></div>
                    </div>
                    <div class="bm-form-group">
                        <label>Email Address *</label>
                        <input type="email" class="bm-input" name="email" required>
                        <div class="bm-error" id="err-email"></div>
                    </div>
                    <div class="bm-form-group">
                        <label>Phone Number</label>
                        <input type="tel" class="bm-input" name="phone">
                        <div class="bm-error" id="err-phone"></div>
                    </div>
                    <div class="bm-form-group">
                        <label>Please share anything that will help prepare for our meeting.</label>
                        <textarea class="bm-input" name="message" rows="3"></textarea>
                        <div class="bm-error" id="err-message"></div>
                    </div>
                    
                    <button type="submit" class="bm-btn" id="bm-submit">Schedule Event</button>
                    <div class="bm-error" id="err-server" style="text-align:center; margin-top:10px;"></div>
                </form>
            </div>

            <!-- Success Card -->
            <div class="bm-success" id="bm-success-card">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                <h3>You are scheduled</h3>
                <p>A calendar invitation has been sent to your email address with the Google Meet link.</p>
                <button class="bm-btn" style="width:auto; padding: 12px 40px;" onclick="closeBookingModal()">Done</button>
            </div>

        </div>
    </div>
</div>

<script>
function openBookingModal() {
    document.getElementById('bookingModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeBookingModal() {
    document.getElementById('bookingModal').classList.remove('active');
    document.body.style.overflow = '';
}
function goBackToCalendar() {
    document.getElementById('bm-form-sec').style.display = 'none';
    document.getElementById('bm-col-right').style.display = 'block';
    
    if (window.innerWidth <= 850) {
        document.getElementById('bm-col-left').style.display = 'none';
        document.getElementById('bm-col-mid').style.display = 'none';
        document.getElementById('bm-back-to-cal').style.display = 'flex';
    } else {
        document.getElementById('bm-col-left').style.display = 'block';
        document.getElementById('bm-col-mid').style.display = 'flex';
        document.getElementById('bm-back-to-cal').style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Set Timezone
    try {
        const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
        document.getElementById('bm-tz-text').innerText = tz;
    } catch(e) {}

    let currDate = new Date();
    let selDateObj = null;
    let selTimeStr = null;
    let bookedSlots = [];

    // Fetch booked slots
    fetch('<?= base_url('booking/slots') ?>')
        .then(r => r.json())
        .then(d => {
            if (d.status) bookedSlots = d.booked_slots || [];
        })
        .catch(e => console.error("Could not load booked slots", e));

    const mNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const calDays = document.getElementById('bm-calendar-days');
    const mYear = document.getElementById('bm-month-year');
    
    function renderCal(date) {
        calDays.innerHTML = '';
        const y = date.getFullYear();
        const m = date.getMonth();
        mYear.innerText = `${mNames[m]} ${y}`;
        
        const fDay = new Date(y, m, 1).getDay();
        const dInM = new Date(y, m + 1, 0).getDate();
        const today = new Date();
        today.setHours(0,0,0,0);

        let firstValidDate = null;
        let firstValidEl = null;

        for(let i=0; i<fDay; i++) {
            let d = document.createElement('div'); d.className = 'bm-day empty'; calDays.appendChild(d);
        }
        for(let i=1; i<=dInM; i++) {
            let d = document.createElement('div'); d.className = 'bm-day'; d.innerText = i;
            let cDate = new Date(y, m, i); cDate.setHours(0,0,0,0);
            
            if(cDate.getTime() === today.getTime()) d.classList.add('today');
            
            if(cDate < today) {
                d.classList.add('disabled');
            } else {
                d.addEventListener('click', () => selectD(cDate, d));
                if (!firstValidDate && !selDateObj) {
                    firstValidDate = cDate;
                    firstValidEl = d;
                }
            }
            
            if(selDateObj && cDate.getTime() === selDateObj.getTime()) d.classList.add('selected');
            calDays.appendChild(d);
        }

        if (!selDateObj && firstValidDate && firstValidEl) {
            // Only auto-select on desktop, where both panels are visible
            if (window.innerWidth > 850) {
                selectD(firstValidDate, firstValidEl);
            }
        }
    }

    function selectD(date, el) {
        document.querySelectorAll('.bm-day').forEach(e => e.classList.remove('selected'));
        el.classList.add('selected');
        selDateObj = date;
        document.getElementById('bm_selected_date').value = `${date.getFullYear()}-${String(date.getMonth()+1).padStart(2,'0')}-${String(date.getDate()).padStart(2,'0')}`;
        
        selTimeStr = null;
        document.getElementById('bm_selected_time').value = '';
        
        const rightCol = document.getElementById('bm-col-right');
        rightCol.style.display = 'block';
        renderTimes(date);
        
        // Mobile flow: Swap views instead of scrolling
        if (window.innerWidth <= 850) {
            document.getElementById('bm-col-left').style.display = 'none';
            document.getElementById('bm-col-mid').style.display = 'none';
            document.getElementById('bm-back-to-cal').style.display = 'flex';
        } else {
            document.getElementById('bm-back-to-cal').style.display = 'none';
        }
    }
    
    window.goBackToCalFromTimes = function() {
        document.getElementById('bm-col-right').style.display = 'none';
        document.getElementById('bm-col-left').style.display = 'block';
        document.getElementById('bm-col-mid').style.display = 'flex';
    };

    function renderTimes(date) {
        const tCont = document.getElementById('bm-time-slots');
        tCont.innerHTML = '';
        
        // Show selected date in the title
        document.getElementById('bm-slot-title').innerHTML = `Select slot<br><span style="font-size:13px; color:#666; font-weight:500;">${date.toLocaleString('default', { weekday: 'short' })}, ${String(date.getDate()).padStart(2,'0')} ${mNames[date.getMonth()].substring(0,3)}'${date.getFullYear()}</span>`;

        const times = [];
        const now = new Date();
        const isToday = date.getFullYear() === now.getFullYear() && 
                        date.getMonth() === now.getMonth() && 
                        date.getDate() === now.getDate();

        for(let h=9; h<=17; h++) {
            let ampm = h>=12 ? 'pm':'am'; let dh = h>12 ? h-12 : h;
            
            // 00 minute slot
            if (!isToday || (h > now.getHours() || (h === now.getHours() && 0 > now.getMinutes()))) {
                times.push(`${String(dh).padStart(2,'0')}:00 ${ampm}`); 
            }
            
            // 30 minute slot
            if(h!==17) {
                if (!isToday || (h > now.getHours() || (h === now.getHours() && 30 > now.getMinutes()))) {
                    times.push(`${String(dh).padStart(2,'0')}:30 ${ampm}`);
                }
            }
        }
        
        const dateStr = `${date.getFullYear()}-${String(date.getMonth()+1).padStart(2,'0')}-${String(date.getDate()).padStart(2,'0')}`;
        
        times.forEach(t => {
            let p = document.createElement('div'); p.className = 'bm-time-pill'; p.innerText = t;
            const slotKey = `${dateStr}_${t}`;
            
            if (bookedSlots.includes(slotKey)) {
                p.classList.add('disabled');
                p.style.opacity = '0.5';
                p.style.cursor = 'not-allowed';
                p.style.backgroundColor = '#f5f5f5';
                p.style.borderColor = '#ccc';
                p.style.color = '#888';
                p.innerText = `${t} (Booked)`;
            } else {
                p.addEventListener('click', () => {
                    document.querySelectorAll('.bm-time-pill').forEach(e => e.classList.remove('selected'));
                    p.classList.add('selected');
                    selTimeStr = t;
                    document.getElementById('bm_selected_time').value = t;
                    
                    // Set final text
                    document.getElementById('bm-final-dt-text').innerText = `${t} - ${mNames[date.getMonth()]} ${date.getDate()}, ${date.getFullYear()}`;
                    
                    // Hide Cal/Times, Show Form
                    document.getElementById('bm-col-left').style.display = 'none';
                    document.getElementById('bm-col-mid').style.display = 'none';
                    document.getElementById('bm-col-right').style.display = 'none';
                    document.getElementById('bm-form-sec').style.display = 'block';
                });
            }
            tCont.appendChild(p);
        });
    }

    document.getElementById('bm-prev-month').addEventListener('click', () => { currDate.setMonth(currDate.getMonth()-1); renderCal(currDate); });
    document.getElementById('bm-next-month').addEventListener('click', () => { currDate.setMonth(currDate.getMonth()+1); renderCal(currDate); });
    renderCal(currDate);

    // Form Submit
    const frm = document.getElementById('bm-form');
    const btn = document.getElementById('bm-submit');
    frm.addEventListener('submit', (e) => {
        e.preventDefault();
        document.querySelectorAll('.bm-error').forEach(e => e.innerText = '');
        btn.innerText = 'Scheduling...'; btn.disabled = true;

        fetch('<?= base_url('booking/send') ?>', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: new FormData(frm)
        })
        .then(r => r.json())
        .then(d => {
            document.getElementById('bm-slot-alert').style.display = 'none';
            btn.innerText = 'Schedule Event'; btn.disabled = false;
            if(d.status) {
                document.getElementById('bm-form-sec').style.display = 'none';
                document.getElementById('bm-col-left').style.display = 'none';
                document.getElementById('bm-success-card').style.display = 'flex';
                
                // Notify AI if active
                if (typeof sendAiMessage === 'function') {
                    const dVal = document.getElementById('bm_selected_date').value;
                    const tVal = document.getElementById('bm_selected_time').value;
                    sendAiMessage(`[SYSTEM: Booking successful for ${dVal} at ${tVal}]`);
                }
                
                // Add to local booked slots cache so it updates immediately
                const newSlotKey = `${document.getElementById('bm_selected_date').value}_${document.getElementById('bm_selected_time').value}`;
                bookedSlots.push(newSlotKey);
                
                frm.reset();
            } else {
                if(d.error_type === 'slot_full') {
                    document.getElementById('bm-slot-alert').style.display = 'block';
                    document.getElementById('bm-form-sec').scrollIntoView({behavior: "smooth"});
                } else if(d.errors) {
                    for(const [k, v] of Object.entries(d.errors)) {
                        let el = document.getElementById('err-'+k);
                        if(el) el.innerText = v;
                    }
                }
            }
        })
        .catch(err => {
            btn.innerText = 'Schedule Event'; btn.disabled = false;
            document.getElementById('err-server').innerText = 'An error occurred. Please try again.';
        });
    });
});
</script>
