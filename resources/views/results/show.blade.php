<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>نتيجة {{ $team->name }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700;900&display=swap" rel="stylesheet">
  <style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --bg:      #0f1f2e;
    --surface: #162534;
    --card:    #1c2f42;
    --border:  rgba(78,205,196,0.18);
    --accent:  #4ecdc4;
    --accent2: #2bb5ab;
    --gold:    #f7c948;
    --text:    #eaf6f4;
    --muted:   #7fb5ae;
  }

  body {
    min-height: 100vh;
    background: var(--bg);
    font-family: 'Cairo', sans-serif;
    color: var(--text);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem 1rem;
    overflow-x: hidden;
  }

  .blob {
    position: fixed; border-radius: 50%;
    pointer-events: none; z-index: 0; filter: blur(80px);
  }
  .blob-1 { width:500px;height:500px;top:-150px;left:-150px; background:rgba(78,205,196,0.14);}
  .blob-2 { width:400px;height:400px;bottom:-120px;right:-100px;background:rgba(43,181,171,0.12);}
  .blob-3 { width:280px;height:280px;top:45%;left:48%;background:rgba(247,201,72,0.07);}

  .wrap {
    position: relative; z-index: 1;
    width: min(560px, 96vw);
    display: flex; flex-direction: column; align-items: center; gap: 2rem;
    animation: fadeUp 0.7s cubic-bezier(0.16,1,0.3,1) both;
  }

  @keyframes fadeUp {
    from { opacity:0; transform:translateY(28px); }
    to   { opacity:1; transform:translateY(0); }
  }

  /* Trophy burst */
  .trophy-wrap {
    position: relative;
    display: flex; align-items: center; justify-content: center;
  }

  .trophy-ring {
    width: 130px; height: 130px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(247,201,72,0.18) 0%, transparent 70%);
    border: 2px solid rgba(247,201,72,0.3);
    display: flex; align-items: center; justify-content: center;
    font-size: 64px;
    box-shadow: 0 0 60px rgba(247,201,72,0.25), 0 0 120px rgba(247,201,72,0.1);
    animation: trophyPop 0.8s 0.2s cubic-bezier(0.16,1,0.3,1) both;
  }

  @keyframes trophyPop {
    from { opacity:0; transform:scale(0.5) rotate(-15deg); }
    to   { opacity:1; transform:scale(1) rotate(0deg); }
  }

  /* Stars burst */
  .star {
    position: absolute;
    font-size: 22px;
    animation: starBurst 0.7s cubic-bezier(0.16,1,0.3,1) both;
  }
  .star:nth-child(1) { top:-18px; left:50%; animation-delay:0.4s; }
  .star:nth-child(2) { top:10px;  right:-10px; animation-delay:0.5s; }
  .star:nth-child(3) { bottom:0;  right:-20px; animation-delay:0.6s; }
  .star:nth-child(4) { bottom:-10px; left:0;   animation-delay:0.55s; }
  .star:nth-child(5) { top:10px;  left:-14px;  animation-delay:0.45s; }

  @keyframes starBurst {
    from { opacity:0; transform:scale(0) rotate(0deg); }
    to   { opacity:1; transform:scale(1) rotate(20deg); }
  }

  /* Result card */
  .result-card {
    background: var(--card);
    border: 2px solid rgba(78,205,196,0.2);
    border-radius: 28px;
    padding: 2.5rem 2rem;
    text-align: center;
    width: 100%;
    position: relative;
    overflow: hidden;
  }

  .result-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--accent2), var(--accent), var(--gold), var(--accent), var(--accent2));
    background-size: 200% 100%;
    animation: borderFlow 3s linear infinite;
  }

  @keyframes borderFlow {
    0%   { background-position: 0%; }
    100% { background-position: 200%; }
  }

  .team-label {
    font-size: 14px;
    font-weight: 700;
    color: var(--muted);
    letter-spacing: 0.08em;
    margin-bottom: 0.4rem;
  }

  .team-name {
    font-size: clamp(1.6rem, 5vw, 2.4rem);
    font-weight: 900;
    background: linear-gradient(90deg, var(--accent), var(--gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 2rem;
  }

  /* Score dial */
  .score-dial {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.4rem;
    margin-bottom: 2rem;
  }

  .score-nums {
    display: flex;
    align-items: baseline;
    gap: 8px;
  }

  .score-big {
    font-size: clamp(4rem, 14vw, 6rem);
    font-weight: 900;
    color: var(--gold);
    line-height: 1;
    text-shadow: 0 0 40px rgba(247,201,72,0.4);
    animation: countUp 0.9s 0.5s cubic-bezier(0.16,1,0.3,1) both;
  }

  @keyframes countUp {
    from { opacity:0; transform:translateY(20px) scale(0.8); }
    to   { opacity:1; transform:translateY(0) scale(1); }
  }

  .score-sep { font-size: 2.5rem; font-weight: 900; color: var(--muted); }
  .score-total { font-size: 2.5rem; font-weight: 900; color: var(--muted); }
  .score-sub { font-size: 14px; font-weight: 700; color: var(--muted); }

  /* Progress ring */
  .ring-wrap {
    position: relative;
    width: 120px; height: 120px;
    margin: 0 auto 1.5rem;
  }

  .ring-svg { transform: rotate(-90deg); }

  .ring-bg  { fill: none; stroke: rgba(78,205,196,0.1); stroke-width: 8; }
  .ring-fill {
    fill: none;
    stroke: url(#ringGrad);
    stroke-width: 8;
    stroke-linecap: round;
    stroke-dasharray: 283;
    stroke-dashoffset: 283;
    animation: ringDraw 1.2s 0.6s cubic-bezier(0.16,1,0.3,1) forwards;
  }

  @keyframes ringDraw {
    to { stroke-dashoffset: var(--dash-target); }
  }

  .ring-pct {
    position: absolute;
    inset: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem;
    font-weight: 900;
    color: var(--accent);
  }

  /* Verdict banner */
  .verdict {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 28px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 900;
    animation: fadeUp 0.5s 0.8s cubic-bezier(0.16,1,0.3,1) both;
  }

  .verdict-great  { background:rgba(34,197,94,0.12);  border:1.5px solid rgba(34,197,94,0.35);  color:#86efac; }
  .verdict-good   { background:rgba(78,205,196,0.12); border:1.5px solid rgba(78,205,196,0.35); color:var(--accent); }
  .verdict-ok     { background:rgba(247,201,72,0.12); border:1.5px solid rgba(247,201,72,0.35); color:var(--gold); }
  .verdict-poor   { background:rgba(239,68,68,0.12);  border:1.5px solid rgba(239,68,68,0.35);  color:#fca5a5; }

  /* Buttons */
  .btn-row {
    display: flex; gap: 14px; flex-wrap: wrap; justify-content: center;
    width: 100%;
    animation: fadeUp 0.5s 1s cubic-bezier(0.16,1,0.3,1) both;
  }

  .btn-primary {
    display: inline-flex; align-items: center; gap: 10px;
    background: linear-gradient(135deg, var(--accent2), var(--accent));
    border: none; border-radius: 50px;
    padding: 14px 32px;
    font-family: 'Cairo', sans-serif; font-size: 15px; font-weight: 900;
    color: #0f1f2e; text-decoration: none;
    transition: transform 0.2s, box-shadow 0.25s;
    box-shadow: 0 6px 24px rgba(78,205,196,0.35);
  }
  .btn-primary:hover { transform:translateY(-2px) scale(1.03); box-shadow:0 10px 36px rgba(78,205,196,0.5); color:#0f1f2e; }

  .btn-secondary {
    display: inline-flex; align-items: center; gap: 10px;
    background: rgba(247,201,72,0.1);
    border: 1.5px solid rgba(247,201,72,0.35); border-radius: 50px;
    padding: 14px 32px;
    font-family: 'Cairo', sans-serif; font-size: 15px; font-weight: 900;
    color: var(--gold); text-decoration: none;
    transition: background 0.2s, border-color 0.2s, transform 0.18s;
  }
  .btn-secondary:hover { background:rgba(247,201,72,0.18); border-color:var(--gold); transform:translateY(-2px); color:var(--gold); }

  .btn-ghost {
    display: inline-flex; align-items: center; gap: 10px;
    background: transparent;
    border: 1.5px solid var(--border); border-radius: 50px;
    padding: 14px 32px;
    font-family: 'Cairo', sans-serif; font-size: 15px; font-weight: 900;
    color: var(--muted); text-decoration: none;
    transition: border-color 0.2s, color 0.2s, transform 0.18s;
  }
  .btn-ghost:hover { border-color:var(--accent); color:var(--accent); transform:translateY(-2px); }
  </style>
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>

<div class="wrap">

  <!-- Trophy -->
  <div class="trophy-wrap">
    <span class="star">⭐</span>
    <span class="star">✨</span>
    <span class="star">🌟</span>
    <span class="star">✨</span>
    <span class="star">⭐</span>
    <div class="trophy-ring">🏆</div>
  </div>

  <!-- Result card -->
  <div class="result-card">
    <p class="team-label">نتيجة الفريق</p>
    <p class="team-name">{{ $team->name }}</p>

    @php
      $pct   = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;
      $dash  = round(283 - ($pct / 100) * 283);
    @endphp

    <!-- Ring -->
    <div class="ring-wrap">
      <svg class="ring-svg" width="120" height="120" viewBox="0 0 120 120">
        <defs>
          <linearGradient id="ringGrad" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%"   stop-color="#2bb5ab"/>
            <stop offset="50%"  stop-color="#4ecdc4"/>
            <stop offset="100%" stop-color="#f7c948"/>
          </linearGradient>
        </defs>
        <circle class="ring-bg"   cx="60" cy="60" r="45"/>
        <circle class="ring-fill" cx="60" cy="60" r="45"
          style="--dash-target: {{ $dash }};"/>
      </svg>
      <div class="ring-pct">{{ $pct }}%</div>
    </div>

    <!-- Score numbers -->
    <div class="score-dial">
      <div class="score-nums">
        <span class="score-big">{{ $score }}</span>
        <span class="score-sep">/</span>
        <span class="score-total">{{ $totalQuestions }}</span>
      </div>
      <span class="score-sub">إجابة صحيحة</span>
    </div>

    <!-- Verdict -->
    @if($pct >= 80)
      <div class="verdict verdict-great">🎉 ممتاز! أداء رائع</div>
    @elseif($pct >= 60)
      <div class="verdict verdict-good">👍 جيد جداً! استمر</div>
    @elseif($pct >= 40)
      <div class="verdict verdict-ok">💪 جيد، يمكنك التحسين</div>
    @else
      <div class="verdict verdict-poor">📚 واصل التعلم والمحاولة</div>
    @endif
  </div>

  <!-- Action buttons -->
  <div class="btn-row">
    <a href="{{ route('game.selectTeam') }}" class="btn-primary">🔄 جولة جديدة</a>
    <a href="{{ route('results.index') }}"   class="btn-secondary">🏅 لوحة النتائج</a>
    <a href="{{ route('home') }}"            class="btn-ghost">🏠 الرئيسية</a>
  </div>

</div>

</body>
</html>