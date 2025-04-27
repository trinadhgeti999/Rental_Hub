document.addEventListener('DOMContentLoaded', function() {
    // Add interactive elements
    
    // Animate stats on scroll
    const statsGrid = document.querySelector('.stats-grid');
    if (statsGrid) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.stat-card').forEach(card => {
            observer.observe(card);
        });
    }
    
    // Add tooltips to action buttons
    const actionButtons = document.querySelectorAll('.action-button');
    actionButtons.forEach(button => {
        const tooltip = document.createElement('span');
        tooltip.className = 'tooltip';
        tooltip.textContent = button.getAttribute('data-tooltip') || 'Click to explore';
        button.appendChild(tooltip);
        
        button.addEventListener('mouseenter', () => {
            tooltip.style.opacity = '1';
            tooltip.style.visibility = 'visible';
        });
        
        button.addEventListener('mouseleave', () => {
            tooltip.style.opacity = '0';
            tooltip.style.visibility = 'hidden';
        });
    });
    
    // Add a greeting based on time of day
    const dashboardTitle = document.querySelector('.dashboard-title');
    if (dashboardTitle) {
        const hour = new Date().getHours();
        let greeting;
        
        if (hour < 12) greeting = 'Good Morning';
        else if (hour < 18) greeting = 'Good Afternoon';
        else greeting = 'Good Evening';
        
        const role = dashboardTitle.textContent.includes('Admin') ? 'Admin' : 
                    dashboardTitle.textContent.includes('Owner') ? 'Owner' : 'Renter';
        
        dashboardTitle.textContent = `${greeting}, ${role}!`;
    }
    
    // Make earnings list items clickable
    const earningsItems = document.querySelectorAll('.earnings-list li');
    earningsItems.forEach(item => {
        item.style.cursor = 'pointer';
        item.addEventListener('click', () => {
            // You can add functionality here to view details
            console.log('Item clicked:', item.textContent.trim());
        });
    });
});