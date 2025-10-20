function showTab(tabName) {
    const tabContents = document.querySelectorAll('.tab-content');
    tabContents.forEach(content => {
        content.classList.remove('active');
    });

    const tabs= document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.classList.remove('active');
    });

    document.getElementById(tabName).classList.add('active');

    event.target.classList.add('active');
}


document.addEventListener('DOMContentLoaded', function() {
    const statusCards = document.querySelectorAll('.status-card');
    statusCards.forEach(card => {
        card.addEventListener('click', function() {
            alert('Opening detailed view for this service request.')
        });
    });
    const emergencyBtn = document.querySelector('.emergency-btn');
    if (emergencyBtn) {
        emergencyBtn.addEventListener('click', function() {
            alert('Emergency Service request initiated! A technician will contact you within 15 minutes.');
        });
    }
    const regularBtn = document.querySelector('.regular-btn');
    if (regularBtn) {
        regularBtn.addEventListener('click', function() {
            showTab('request');
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'))
            tabs[1].classList.add('active');
        });
    }





});

