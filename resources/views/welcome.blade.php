<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #181c2a 0%, #232946 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            color: #f3f4f6;
        }
        .meteor-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            pointer-events: none;
            z-index: 0;
        }
        .container {
            background: rgba(30,34,54,0.65);
            border-radius: 32px;
            box-shadow: 0 8px 40px 0 rgba(30,34,54,0.22);
            padding: 56px 36px 44px 36px;
            max-width: 420px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 1;
            animation: fadeInUp 0.8s cubic-bezier(.23,1.01,.32,1) 0.1s both;
            backdrop-filter: blur(16px) saturate(140%);
            border: 1.5px solid rgba(120,130,200,0.13);
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: none; }
        }
        .logo-wrap {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 18px;
        }
        .logo-glow {
            position: absolute;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: radial-gradient(circle, #6366f1 0%, #232946 80%);
            filter: blur(18px) brightness(1.2);
            opacity: 0.45;
            z-index: 0;
            left: 50%;
            top: 0;
            transform: translate(-50%, 10px);
            pointer-events: none;
        }
        .logo {
            width: 72px;
            height: 72px;
            z-index: 1;
            position: relative;
            animation: floatLogo 3.5s ease-in-out infinite alternate;
        }
        @keyframes floatLogo {
            0% { transform: translateY(0) scale(1); }
            100% { transform: translateY(-10px) scale(1.04); }
        }
        h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin: 0 0 10px 0;
            background: linear-gradient(90deg, #a5b4fc 10%, #6366f1 90%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .slogan {
            color: #a5b4fc;
            font-size: 1.13rem;
            margin-bottom: 36px;
            min-height: 28px;
            letter-spacing: 0.01em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .slogan-icon {
            width: 22px;
            height: 22px;
            opacity: 0.8;
        }
        .actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            opacity: 0;
            transform: translateY(30px);
            animation: actionsIn 0.7s cubic-bezier(.23,1.01,.32,1) 0.8s forwards;
            margin-bottom: 8px;
        }
        @keyframes actionsIn {
            to { opacity: 1; transform: none; }
        }
        .btn {
            padding: 15px 36px;
            border-radius: 999px;
            border: none;
            font-size: 1.08rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.22s, transform 0.18s, box-shadow 0.22s;
            box-shadow: 0 2px 12px 0 rgba(99,102,241,0.08);
        }
        .btn-login {
            background: linear-gradient(90deg, #6366f1 60%, #a5b4fc 100%);
            color: #fff;
            box-shadow: 0 2px 16px 0 rgba(99,102,241,0.18);
        }
        .btn-login:hover {
            background: linear-gradient(90deg, #7c3aed 60%, #6366f1 100%);
            transform: translateY(-2px) scale(1.06);
            box-shadow: 0 4px 24px 0 rgba(99,102,241,0.22);
        }
        .btn-register {
            background: rgba(35,41,70,0.7);
            color: #a5b4fc;
            border: 2px solid #6366f1;
        }
        .btn-register:hover {
            background: #232946;
            color: #fff;
            transform: translateY(-2px) scale(1.06);
            box-shadow: 0 4px 24px 0 rgba(99,102,241,0.13);
        }
        .footer {
            margin-top: 38px;
            color: #7c82a1;
            font-size: 0.93rem;
            letter-spacing: 0.01em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .footer svg {
            width: 15px;
            height: 15px;
            opacity: 0.7;
        }
        @media (max-width: 500px) {
            .container { padding: 28px 4px 18px 4px; max-width: 98vw; }
            h1 { font-size: 1.3rem; }
            .btn { padding: 12px 0; width: 100px; font-size: 1rem; }
            .actions { flex-direction: column; gap: 12px; }
        }
    </style>
</head>
<body>
    <canvas class="meteor-bg"></canvas>
    <div class="container">
        <div class="logo-wrap" style="position:relative;">
            <div class="logo-glow"></div>
            <svg class="logo" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6" y="8" width="36" height="32" rx="6" fill="#6366f1"/>
                <rect x="12" y="14" width="24" height="20" rx="3" fill="#fff"/>
                <rect x="16" y="18" width="16" height="2.5" rx="1.25" fill="#6366f1"/>
                <rect x="16" y="23" width="10" height="2.5" rx="1.25" fill="#6366f1"/>
            </svg>
        </div>
        <h1>e-Library</h1>
        <div class="slogan" id="slogan">
            <span id="slogan-text">Membaca, Menjelajah, dan Berbagi Pengetahuan</span>
        </div>
        <div class="actions">
            <a href="/login"><button class="btn btn-login">Login</button></a>
            <a href="/register"><button class="btn btn-register">Register</button></a>
        </div>
        <div class="footer">
            <svg viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="7" stroke="#a5b4fc" stroke-width="1.2"/><path d="M6.5 6.5C6.5 5.67157 7.17157 5 8 5C8.82843 5 9.5 5.67157 9.5 6.5C9.5 7.32843 8.82843 8 8 8C7.17157 8 6.5 8.67157 6.5 9.5V10" stroke="#a5b4fc" stroke-width="1.2" stroke-linecap="round"/><circle cx="8" cy="12" r="0.7" fill="#a5b4fc"/></svg>
            <span>&copy; 2024 e-Library. Temukan dunia di setiap halaman.</span>
        </div>
    </div>
    <script>
    // Typewriter effect untuk slogan
    const slogan = "Membaca, Menjelajah, dan Berbagi Pengetahuan";
    const el = document.getElementById('slogan-text');
    el.textContent = "";
    let i = 0;
    function type() {
        if (i < slogan.length) {
            el.textContent += slogan.charAt(i);
            i++;
            setTimeout(type, 32);
        }
    }
    setTimeout(type, 400);

    // Meteor (shooting star) animation
    const canvas = document.querySelector('.meteor-bg');
    const ctx = canvas.getContext('2d');
    let meteors = [];
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();
    function randomMeteor() {
        return {
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height * 0.5,
            len: 80 + Math.random() * 60,
            speed: 6 + Math.random() * 4,
            angle: Math.PI / 4 + (Math.random() - 0.5) * 0.2,
            alpha: 0.7 + Math.random() * 0.3
        };
    }
    function drawMeteor(m) {
        ctx.save();
        ctx.globalAlpha = m.alpha;
        ctx.strokeStyle = '#a5b4fc';
        ctx.lineWidth = 2.2;
        ctx.shadowColor = '#6366f1';
        ctx.shadowBlur = 12;
        ctx.beginPath();
        ctx.moveTo(m.x, m.y);
        ctx.lineTo(m.x - m.len * Math.cos(m.angle), m.y - m.len * Math.sin(m.angle));
        ctx.stroke();
        ctx.restore();
    }
    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (let m of meteors) {
            drawMeteor(m);
            m.x += m.speed * Math.cos(m.angle);
            m.y += m.speed * Math.sin(m.angle);
            m.alpha -= 0.012;
        }
        meteors = meteors.filter(m => m.alpha > 0);
        if (Math.random() < 0.07) meteors.push(randomMeteor());
        requestAnimationFrame(animate);
    }
    animate();
    </script>
</body>
</html> 