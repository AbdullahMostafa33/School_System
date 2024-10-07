console.log('hi')
// Example chart using Chart.js
const enrollmentCtx = document.getElementById('enrollmentChart').getContext('2d');
const performanceCtx = document.getElementById('performanceChart').getContext('2d');

// Enrollment chart
const enrollmentChart = new Chart(enrollmentCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Student Enrollment',
            data: [100, 150, 200, 220, 250, 300],
            backgroundColor: 'rgba(52, 152, 219, 0.2)',
            borderColor: '#3498db',
            borderWidth: 2
        }]
    }
});

// Performance chart
const performanceChart = new Chart(performanceCtx, {
    type: 'bar',
    data: {
        labels: ['Math', 'Science', 'History', 'English'],
        datasets: [{
            label: 'Teacher Performance',
            data: [85, 75, 90, 80],
            backgroundColor: ['#e74c3c', '#3498db', '#2ecc71', '#f1c40f']
        }]
    }
});


