import { BetaAnalyticsDataClient } from '@google-analytics/data';
import { readFileSync } from 'fs';

// 1. Manually load your credentials file as an object
const credentialsFile = JSON.parse(
    readFileSync(new URL('./credentials.json', import.meta.url))
);

// 2. Pass the direct object properties so Node.js doesn't check Windows system variables
const analyticsDataClient = new BetaAnalyticsDataClient({
    credentials: {
        client_email: credentialsFile.client_email,
        private_key: credentialsFile.private_key,
    },
    scopes: ['https://www.googleapis.com/auth/analytics.readonly']
});

// Your standard Fortune One numeric GA4 property ID
const propertyId = '488145142';

// Get timeframe from command line argument, default to weekly
const timeframe = process.argv[2] || 'weekly';

// Define date ranges and dimensions based on timeframe
let startDate, previousStartDate, previousEndDate;
let timelineDimension;

switch (timeframe) {
    case 'daily':
        startDate = 'today';
        previousStartDate = 'yesterday';
        previousEndDate = 'yesterday';
        timelineDimension = 'hour';
        break;
    case 'weekly':
    default:
        startDate = '7daysAgo';
        previousStartDate = '14daysAgo';
        previousEndDate = '7daysAgo';
        timelineDimension = 'date';
        break;
    case 'monthly':
        startDate = '30daysAgo';
        previousStartDate = '60daysAgo';
        previousEndDate = '30daysAgo';
        timelineDimension = 'week';
        break;
    case 'yearly':
        startDate = '365daysAgo';
        previousStartDate = '730daysAgo';
        previousEndDate = '365daysAgo';
        timelineDimension = 'month';
        break;
}

async function executeAnalytics() {
    try {
        // Run multiple reports in parallel to gather all necessary dashboard data
        const [
            summaryResponse,
            timelineResponse,
            topPagesResponse,
            engagementResponse
        ] = await Promise.all([
            // 1. Summary Stats (Current vs Previous)
            analyticsDataClient.runReport({
                property: `properties/${propertyId}`,
                dateRanges: [
                    { name: 'current', startDate, endDate: 'today' },
                    { name: 'previous', startDate: previousStartDate, endDate: previousEndDate }
                ],
                metrics: [
                    { name: 'activeUsers' },
                    { name: 'screenPageViews' },
                    { name: 'userEngagementDuration' }
                ],
            }).then(res => res[0]),

            // 2. Traffic Timeline
            analyticsDataClient.runReport({
                property: `properties/${propertyId}`,
                dateRanges: [{ startDate, endDate: 'today' }],
                dimensions: [{ name: timelineDimension }],
                metrics: [{ name: 'activeUsers' }, { name: 'screenPageViews' }],
                orderBys: [{ dimension: { dimensionName: timelineDimension }, desc: false }]
            }).then(res => res[0]),

            // 3. Top Pages
            analyticsDataClient.runReport({
                property: `properties/${propertyId}`,
                dateRanges: [{ startDate, endDate: 'today' }],
                dimensions: [{ name: 'pagePath' }],
                metrics: [{ name: 'screenPageViews' }],
                orderBys: [{ metric: { metricName: 'screenPageViews' }, desc: true }],
                limit: 5,
            }).then(res => res[0]),
            
            // 4. Engagement (Mocking sections by base paths)
            // GA4 doesn't have "sections" natively unless configured, so we aggregate Top pages by base path
            analyticsDataClient.runReport({
                property: `properties/${propertyId}`,
                dateRanges: [{ startDate, endDate: 'today' }],
                dimensions: [{ name: 'pagePath' }],
                metrics: [{ name: 'userEngagementDuration' }],
                limit: 50,
            }).then(res => res[0])
        ]);

        // Process Summary Data
        let users = 0, views = 0, duration = 0;
        let prevUsers = 0, prevViews = 0;

        if (summaryResponse.rows) {
            summaryResponse.rows.forEach(row => {
                const range = row.dimensionValues[0].value;
                if (range === 'current') {
                    users = parseInt(row.metricValues[0].value) || 0;
                    views = parseInt(row.metricValues[1].value) || 0;
                    duration = parseInt(row.metricValues[2].value) || 0;
                } else if (range === 'previous') {
                    prevUsers = parseInt(row.metricValues[0].value) || 0;
                    prevViews = parseInt(row.metricValues[1].value) || 0;
                }
            });
        }

        const avgRetentionSeconds = users > 0 ? Math.floor(duration / users) : 0;
        const retentionStr = `${Math.floor(avgRetentionSeconds / 60)}m ${avgRetentionSeconds % 60}s`;

        const calcTrend = (curr, prev) => {
            if (prev === 0) return '+100%';
            const diff = curr - prev;
            const pct = Math.round((diff / prev) * 100);
            return (pct >= 0 ? '+' : '') + pct + '%';
        };

        // Process Timeline Data
        const timelineLabels = [];
        const timelineUsers = [];
        const timelineViews = [];
        
        if (timelineResponse.rows) {
            timelineResponse.rows.forEach(row => {
                let label = row.dimensionValues[0].value;
                // Format label nicely based on timeframe
                if (timeframe === 'daily') label = label + ':00';
                else if (timeframe === 'yearly') label = 'Month ' + label;
                else if (timeframe === 'weekly') {
                    // Format YYYYMMDD to DD/MM
                    label = label.substring(6, 8) + '/' + label.substring(4, 6);
                }
                
                timelineLabels.push(label);
                timelineUsers.push(parseInt(row.metricValues[0].value) || 0);
                timelineViews.push(parseInt(row.metricValues[1].value) || 0);
            });
        }

        // Process Top Pages
        const topPagesLabels = [];
        const topPagesViews = [];
        if (topPagesResponse.rows) {
            topPagesResponse.rows.forEach(row => {
                topPagesLabels.push(row.dimensionValues[0].value || '/');
                topPagesViews.push(parseInt(row.metricValues[0].value) || 0);
            });
        }

        // Process Engagement into 4 generic buckets: Home, Projects, About, Contact
        let homeTime = 0, projectsTime = 0, aboutTime = 0, contactTime = 0;
        if (engagementResponse.rows) {
            engagementResponse.rows.forEach(row => {
                const path = row.dimensionValues[0].value.toLowerCase();
                const time = parseInt(row.metricValues[0].value) || 0;
                
                if (path.includes('project')) projectsTime += time;
                else if (path.includes('about')) aboutTime += time;
                else if (path.includes('contact')) contactTime += time;
                else homeTime += time; // default everything else to home
            });
        }
        
        // Convert to hours for the doughnut chart
        const toHours = (sec) => parseFloat((sec / 3600).toFixed(2));

        // Assemble Final JSON Payload
        const finalData = {
            summary: {
                users: users,
                views: views,
                retention: retentionStr,
                usersTrend: calcTrend(users, prevUsers),
                viewsTrend: calcTrend(views, prevViews)
            },
            trafficTimeline: {
                labels: timelineLabels,
                users: timelineUsers,
                views: timelineViews
            },
            topPages: {
                labels: topPagesLabels,
                views: topPagesViews
            },
            engagement: [toHours(homeTime), toHours(projectsTime), toHours(aboutTime), toHours(contactTime)]
        };

        // Print valid JSON only
        console.log(JSON.stringify(finalData));

    } catch (error) {
        // Output error as JSON so PHP can handle it gracefully
        console.log(JSON.stringify({ error: true, message: error.message }));
    }
}

executeAnalytics();