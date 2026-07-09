/**
 * =======================================================================
 * GA4 Section Engagement Tracker
 * =======================================================================
 * 
 * DESCRIPTION:
 * This lightweight module utilizes the native IntersectionObserver API 
 * to track how much time users spend lingering on specific UI sections.
 * 
 * USAGE:
 * 1. Include this script on your frontend webpage.
 * 2. Add the attribute `data-track-section="Your Section Name"` to any 
 *    HTML container you want to track (e.g. <section data-track-section="Hero">).
 * 3. The script handles visibility timers and automatically dispatches 
 *    the custom 'section_engagement' event to your global 'gtag'.
 */

(function() {
    'use strict';

    // Store timestamps for currently visible sections
    const activeSections = new Map();
    
    // Threshold: 50% of the section must be visible to trigger "engaged" state
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.5
    };

    /**
     * Dispatch the custom event to Google Analytics 4
     * @param {string} sectionName 
     * @param {number} timeSpentSeconds 
     */
    function sendGA4Event(sectionName, timeSpentSeconds) {
        // Ensure time spent is valid and greater than 0
        if (timeSpentSeconds <= 0) return;

        // Check if gtag is available in the global scope
        if (typeof window.gtag === 'function') {
            window.gtag('event', 'section_engagement', {
                'section_name': sectionName,
                'time_spent_seconds': timeSpentSeconds
            });
            console.log(`[GA4 Tracker] Sent: ${sectionName} | ${timeSpentSeconds}s`);
        } else {
            console.warn(`[GA4 Tracker] gtag not found. Buffered: ${sectionName} | ${timeSpentSeconds}s`);
        }
    }

    /**
     * Intersection Observer Callback
     */
    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            const sectionName = entry.target.getAttribute('data-track-section');
            if (!sectionName) return;

            if (entry.isIntersecting) {
                // Element just entered the viewport (>= 50% visibility)
                if (!activeSections.has(sectionName)) {
                    activeSections.set(sectionName, Date.now());
                }
            } else {
                // Element just left the viewport
                if (activeSections.has(sectionName)) {
                    const startTime = activeSections.get(sectionName);
                    const endTime = Date.now();
                    const timeSpentMs = endTime - startTime;
                    const timeSpentSeconds = Math.round(timeSpentMs / 1000);

                    // Only send event if they lingered for at least 1 second
                    if (timeSpentSeconds > 0) {
                        sendGA4Event(sectionName, timeSpentSeconds);
                    }

                    // Remove from active tracking
                    activeSections.delete(sectionName);
                }
            }
        });
    };

    /**
     * Handle page unload to catch users closing the tab while still engaged in a section
     */
    function handleUnload() {
        activeSections.forEach((startTime, sectionName) => {
            const endTime = Date.now();
            const timeSpentSeconds = Math.round((endTime - startTime) / 1000);
            
            if (timeSpentSeconds > 0) {
                sendGA4Event(sectionName, timeSpentSeconds);
            }
        });
        activeSections.clear();
    }

    // Initialize Tracker when DOM is ready
    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver(observerCallback, observerOptions);
        
        // Find all elements to track
        const elementsToTrack = document.querySelectorAll('[data-track-section]');
        elementsToTrack.forEach(el => observer.observe(el));

        // Add unload listener
        window.addEventListener('beforeunload', handleUnload);
    });

})();
