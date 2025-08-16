// Global variables
let currentStep = 1
let selectedDate = ""
let selectedTime = ""
let currentMonth = new Date()
let selectedDayElement = null
let guestCount = 0
let calendarShrunk = false
let timeFormat = "24h"
let isTimezoneDropdownOpen = false

// Phone validation variables
let selectedCountryCode = "+91"
let selectedCountryFlag = "in"
let requiredPhoneLength = 10

const monthNames = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
]

// Base timezone and business hours (24 hours available)
const baseTimezone = "UTC"
const slotDuration = 30 // 30 minutes per slot

// Global timezone variables
let selectedTimezoneDisplay = "India Standard Time"
let selectedTimezoneValue = "Asia/Kolkata"
let allTimezones = []

// Cookie preferences
const cookiePreferences = {
  functional: true,
  performance: true,
  targeting: true,
}

// Complete timezone data with all major timezones
const timezoneData = {
  AFRICA: [
    { name: "Abidjan Time", value: "Africa/Abidjan" },
    { name: "Accra Time", value: "Africa/Accra" },
    { name: "Addis Ababa Time", value: "Africa/Addis_Ababa" },
    { name: "Algiers Time", value: "Africa/Algiers" },
    { name: "Cairo Time", value: "Africa/Cairo" },
    { name: "Cape Town Time", value: "Africa/Cape_Town" },
    { name: "Casablanca Time", value: "Africa/Casablanca" },
    { name: "Dar es Salaam Time", value: "Africa/Dar_es_Salaam" },
    { name: "Johannesburg Time", value: "Africa/Johannesburg" },
    { name: "Lagos Time", value: "Africa/Lagos" },
    { name: "Nairobi Time", value: "Africa/Nairobi" },
    { name: "Tunis Time", value: "Africa/Tunis" },
  ],
  ASIA: [
    { name: "Almaty Time", value: "Asia/Almaty" },
    { name: "Baghdad Time", value: "Asia/Baghdad" },
    { name: "Baku Time", value: "Asia/Baku" },
    { name: "Bangkok Time", value: "Asia/Bangkok" },
    { name: "Beijing Time", value: "Asia/Shanghai" },
    { name: "Colombo Time", value: "Asia/Colombo" },
    { name: "Damascus Time", value: "Asia/Damascus" },
    { name: "Dhaka Time", value: "Asia/Dhaka" },
    { name: "Dubai Time", value: "Asia/Dubai" },
    { name: "Hong Kong Time", value: "Asia/Hong_Kong" },
    { name: "India Standard Time", value: "Asia/Kolkata" },
    { name: "Jakarta Time", value: "Asia/Jakarta" },
    { name: "Japan Standard Time", value: "Asia/Tokyo" },
    { name: "Karachi Time", value: "Asia/Karachi" },
    { name: "Kathmandu Time", value: "Asia/Kathmandu" },
    { name: "Kuala Lumpur Time", value: "Asia/Kuala_Lumpur" },
    { name: "Kuwait Time", value: "Asia/Kuwait" },
    { name: "Manila Time", value: "Asia/Manila" },
    { name: "Riyadh Time", value: "Asia/Riyadh" },
    { name: "Seoul Time", value: "Asia/Seoul" },
    { name: "Singapore Time", value: "Asia/Singapore" },
    { name: "Taipei Time", value: "Asia/Taipei" },
    { name: "Tashkent Time", value: "Asia/Tashkent" },
    { name: "Tehran Time", value: "Asia/Tehran" },
    { name: "Yerevan Time", value: "Asia/Yerevan" },
  ],
  ATLANTIC: [
    { name: "Azores Time", value: "Atlantic/Azores" },
    { name: "Bermuda Time", value: "Atlantic/Bermuda" },
    { name: "Canary Time", value: "Atlantic/Canary" },
    { name: "Cape Verde Time", value: "Atlantic/Cape_Verde" },
    { name: "Reykjavik Time", value: "Atlantic/Reykjavik" },
  ],
  AUSTRALIA: [
    { name: "Adelaide Time", value: "Australia/Adelaide" },
    { name: "Brisbane Time", value: "Australia/Brisbane" },
    { name: "Darwin Time", value: "Australia/Darwin" },
    { name: "Melbourne Time", value: "Australia/Melbourne" },
    { name: "Perth Time", value: "Australia/Perth" },
    { name: "Sydney Time", value: "Australia/Sydney" },
  ],
  EUROPE: [
    { name: "Amsterdam Time", value: "Europe/Amsterdam" },
    { name: "Athens Time", value: "Europe/Athens" },
    { name: "Berlin Time", value: "Europe/Berlin" },
    { name: "Brussels Time", value: "Europe/Brussels" },
    { name: "Bucharest Time", value: "Europe/Bucharest" },
    { name: "Budapest Time", value: "Europe/Budapest" },
    { name: "Copenhagen Time", value: "Europe/Copenhagen" },
    { name: "Dublin Time", value: "Europe/Dublin" },
    { name: "Helsinki Time", value: "Europe/Helsinki" },
    { name: "Istanbul Time", value: "Europe/Istanbul" },
    { name: "Kiev Time", value: "Europe/Kiev" },
    { name: "Lisbon Time", value: "Europe/Lisbon" },
    { name: "London Time", value: "Europe/London" },
    { name: "Madrid Time", value: "Europe/Madrid" },
    { name: "Moscow Time", value: "Europe/Moscow" },
    { name: "Oslo Time", value: "Europe/Oslo" },
    { name: "Paris Time", value: "Europe/Paris" },
    { name: "Prague Time", value: "Europe/Prague" },
    { name: "Rome Time", value: "Europe/Rome" },
    { name: "Stockholm Time", value: "Europe/Stockholm" },
    { name: "Vienna Time", value: "Europe/Vienna" },
    { name: "Warsaw Time", value: "Europe/Warsaw" },
    { name: "Zurich Time", value: "Europe/Zurich" },
  ],
  "NORTH AMERICA": [
    { name: "Alaska Time", value: "America/Anchorage" },
    { name: "Central Time", value: "America/Chicago" },
    { name: "Eastern Time", value: "America/New_York" },
    { name: "Hawaii Time", value: "Pacific/Honolulu" },
    { name: "Mountain Time", value: "America/Denver" },
    { name: "Pacific Time", value: "America/Los_Angeles" },
    { name: "Phoenix Time", value: "America/Phoenix" },
    { name: "Toronto Time", value: "America/Toronto" },
    { name: "Vancouver Time", value: "America/Vancouver" },
    { name: "Mexico City Time", value: "America/Mexico_City" },
    { name: "Monterrey Time", value: "America/Monterrey" },
  ],
  "SOUTH AMERICA": [
    { name: "Argentina Time", value: "America/Argentina/Buenos_Aires" },
    { name: "Bolivia Time", value: "America/La_Paz" },
    { name: "Brazil Time", value: "America/Sao_Paulo" },
    { name: "Chile Time", value: "America/Santiago" },
    { name: "Colombia Time", value: "America/Bogota" },
    { name: "Ecuador Time", value: "America/Guayaquil" },
    { name: "Paraguay Time", value: "America/Asuncion" },
    { name: "Peru Time", value: "America/Lima" },
    { name: "Uruguay Time", value: "America/Montevideo" },
    { name: "Venezuela Time", value: "America/Caracas" },
  ],
  PACIFIC: [
    { name: "Auckland Time", value: "Pacific/Auckland" },
    { name: "Fiji Time", value: "Pacific/Fiji" },
    { name: "Guam Time", value: "Pacific/Guam" },
    { name: "Samoa Time", value: "Pacific/Apia" },
    { name: "Tahiti Time", value: "Pacific/Tahiti" },
    { name: "Tonga Time", value: "Pacific/Tongatapu" },
  ],
}

// Generate 24-hour time slots (12:00 AM to 11:30 PM)
function generate24HourTimeSlots() {
  const slots = []

  // Start from 00:00 (12:00 AM) and go till 23:30 (11:30 PM)
  for (let hour = 0; hour < 24; hour++) {
    for (let minute = 0; minute < 60; minute += slotDuration) {
      const formattedHour = hour.toString().padStart(2, "0")
      const formattedMinute = minute.toString().padStart(2, "0")
      const timeSlot = `${formattedHour}:${formattedMinute}`
      slots.push(timeSlot)
    }
  }

  return slots
}

// Convert 24h time to 12h format
function convertTo12h(time24) {
  const [hours, minutes] = time24.split(":")
  const hour = Number.parseInt(hours)
  const ampm = hour >= 12 ? "PM" : "AM"
  const hour12 = hour === 0 ? 12 : hour > 12 ? hour - 12 : hour
  return `${hour12}:${minutes} ${ampm}`
}

// Get current time slots based on format and timezone
function getCurrentTimeSlots() {
  const allSlots = generate24HourTimeSlots()

  return allSlots.map((time) => {
    return timeFormat === "12h" ? convertTo12h(time) : time
  })
}

// New Country selection functionality
function initializeCountrySelector() {
  const countryItems = document.querySelectorAll(".country-item")

  countryItems.forEach((item) => {
    item.addEventListener("click", function () {
      const country = this.getAttribute("data-country")
      const code = this.getAttribute("data-code")
      const length = Number.parseInt(this.getAttribute("data-length"))

      // Update selected country
      selectedCountryCode = code
      selectedCountryFlag = country
      requiredPhoneLength = length

      // Update the flag in the selector
      const selectedFlag = document.querySelector(".selected-flag")
      selectedFlag.className = `fi fi-${country} selected-flag`

      // Clear phone input and validation
      const phoneInput = document.getElementById("phoneInput")
      phoneInput.value = ""
      phoneInput.placeholder = `Enter ${length}-digit phone number`

      // Reset validation
      const phoneContainer = document.querySelector(".phone-input")
      phoneContainer.classList.remove("error", "success")
      document.getElementById("phoneError").style.display = "none"
      document.getElementById("phoneSuccess").style.display = "none"

      // Close dropdown
      const dropdown = document.querySelector(".country-selector-new")
      if (dropdown) {
        dropdown.classList.remove("show")
      }
    })
  })
}

// Cookie accordion functionality
function toggleCookieAccordion(type) {
  const content = document.getElementById(`${type}-content`)
  const icon = document.getElementById(`${type}-icon`)

  if (content.classList.contains("show")) {
    content.classList.remove("show")
    icon.classList.remove("rotated")
  } else {
    content.classList.add("show")
    icon.classList.add("rotated")
  }
}

// Toggle time format
function toggleTimeFormat(event) {
  event.stopPropagation()
  const toggle = document.getElementById("formatToggle")
  const slider = document.getElementById("formatSlider")

  if (timeFormat === "24h") {
    timeFormat = "12h"
    toggle.classList.add("active")
    slider.textContent = "12h"
  } else {
    timeFormat = "24h"
    toggle.classList.remove("active")
    slider.textContent = "24h"
  }

  // Update time slots and timezone list
  generateTimeSlots()
  populateTimezoneList()
  updateCurrentTime()
}

// Toggle timezone dropdown
function toggleTimezoneDropdown() {
  const dropdown = document.getElementById("timezoneDropdown")
  const chevron = document.getElementById("timezoneChevron")

  if (isTimezoneDropdownOpen) {
    dropdown.classList.remove("show")
    chevron.style.transform = "rotate(0deg)"
    isTimezoneDropdownOpen = false
  } else {
    dropdown.classList.add("show")
    chevron.style.transform = "rotate(180deg)"
    isTimezoneDropdownOpen = true
    populateTimezoneList()
    document.getElementById("timezoneSearch").focus()
  }
}

// Close timezone dropdown when clicking outside
document.addEventListener("click", (event) => {
  const timezoneInfo = document.querySelector(".timezone-info")
  const dropdown = document.getElementById("timezoneDropdown")

  if (timezoneInfo && !timezoneInfo.contains(event.target) && isTimezoneDropdownOpen) {
    dropdown.classList.remove("show")
    document.getElementById("timezoneChevron").style.transform = "rotate(0deg)"
    isTimezoneDropdownOpen = false
  }
})

// Cookie Settings Functions
function openCookieSettings() {
  document.getElementById("cookieOverlay").classList.add("show")
  document.getElementById("cookiePopup").classList.add("show")
}

function closeCookieSettings() {
  document.getElementById("cookieOverlay").classList.remove("show")
  document.getElementById("cookiePopup").classList.remove("show")
}

function toggleCookie(element, event) {
  event.stopPropagation()

  if (element.classList.contains("disabled")) return

  const type = element.getAttribute("data-type")
  const isActive = element.classList.contains("active")

  if (isActive) {
    element.classList.remove("active")
    cookiePreferences[type] = false
  } else {
    element.classList.add("active")
    cookiePreferences[type] = true
  }
}

function rejectAllCookies() {
  const toggles = document.querySelectorAll(".cookie-toggle:not(.disabled)")
  toggles.forEach((toggle) => {
    toggle.classList.remove("active")
    const type = toggle.getAttribute("data-type")
    if (type) {
      cookiePreferences[type] = false
    }
  })

  console.log("All optional cookies rejected:", cookiePreferences)
  closeCookieSettings()
}

function confirmCookieChoices() {
  console.log("Cookie preferences saved:", cookiePreferences)
  closeCookieSettings()
}

// Initialize timezone list
function initializeTimezones() {
  allTimezones = []
  Object.keys(timezoneData).forEach((region) => {
    timezoneData[region].forEach((tz) => {
      allTimezones.push({
        region: region,
        name: tz.name,
        value: tz.value,
      })
    })
  })
}

// Get formatted time for timezone
function getFormattedTime(timezone) {
  try {
    const now = new Date()
    const options = {
      timeZone: timezone,
      hour: "2-digit",
      minute: "2-digit",
      hour12: timeFormat === "12h",
    }
    return now.toLocaleTimeString("en-US", options)
  } catch (error) {
    console.error("Error formatting time for timezone:", timezone, error)
    return "00:00"
  }
}

// Populate timezone list
function populateTimezoneList() {
  const timezoneList = document.getElementById("timezoneList")
  timezoneList.innerHTML = ""

  Object.keys(timezoneData).forEach((region) => {
    const section = document.createElement("div")
    section.className = "timezone-section"

    const header = document.createElement("div")
    header.className = "timezone-section-header"
    header.textContent = region
    section.appendChild(header)

    timezoneData[region].forEach((tz) => {
      const item = document.createElement("div")
      item.className = "timezone-item"
      if (tz.value === selectedTimezoneValue) {
        item.classList.add("selected")
      }

      const time = getFormattedTime(tz.value)

      item.innerHTML = `
        <div class="timezone-name">${tz.name}</div>
        <div class="timezone-time">${time}</div>
      `

      item.onclick = () => selectTimezone(tz.name, tz.value)
      section.appendChild(item)
    })

    timezoneList.appendChild(section)
  })
}

// Filter timezones based on search
function filterTimezones() {
  const searchTerm = document.getElementById("timezoneSearch").value.toLowerCase()
  const sections = document.querySelectorAll(".timezone-section")

  sections.forEach((section) => {
    const items = section.querySelectorAll(".timezone-item")
    let hasVisibleItems = false

    items.forEach((item) => {
      const name = item.querySelector(".timezone-name").textContent.toLowerCase()
      if (name.includes(searchTerm)) {
        item.style.display = "flex"
        hasVisibleItems = true
      } else {
        item.style.display = "none"
      }
    })

    section.style.display = hasVisibleItems ? "block" : "none"
  })
}

// Select timezone function
function selectTimezone(displayName, timezoneValue) {
  selectedTimezoneDisplay = displayName
  selectedTimezoneValue = timezoneValue

  // Update displays
  document.getElementById("currentTimezone").textContent = displayName
  document.getElementById("selectedTimezoneDisplay").textContent = displayName
  document.getElementById("confirmTimezone").textContent = displayName

  // Update current time
  updateCurrentTime()

  // Update time slots
  generateTimeSlots()
  updateTimeSlots()

  // Close dropdown
  toggleTimezoneDropdown()
}

// Phone number validation
function isNumberKey(evt) {
  var charCode = evt.which ? evt.which : evt.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57)) return false
  return true
}

function validatePhoneNumber(input) {
  const phoneContainer = input.closest(".phone-input")
  const errorDiv = document.getElementById("phoneError")
  const successDiv = document.getElementById("phoneSuccess")
  const submitBtn = document.getElementById("submitBtn")

  const value = input.value
  input.value = value.replace(/\D/g, "")

  if (input.value.length === 0) {
    phoneContainer.classList.remove("error", "success")
    errorDiv.style.display = "none"
    successDiv.style.display = "none"
    submitBtn.disabled = false
  } else if (input.value.length < requiredPhoneLength) {
    phoneContainer.classList.add("error")
    phoneContainer.classList.remove("success")
    errorDiv.style.display = "block"
    errorDiv.textContent = `Please enter ${requiredPhoneLength - input.value.length} more digit${requiredPhoneLength - input.value.length > 1 ? "s" : ""}`
    successDiv.style.display = "none"
    submitBtn.disabled = true
  } else if (input.value.length === requiredPhoneLength) {
    phoneContainer.classList.remove("error")
    phoneContainer.classList.add("success")
    errorDiv.style.display = "none"
    successDiv.style.display = "block"
    submitBtn.disabled = false
  } else {
    phoneContainer.classList.add("error")
    phoneContainer.classList.remove("success")
    errorDiv.style.display = "block"
    errorDiv.textContent = `Phone number should be exactly ${requiredPhoneLength} digits`
    successDiv.style.display = "none"
    submitBtn.disabled = true
  }
}

// Update current time display
function updateCurrentTime() {
  const time = getFormattedTime(selectedTimezoneValue)
  document.getElementById("currentTime").textContent = time
}

// Check if date is in the past
function isPastDate(year, month, day) {
  const dateToCheck = new Date(year, month, day)
  const today = new Date()
  today.setHours(0, 0, 0, 0)
  return dateToCheck < today
}

// Check if time is in the past for today
function isPastTime(timeString) {
  if (!selectedDate) return false

  const selectedDateObj = new Date(selectedDate)
  const today = new Date()

  if (selectedDateObj.toDateString() !== today.toDateString()) {
    return false
  }

  // Convert time string to 24h format for comparison
  let time24
  if (timeFormat === "12h") {
    const [time, period] = timeString.split(" ")
    const [hours, minutes] = time.split(":").map(Number)
    let hour24 = hours

    if (period === "PM" && hours !== 12) {
      hour24 += 12
    } else if (period === "AM" && hours === 12) {
      hour24 = 0
    }
    time24 = `${hour24.toString().padStart(2, "0")}:${minutes.toString().padStart(2, "0")}`
  } else {
    time24 = timeString
  }

  const [hours, minutes] = time24.split(":").map(Number)
  const timeToCheck = new Date()
  timeToCheck.setHours(hours, minutes, 0, 0)

  return timeToCheck <= today
}

// Initialize calendar
function initCalendar() {
  // Set current month to actual current date
  const now = new Date()
  currentMonth = new Date(now.getFullYear(), now.getMonth(), 1)

  initializeTimezones()
  initializeCountrySelector()
  updateCurrentTime()
  setInterval(updateCurrentTime, 60000)
  updateCalendarHeader()
  generateCalendar()
  generateTimeSlots()
}

// Update calendar header
function updateCalendarHeader() {
  document.getElementById("currentMonth").textContent =
    `${monthNames[currentMonth.getMonth()]} ${currentMonth.getFullYear()}`
}

// Generate calendar days
function generateCalendar() {
  const calendarGrid = document.getElementById("calendarGrid")
  calendarGrid.innerHTML = ""

  const year = currentMonth.getFullYear()
  const month = currentMonth.getMonth()
  const firstDay = new Date(year, month, 1)
  const lastDay = new Date(year, month + 1, 0)
  const daysInMonth = lastDay.getDate()
  const startingDayOfWeek = (firstDay.getDay() + 6) % 7

  // Add empty cells for days before the first day of the month
  for (let i = 0; i < startingDayOfWeek; i++) {
    const emptyCell = document.createElement("div")
    emptyCell.className = "calendar-day-cell"
    calendarGrid.appendChild(emptyCell)
  }

  // Add days of the month
  for (let day = 1; day <= daysInMonth; day++) {
    const dayCell = document.createElement("div")
    dayCell.className = "calendar-day-cell"

    const isPast = isPastDate(year, month, day)
    const buttonClass = isPast ? "btn btn-outline-secondary calendar-day" : "btn btn-outline-primary calendar-day"
    const disabledAttr = isPast ? "disabled" : ""

    dayCell.innerHTML = `
      <button class="${buttonClass}" onclick="selectDate(${day}, this)" ${disabledAttr}>
        ${day}
      </button>
    `
    calendarGrid.appendChild(dayCell)
  }
}

// Generate time slots
function generateTimeSlots() {
  const timeSlotsContainer = document.getElementById("timeSlots")
  timeSlotsContainer.innerHTML = ""

  const timeSlots = getCurrentTimeSlots()
  timeSlots.forEach((time) => {
    const timeSlotDiv = document.createElement("div")
    const timeId = time.replace(/[:\s]/g, "").replace(/[^\w]/g, "")
    timeSlotDiv.innerHTML = `
      <button class="btn time-slot w-100 py-2" onclick="selectTime('${time}')" id="time-${timeId}">
        ${time}
      </button>
    `
    timeSlotsContainer.appendChild(timeSlotDiv)
  })
}

// Update time slots based on selected date
function updateTimeSlots() {
  const timeSlots = getCurrentTimeSlots()
  timeSlots.forEach((time) => {
    const timeId = time.replace(/[:\s]/g, "").replace(/[^\w]/g, "")
    const button = document.getElementById(`time-${timeId}`)
    if (button) {
      const isPast = isPastTime(time)
      if (isPast) {
        button.className = "btn time-slot w-100 py-2"
        button.disabled = true
        button.style.opacity = "0.5"
      } else {
        button.className = "btn time-slot w-100 py-2"
        button.disabled = false
        button.style.opacity = "1"
      }
    }
  })
}

// Navigate months
function navigateMonth(direction) {
  const newMonth = new Date(currentMonth)
  newMonth.setMonth(currentMonth.getMonth() + direction)

  // Don't allow navigation to past months
  const today = new Date()
  const currentMonthStart = new Date(today.getFullYear(), today.getMonth(), 1)

  if (newMonth >= currentMonthStart) {
    currentMonth = newMonth
    updateCalendarHeader()
    generateCalendar()
  }
}

// Select date
function selectDate(day, element) {
  const year = currentMonth.getFullYear()
  const month = currentMonth.getMonth()

  if (isPastDate(year, month, day)) {
    return
  }

  // Remove previous selection
  if (selectedDayElement) {
    selectedDayElement.classList.remove("selected")
    selectedDayElement.className = selectedDayElement.className.replace("btn-primary", "btn-outline-primary")
  }

  // Add selection to current element
  element.classList.add("selected")
  element.className = element.className.replace("btn-outline-primary", "btn-primary")
  selectedDayElement = element

  const dateObj = new Date(year, month, day)
  selectedDate = dateObj

  // Format date for display
  const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
  const dayName = days[dateObj.getDay()]
  const formattedDate = `${dayName}, ${monthNames[month]} ${day}`

  document.getElementById("selectedDateDisplay").textContent = formattedDate

  // Shrink calendar and show time slots
  shrinkCalendar()
  showTimeSlots()
  updateTimeSlots()
}

// Shrink calendar to make room for time slots
function shrinkCalendar() {
  if (!calendarShrunk) {
    const calendarSection = document.getElementById("calendarSection")

    // Check if we're on mobile
    if (window.innerWidth >= 992) {
      calendarSection.className = "col-md-8"
    }

    calendarShrunk = true
  }
}

// Show time slots
function showTimeSlots() {
  document.getElementById("timeSlotsContainer").classList.add("show")
}

// Clear date selection
function clearDateSelection() {
  if (selectedDayElement) {
    selectedDayElement.classList.remove("selected")
    selectedDayElement.className = selectedDayElement.className.replace("btn-primary", "btn-outline-primary")
    selectedDayElement = null
  }

  selectedDate = ""
  selectedTime = ""

  // Hide time slots and expand calendar
  document.getElementById("timeSlotsContainer").classList.remove("show")

  // Expand calendar back to full width
  if (calendarShrunk) {
    const calendarSection = document.getElementById("calendarSection")
    calendarSection.className = "col-12"
    calendarShrunk = false
  }
}

// Select time - directly go to form
function selectTime(time) {
  if (isPastTime(time)) {
    return
  }

  selectedTime = time
  document.getElementById("selectedDateTime").textContent = `${selectedTime}, ${selectedDate.toLocaleDateString(
    "en-US",
    {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    },
  )}`
  document.getElementById("appointmentDetails").classList.remove("d-none")
  showStep(3)
}

// Show specific step
function showStep(step) {
  document.querySelectorAll(".step-content").forEach((content) => {
    content.classList.remove("active")
  })

  if (step === 4) {
    document.getElementById("confirmationPage").classList.add("active")
  } else if (step === 3) {
    document.getElementById("step3").classList.add("active")
    document.getElementById("backButton").classList.remove("d-none")
  } else {
    document.getElementById("step1").classList.add("active")
    document.getElementById("backButton").classList.add("d-none")
  }

  currentStep = step
}

// Go back to previous step
function goBack() {
  if (currentStep === 3) {
    selectedTime = ""
    document.getElementById("appointmentDetails").classList.add("d-none")
    showStep(1)
  }
}

// Reset form to start over
function resetForm() {
  currentStep = 1
  selectedDate = ""
  selectedTime = ""
  selectedDayElement = null
  guestCount = 0

  // Hide confirmation page
  document.getElementById("confirmationPage").classList.remove("active")

  // Reset form
  document.getElementById("appointmentForm").reset()
  document.getElementById("appointmentForm").querySelector('input[name="name"]').value = "admin"
  document.getElementById("appointmentForm").querySelector('input[name="email"]').value = "admin@admin.com"

  // Reset guest form
  document.getElementById("guestEmailContainer").innerHTML = ""
  document.getElementById("guestForm").classList.remove("show")
  document.getElementById("addGuestBtn").style.display = "inline-block"
  updateGuestCount()

  // Reset phone validation
  const phoneContainer = document.querySelector(".phone-input")
  phoneContainer.classList.remove("error", "success")
  document.getElementById("phoneError").style.display = "none"
  document.getElementById("phoneSuccess").style.display = "none"
  document.getElementById("submitBtn").disabled = false

  // Reset appointment details
  document.getElementById("appointmentDetails").classList.add("d-none")

  // Reset calendar layout
  clearDateSelection()

  // Show step 1
  showStep(1)
}

// Toggle guest form
function toggleGuestForm() {
  const guestForm = document.getElementById("guestForm")
  const isVisible = guestForm.classList.contains("show")

  if (isVisible) {
    guestForm.classList.remove("show")
  } else {
    guestForm.classList.add("show")
    if (guestCount === 0) {
      addGuestEmail()
    }
  }
}

// Add guest email input
function addGuestEmail() {
  if (guestCount >= 5) {
    alert("Maximum 5 guests allowed")
    return
  }

  guestCount++
  const container = document.getElementById("guestEmailContainer")
  const guestDiv = document.createElement("div")
  guestDiv.className = "guest-email-input mb-2"
  guestDiv.innerHTML = `
    <div class="input-group">
      <span class="input-group-text">${guestCount}</span>
      <input type="email" class="form-control" name="guest_email_${guestCount}" placeholder="i.e. rahul@gmail.com" required>
      <button type="button" class="btn btn-outline-danger" onclick="removeGuestEmail(this, ${guestCount})">
        <i class="fas fa-trash"></i>
      </button>
    </div>
  `
  container.appendChild(guestDiv)

  updateGuestCount()

  if (guestCount >= 10) {
    document.getElementById("addGuestBtn").style.display = "none"
  }
}

// Remove guest email input
function removeGuestEmail(button, emailNumber) {
  const guestDiv = button.closest(".guest-email-input")
  guestDiv.remove()
  guestCount--

  updateGuestCount()

  if (guestCount < 10) {
    document.getElementById("addGuestBtn").style.display = "inline-block"
  }

  renumberGuestInputs()
}

// Update guest count badge
function updateGuestCount() {
  const badge = document.getElementById("guestCount")
  if (guestCount > 0) {
    badge.textContent = guestCount
    badge.classList.remove("d-none")
  } else {
    badge.classList.add("d-none")
  }
}

// Renumber guest inputs
function renumberGuestInputs() {
  const inputs = document.querySelectorAll(".guest-email-input")
  inputs.forEach((input, index) => {
    const span = input.querySelector(".input-group-text")
    const emailInput = input.querySelector('input[type="email"]')
    const newNumber = index + 1

    span.textContent = newNumber
    emailInput.name = `guest_email_${newNumber}`

    const button = input.querySelector("button")
    button.setAttribute("onclick", `removeGuestEmail(this, ${newNumber})`)
  })
}

// Format time for display
function formatTimeRange(time) {
  const startTime = time
  let endTime

  if (timeFormat === "12h") {
    const [timeStr, period] = time.split(" ")
    const [hours, minutes] = timeStr.split(":").map(Number)

    let endHours = hours
    let endMinutes = minutes + 30
    let endPeriod = period

    if (endMinutes >= 60) {
      endMinutes -= 60
      endHours += 1
    }

    if (endHours > 12) {
      endHours -= 12
      endPeriod = period === "AM" ? "PM" : "AM"
    } else if (endHours === 12 && period === "AM") {
      endPeriod = "PM"
    }

    endTime = `${endHours}:${endMinutes.toString().padStart(2, "0")} ${endPeriod}`
  } else {
    const [hours, minutes] = time.split(":").map(Number)

    let endHours = hours
    let endMinutes = minutes + 30

    if (endMinutes >= 60) {
      endMinutes -= 60
      endHours += 1
    }

    if (endHours >= 24) {
      endHours -= 24
    }

    endTime = `${endHours.toString().padStart(2, "0")}:${endMinutes.toString().padStart(2, "0")}`
  }

  return `${startTime} - ${endTime}`
}

// Handle form submission
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("appointmentForm").addEventListener("submit", function (e) {
    e.preventDefault()

    const phoneInput = document.getElementById("phoneInput")
    if (phoneInput.value.length !== requiredPhoneLength) {
      alert(`Please enter a valid ${requiredPhoneLength}-digit phone number`)
      phoneInput.focus()
      return
    }

    const formData = new FormData(this)
    const appointmentData = {
      name: formData.get("name"),
      email: formData.get("email"),
      phone: selectedCountryCode + formData.get("phone"),
      requirements: formData.get("requirements"),
      date: selectedDate,
      time: selectedTime,
      timezone: selectedTimezoneDisplay,
      guests: [],
    }

    // Collect guest emails
    for (let i = 1; i <= guestCount; i++) {
      const guestEmail = formData.get(`guest_email_${i}`)
      if (guestEmail) {
        appointmentData.guests.push(guestEmail)
      }
    }

    console.log("Appointment Data:", appointmentData)

    // Update confirmation page
    const timeRange = formatTimeRange(selectedTime)
    const formattedDate = selectedDate.toLocaleDateString("en-US", {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    })

    document.getElementById("confirmDateTime").textContent = `${timeRange}, ${formattedDate}`

    if (appointmentData.guests.length > 0) {
      document.getElementById("confirmGuests").style.display = "flex"
      document.getElementById("confirmGuestList").textContent = `Guests: ${appointmentData.guests.join(", ")}`
    } else {
      document.getElementById("confirmGuests").style.display = "none"
    }

    showStep(4)
  })

  // Initialize the application
  initCalendar()
})
