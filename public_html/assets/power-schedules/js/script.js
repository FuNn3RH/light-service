const locationBtns = document.querySelectorAll('.location-btn')
const scheduleTable = document.querySelector('.schedule-table');

let activeNotifs = getLocalStorage('active_notifs') || [];
const notifCheckbox = document.getElementById('notif');
const notifLabel = document.getElementById('notif-label');
const notifContainer = document.getElementById('notif-container');
const message = document.getElementById('message')
let today = null;

const param = new URLSearchParams(location.search)
if (param.size > 0) {
    if (param.get('bill_id')) {
        locationBtns.forEach(btn => {
            if (btn.dataset.name.trim() == param.get('bill_id')) {
                btn.classList.add('active-state')
            }
        })
    }

}

async function getReports(billName) {

    try {
        const request = await fetch(url + `?bill_name=${billName}`);
        return request;
    } catch (error) {
        return null;
    }
}

const days = {
    "sunday": 'یک شنبه',
    "monday": 'دوشنبه',
    "tuesday": 'سه شنبه',
    "wednesday": 'چهارشنبه',
    "thursday": 'پنج شنبه',
    "friday": 'جمعه',
    "saturday": 'شنبه',
}

function translateDays(item) {
    return days[item] || item;
}

function getToday() {
    const now = new Date();
    const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    return now.toLocaleDateString('fa-IR', options);
}

async function renderReports(reports, btn) {
    today = getToday();

    scheduleTable.innerHTML = ''

    notifCheckbox.name = btn.dataset.engname
    notifLabel.innerHTML = '🔔 ' + btn.dataset.name

    notifCheckbox.checked = activeNotifs.includes(notifCheckbox.name)

    notifContainer.classList.remove('d-none');
    scheduleTable.classList.remove('d-none');

    if (!reports && !reports?.data) {
        scheduleTable.innerHTML = "<h3 style='text-align:center'>در حال حاضر اطلاعاتی وجود ندارد</h3>"
    } else {

        for (const key in reports) {
            const date = reports[key].date;

            scheduleTable.insertAdjacentHTML('beforeend', `

                <div class="row schedule-row ${isToday(date) ? 'today' : ''}">

                    <div class="col-4 schedule-cell">
                        ${translateDays(key)}
                    </div>

                    <div class="col-4 schedule-cell">
                        ${reports[key].date}
                    </div>

                   <div class="col-4 schedule-cell time-cell ${reports[key].time && reports[key].time.length ? 'text-danger' : ''}">
                          ${reports[key].time.length >= 1 ? reports[key].time.map(time => `<span>${time}</span>`).join('') : 'تعیین نشده'}
                    </div>
                </div>

            `)
        }
    }

    activateLocationBtn(btn)
}

function isToday(date) {
    return date == today;
}

locationBtns.forEach(btn => {
    btn.addEventListener('click', handleClick);
});

async function handleClick() {

    scheduleTable.innerHTML = "<h3 class='p-2 text-center'>درحال دریافت اطلاعات</h3>"
    notifContainer.classList.add('d-none')
    message.classList.add('d-none')

    if (!navigator.onLine) {
        handleOfflineState(this.dataset.engname, this)
    }

    deactiveBtns.call(this);
    this.classList.add('active-state');

    const request = await getReports(this.dataset.engname);


    if (request && request.status === 200) {
        const data = await request.json();
        const reportsData = data.data;

        renderReports(reportsData, this);
        updateReportsStorage(this.dataset.engname, reportsData);
    } else {
        handleOfflineState(this.dataset.engname, this)
    }
}

function activateLocationBtn(btn) {
    deactiveBtns();
    btn.classList.add('active-state');
    setLocalStorage('active-location-btn', btn.dataset.engname);
}

function handleOfflineState(billName, btn) {
    message.classList.remove('d-none')
    const report = allReports.find(report => report.billName == billName)
    renderReports(report?.data, btn);
}

function deactiveBtns() {
    locationBtns.forEach(btn => {
        btn.classList.remove('active-state')
    })
}

function setLocalStorage(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

function getLocalStorage(key) {
    const value = localStorage.getItem(key);
    return value ? JSON.parse(value) : null;
}

function updateReportsStorage(billName, billReports) {
    const existingBill = allReports.find(report => report.billName === billName);
    if (existingBill) {
        allReports = allReports.filter(report => report.billName !== billName);
    }

    allReports.push({ billName, data: billReports });

    setLocalStorage('power-reports', allReports);
}

let allReports = getLocalStorage('power-reports') || [];
const activeLocationBtn = getLocalStorage('active-location-btn') || null;
if (activeLocationBtn) {
    locationBtns.forEach(btn => {
        if (btn.dataset.engname.trim() == activeLocationBtn) {
            btn.classList.add('active-state');
            btn.click()
            updateScroll();
        }
    });
}

async function sendSubscription(data) {
    if (await requestPermission()) {

        const subscription = await sw.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(publicVapidKey)
        });

        await fetch('subscribe', {
            method: 'POST',
            body: JSON.stringify({ subscription, data }),
            headers: { 'Content-Type': 'application/json' }
        });

    }
}

async function requestPermission() {
    const permission = await Notification.requestPermission();

    if (permission !== 'granted') {
        return false;
    }
    return true;
}

async function handleNotificationChange(el) {
    if (activeNotifs.includes(el.name)) {
        activeNotifs = activeNotifs.filter(a => a !== el.name)
    } else {
        activeNotifs.push(el.name)
    }

    setLocalStorage('active_notifs', activeNotifs)

    await sendSubscription(activeNotifs);
}

function updateScroll() {
    const activeBtn = document.querySelector('.location-btn.active-state');
    if (activeBtn) {
        const container = document.querySelector('.location-btn-wrapper');
        container.scrollLeft = activeBtn.getBoundingClientRect().left - container.getBoundingClientRect().left;
    }
}
