import '@splinetool/viewer';

export function initSpline() {
    // Spline viewer is a custom element <spline-viewer>. 
    // Just importing it registers the web component.
    // We will place a <spline-viewer> tag in the HTML footer.
    const container = document.getElementById('spline-demo');
    if(container && !container.innerHTML.trim()) {
        container.innerHTML = `<spline-viewer url="https://prod.spline.design/6Wq1Q7YGyM-iab9i/scene.splinecode"></spline-viewer>`;
    }
}
