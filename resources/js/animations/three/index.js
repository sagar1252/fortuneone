import * as THREE from 'three';

export function initThree() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const container = document.getElementById('three-hero-container');
    if (!container) return;

    // Use Intersection Observer for lazy loading / playing
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (!window.threeHeroInitialized) {
                    setupThreeScene(container);
                    window.threeHeroInitialized = true;
                }
            }
        });
    }, { rootMargin: '200px' });
    
    observer.observe(container);
}

function setupThreeScene(container) {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true, powerPreference: "high-performance" });
    
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2)); // Cap pixel ratio for performance
    container.appendChild(renderer.domElement);

    const geometry = new THREE.IcosahedronGeometry(2, 0);
    const material = new THREE.MeshPhysicalMaterial({
        color: 0xC18A56, metalness: 0.8, roughness: 0.2, transparent: true, opacity: 0.6, wireframe: true
    });
    const mesh = new THREE.Mesh(geometry, material);
    scene.add(mesh);

    scene.add(new THREE.AmbientLight(0xffffff, 0.4));
    const dirLight = new THREE.DirectionalLight(0xffffff, 1);
    dirLight.position.set(5, 5, 5);
    scene.add(dirLight);

    camera.position.z = 5;

    let mouseX = 0; let mouseY = 0;
    document.addEventListener('mousemove', (e) => {
        mouseX = (e.clientX / window.innerWidth) * 2 - 1;
        mouseY = -(e.clientY / window.innerHeight) * 2 + 1;
    });

    let animationFrameId;
    function animate() {
        animationFrameId = requestAnimationFrame(animate);
        mesh.rotation.x += 0.003; mesh.rotation.y += 0.003;
        mesh.position.x += (mouseX * 0.3 - mesh.position.x) * 0.05;
        mesh.position.y += (mouseY * 0.3 - mesh.position.y) * 0.05;
        renderer.render(scene, camera);
    }
    animate();

    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });
}
