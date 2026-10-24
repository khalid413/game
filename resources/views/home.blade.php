@extends('layouts.app')

@section('content')

<style>
.home-wrap {
  display: flex;
  flex-direction: column;
  gap: 2.5rem;
  animation: fadeIn 0.6s cubic-bezier(0.16,1,0.3,1) both;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* Hero */
.hero {
  background: #1c2f42;
  border: 2px solid rgba(78,205,196,0.18);
  border-radius: 28px;
  padding: 3.5rem 2.5rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.hero::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, #2bb5ab, #4ecdc4, #f7c948, #4ecdc4, #2bb5ab);
  background-size: 200% 100%;
  animation: borderFlow 3s linear infinite;
}

@keyframes borderFlow {
  0%   { background-position: 0%; }
  100% { background-position: 200%; }
}

.hero-icon {
  width: 80px; height: 80px;
  background: linear-gradient(135deg, #2bb5ab, #4ecdc4);
  border-radius: 24px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 38px;
  box-shadow: 0 8px 28px rgba(78,205,196,0.35);
  margin: 0 auto 1.5rem;
}

.hero h1 {
  font-size: clamp(1.8rem, 5vw, 2.8rem);
  font-weight: 900;
  color: #eaf6f4;
  margin-bottom: 0.75rem;
}

.hero h1 span {
  background: linear-gradient(90deg, #4ecdc4, #f7c948);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.hero p {
  font-size: 1.05rem;
  font-weight: 700;
  color: #7fb5ae;
  margin-bottom: 0;
}

/* Cards grid */
.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.5rem;
}

.action-card {
  background: #1c2f42;
  border: 2px solid rgba(78,205,196,0.18);
  border-radius: 22px;
  padding: 2rem 1.5rem;
  text-align: center;
  text-decoration: none;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
  transition: transform 0.22s, box-shadow 0.22s, border-color 0.22s;
  position: relative;
  overflow: hidden;
  opacity: 0;
  animation: cardIn 0.5s cubic-bezier(0.16,1,0.3,1) forwards;
}

.action-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 18px 48px rgba(0,0,0,0.25);
  text-decoration: none;
}

@keyframes cardIn {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

.action-card-icon {
  width: 64px; height: 64px;
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 30px;
  flex-shrink: 0;
}

.action-card-label {
  font-size: 1.05rem;
  font-weight: 900;
  color: #eaf6f4;
}

.action-card-sub {
  font-size: 0.85rem;
  font-weight: 700;
  color: #7fb5ae;
  margin-top: -0.4rem;
}

/* Card variants */
.card-teal {
  border-color: rgba(78,205,196,0.25);
}
.card-teal:hover { border-color: #4ecdc4; box-shadow: 0 18px 48px rgba(78,205,196,0.2); }
.card-teal .action-card-icon {
  background: linear-gradient(135deg, #2bb5ab, #4ecdc4);
  box-shadow: 0 6px 20px rgba(78,205,196,0.35);
}

.card-yellow {
  border-color: rgba(247,201,72,0.2);
}
.card-yellow:hover { border-color: #f7c948; box-shadow: 0 18px 48px rgba(247,201,72,0.15); }
.card-yellow .action-card-icon {
  background: linear-gradient(135deg, #e6a800, #f7c948);
  box-shadow: 0 6px 20px rgba(247,201,72,0.35);
}

.card-green {
  border-color: rgba(52,211,153,0.2);
}
.card-green:hover { border-color: #34d399; box-shadow: 0 18px 48px rgba(52,211,153,0.15); }
.card-green .action-card-icon {
  background: linear-gradient(135deg, #059669, #34d399);
  box-shadow: 0 6px 20px rgba(52,211,153,0.35);
}

/* Shine effect on cards */
.action-card::before {
  content: '';
  position: absolute;
  top: 0; left: -80%;
  width: 60%; height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.04), transparent);
  animation: cardShine 3s ease infinite;
}

@keyframes cardShine {
  0%  { left: -80%; }
  50% { left: 130%; }
  100%{ left: 130%; }
}
</style>

<div class="home-wrap">

  <!-- Hero -->
  <div class="hero">
    <div class="hero-icon">🎮</div>
    <h1>Welcome to <span>Team Quiz</span></h1>
    <p>A fun and interactive quiz game for teams. Create teams, add questions, and start playing!</p>
  </div>

  <!-- Action Cards -->
  <div class="cards-grid">

    <a href="{{ route('teams.create') }}" class="action-card card-teal" style="animation-delay: 80ms">
      <div class="action-card-icon">🛡️</div>
      <div>
        <div class="action-card-label">Create Team</div>
        <div class="action-card-sub">Set up a new team to compete</div>
      </div>
    </a>

    <a href="{{ route('questions.create') }}" class="action-card card-yellow" style="animation-delay: 160ms">
      <div class="action-card-icon">❓</div>
      <div>
        <div class="action-card-label">Add Question</div>
        <div class="action-card-sub">Build your question bank</div>
      </div>
    </a>

    <a href="{{ route('game.selectTeam') }}" class="action-card card-green" style="animation-delay: 240ms">
      <div class="action-card-icon">🚀</div>
      <div>
        <div class="action-card-label">Start Game</div>
        <div class="action-card-sub">Pick a team and begin the quiz</div>
      </div>
    </a>

  </div>

</div>

@endsection