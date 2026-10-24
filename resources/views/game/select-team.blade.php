<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>اختيار الفريق</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
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
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 1rem;
  overflow-x: hidden;
}

.blob {
  position: fixed;
  border-radius: 50%;
  pointer-events: none;
  z-index: 0;
  filter: blur(80px);
}
.blob-1 { width: 500px; height: 500px; top: -150px; left: -150px;  background: rgba(78,205,196,0.14); }
.blob-2 { width: 400px; height: 400px; bottom: -120px; right: -100px; background: rgba(43,181,171,0.12); }
.blob-3 { width: 280px; height: 280px; top: 45%; left: 48%; background: rgba(247,201,72,0.07); }

.container {
  position: relative;
  z-index: 1;
  width: min(1000px, 96vw);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2.5rem;
}

/* Hero */
.hero {
  text-align: center;
  animation: slideDown 0.6s cubic-bezier(0.16,1,0.3,1) both;
}

.hero-icon {
  width: 90px; height: 90px;
  background: linear-gradient(135deg, var(--accent2), var(--accent));
  border-radius: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 42px;
  margin: 0 auto 1.4rem;
  box-shadow: 0 12px 40px rgba(78,205,196,0.35);
  animation: floatIcon 4s ease-in-out infinite;
}

@keyframes floatIcon {
  0%,100% { transform: translateY(0); }
  50%      { transform: translateY(-8px); }
}

.hero-title {
  font-size: clamp(2rem, 5vw, 3rem);
  font-weight: 900;
  color: var(--text);
  line-height: 1.2;
}

.hero-title span {
  background: linear-gradient(90deg, var(--accent), var(--gold));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero-sub {
  margin-top: 0.7rem;
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--muted);
}

/* Grid */
.teams-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
  gap: 20px;
  width: 100%;
}

/* Team card */
.team-card {
  position: relative;
  background: var(--card);
  border: 2px solid var(--border);
  border-radius: 22px;
  padding: 2rem 1.4rem 1.6rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 14px;
  cursor: pointer;
  transition: border-color 0.22s, transform 0.2s, box-shadow 0.22s, background 0.22s;
  opacity: 0;
  animation: cardIn 0.5s cubic-bezier(0.16,1,0.3,1) forwards;
  text-align: center;
  overflow: hidden;
  user-select: none;
}

.team-card::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--accent2), var(--accent), var(--gold), var(--accent), var(--accent2));
  background-size: 200% 100%;
  opacity: 0;
  transition: opacity 0.25s;
  animation: borderFlow 3s linear infinite;
}

@keyframes borderFlow {
  0%   { background-position: 0% 0%; }
  100% { background-position: 200% 0%; }
}

.team-card:hover::after,
.team-card.selected::after { opacity: 1; }

@keyframes cardIn {
  from { opacity: 0; transform: translateY(22px) scale(0.96); }
  to   { opacity: 1; transform: translateY(0) scale(1); }
}

.team-card:hover {
  border-color: var(--accent);
  background: rgba(78,205,196,0.07);
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 14px 40px rgba(78,205,196,0.18);
}

.team-card.selected {
  border-color: var(--accent);
  background: rgba(78,205,196,0.12);
  box-shadow: 0 0 0 4px rgba(78,205,196,0.15), 0 14px 44px rgba(78,205,196,0.22);
  transform: translateY(-5px) scale(1.02);
}

/* Avatar */
.team-avatar {
  width: 90px; height: 90px;
  border-radius: 50%;
  background: rgba(78,205,196,0.1);
  border: 3px solid rgba(78,205,196,0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 36px;
  font-weight: 900;
  color: var(--accent);
  overflow: hidden;
  transition: border-color 0.22s, box-shadow 0.22s;
  flex-shrink: 0;
}

.team-avatar img {
  width: 100%; height: 100%;
  object-fit: cover;
}

.team-card.selected .team-avatar {
  border-color: var(--accent);
  box-shadow: 0 0 30px rgba(78,205,196,0.5);
}

/* Name */
.team-name-text {
  font-size: 1.15rem;
  font-weight: 900;
  color: var(--text);
  transition: color 0.2s;
  line-height: 1.3;
}

.team-card.selected .team-name-text { color: var(--accent); }

/* Members badge */
.members-badge {
  font-size: 13px;
  font-weight: 700;
  color: var(--muted);
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 50px;
  padding: 4px 14px;
}

/* Check badge */
.check-badge {
  position: absolute;
  top: 12px;
  left: 12px;
  width: 30px; height: 30px;
  background: var(--accent);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 15px;
  color: var(--bg);
  font-weight: 900;
  opacity: 0;
  transform: scale(0.4);
  transition: opacity 0.22s, transform 0.28s cubic-bezier(0.16,1,0.3,1);
}

.team-card.selected .check-badge {
  opacity: 1;
  transform: scale(1);
}

.team-card input[type="radio"] { display: none; }

/* Start button */
.start-wrap {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  animation: slideDown 0.6s 0.3s cubic-bezier(0.16,1,0.3,1) both;
  width: 100%;
}

.start-btn {
  background: linear-gradient(135deg, var(--accent2), var(--accent));
  border: none;
  border-radius: 50px;
  padding: 18px 90px;
  font-family: 'Cairo', sans-serif;
  font-size: 22px;
  font-weight: 900;
  color: #0f1f2e;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.25s, opacity 0.2s;
  box-shadow: 0 6px 28px rgba(78,205,196,0.4);
  position: relative;
  overflow: hidden;
  opacity: 0.4;
  pointer-events: none;
}

.start-btn.active {
  opacity: 1;
  pointer-events: auto;
}

.start-btn::before {
  content: '';
  position: absolute;
  top: 0; left: -80%;
  width: 60%; height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
  animation: btnShine 2.5s ease infinite;
}

@keyframes btnShine {
  0%  { left: -80%; }
  50% { left: 130%; }
  100%{ left: 130%; }
}

.start-btn.active:hover {
  transform: translateY(-3px) scale(1.03);
  box-shadow: 0 12px 40px rgba(78,205,196,0.55);
}

.start-btn.active:active { transform: scale(0.97); }

.start-hint {
  font-size: 0.95rem;
  font-weight: 700;
  color: var(--muted);
  transition: color 0.3s;
}

.start-hint.picked { color: var(--accent); }

@keyframes slideDown {
  from { opacity: 0; transform: translateY(-18px); }
  to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 520px) {
  .teams-grid { grid-template-columns: 1fr 1fr; }
  .start-btn  { padding: 16px 60px; font-size: 19px; }
  .team-avatar { width: 72px; height: 72px; font-size: 28px; }
}
</style>
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>

<div class="container">

  <!-- Hero -->
  <div class="hero">
    <div class="hero-icon">🏆</div>
    <h1 class="hero-title">مسابقة <span>المعرفة</span></h1>
    <p class="hero-sub">اختر فريقك للبدء</p>
  </div>

  <!-- Form -->
  <form action="{{ route('game.start') }}" method="POST" style="width:100%; display:contents;">
    @csrf

    <div class="teams-grid">
      @foreach($teams as $index => $team)
        @php $emojis = ['🦁','🐯','🦊','🐺','🦅','🐉','🦋','🌊','⚡','🔥','🌙','💫']; @endphp

        <label
          class="team-card"
          style="animation-delay: {{ $index * 80 }}ms"
          data-name="{{ $team->name }}"
        >
          <input type="radio" name="team_id" value="{{ $team->id }}" required>

          <div class="check-badge">✓</div>

          <div class="team-avatar">
            @if($team->image)
              <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}">
            @else
              {{ $emojis[$index % count($emojis)] }}
            @endif
          </div>

          <span class="team-name-text">{{ $team->name }}</span>

          @if($team->members && count($team->members) > 0)
            <span class="members-badge">{{ count($team->members) }} أعضاء</span>
          @endif
        </label>
      @endforeach
    </div>

    <!-- Start -->
    <div class="start-wrap">
      <button type="submit" class="start-btn" id="start-btn">ابدأ المسابقة ←</button>
      <span class="start-hint" id="start-hint">اختر فريقاً للمتابعة</span>
    </div>

  </form>

</div>

<script>
  const cards    = document.querySelectorAll('.team-card');
  const startBtn = document.getElementById('start-btn');
  const hint     = document.getElementById('start-hint');

  cards.forEach(card => {
    card.addEventListener('click', () => {
      cards.forEach(c => c.classList.remove('selected'));
      card.classList.add('selected');
      card.querySelector('input[type="radio"]').checked = true;

      startBtn.classList.add('active');
      hint.textContent = `الفريق المختار: ${card.dataset.name}`;
      hint.classList.add('picked');
    });
  });
</script>
</body>
</html>