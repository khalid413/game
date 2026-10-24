@extends('layouts.app')

@section('content')

<style>
.ranking-wrap {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  animation: fadeIn 0.6s cubic-bezier(0.16,1,0.3,1) both;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* Page title */
.page-title {
  display: flex;
  align-items: center;
  gap: 16px;
}

.page-title-icon {
  width: 56px; height: 56px;
  background: linear-gradient(135deg, #2bb5ab, #4ecdc4);
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  box-shadow: 0 8px 28px rgba(78,205,196,0.35);
  flex-shrink: 0;
}

.page-title h1 {
  font-size: clamp(1.6rem, 4vw, 2.4rem);
  font-weight: 900;
  color: #eaf6f4;
}

.page-title h1 span {
  background: linear-gradient(90deg, #4ecdc4, #f7c948);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Podium (top 3) */
.podium {
  display: flex;
  align-items: flex-end;
  justify-content: center;
  gap: 16px;
  padding: 1rem 0 0;
}

.podium-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  animation: podiumIn 0.7s cubic-bezier(0.16,1,0.3,1) both;
}

.podium-item:nth-child(1) { animation-delay: 0.1s; }
.podium-item:nth-child(2) { animation-delay: 0.0s; }
.podium-item:nth-child(3) { animation-delay: 0.2s; }

@keyframes podiumIn {
  from { opacity: 0; transform: translateY(30px); }
  to   { opacity: 1; transform: translateY(0); }
}

.podium-avatar {
  width: 68px; height: 68px;
  border-radius: 50%;
  background: rgba(78,205,196,0.1);
  border: 3px solid rgba(78,205,196,0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 28px;
  overflow: hidden;
  position: relative;
}

.podium-avatar img { width: 100%; height: 100%; object-fit: cover; }

.podium-item.first  .podium-avatar { border-color: #f7c948; box-shadow: 0 0 28px rgba(247,201,72,0.45); width: 84px; height: 84px; }
.podium-item.second .podium-avatar { border-color: #c0c0c0; box-shadow: 0 0 20px rgba(192,192,192,0.3); }
.podium-item.third  .podium-avatar { border-color: #cd7f32; box-shadow: 0 0 20px rgba(205,127,50,0.3); }

.podium-name {
  font-size: 14px;
  font-weight: 900;
  color: #eaf6f4;
  max-width: 110px;
  text-align: center;
  line-height: 1.3;
}

.podium-score {
  font-size: 13px;
  font-weight: 700;
  color: #7fb5ae;
}

.podium-block {
  border-radius: 14px 14px 0 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  font-weight: 900;
  color: #0f1f2e;
  width: 100px;
}

.podium-item.first  .podium-block { height: 100px; background: linear-gradient(135deg, #d4a017, #f7c948); width: 110px; }
.podium-item.second .podium-block { height: 75px;  background: linear-gradient(135deg, #888, #c0c0c0); }
.podium-item.third  .podium-block { height: 55px;  background: linear-gradient(135deg, #7a4a1e, #cd7f32); }

/* Table */
.rank-card {
  background: #1c2f42;
  border: 2px solid rgba(78,205,196,0.18);
  border-radius: 22px;
  overflow: hidden;
  position: relative;
}

.rank-card::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, #2bb5ab, #4ecdc4, #f7c948, #4ecdc4, #2bb5ab);
  background-size: 200% 100%;
  animation: borderFlow 3s linear infinite;
}

@keyframes borderFlow {
  0%   { background-position: 0% 0%; }
  100% { background-position: 200% 0%; }
}

.rank-table {
  width: 100%;
  border-collapse: collapse;
}

.rank-table thead tr {
  background: rgba(78,205,196,0.07);
  border-bottom: 1px solid rgba(78,205,196,0.18);
}

.rank-table th {
  padding: 16px 22px;
  font-size: 14px;
  font-weight: 900;
  color: #7fb5ae;
  text-align: right;
  letter-spacing: 0.05em;
}

.rank-table tbody tr {
  border-bottom: 1px solid rgba(78,205,196,0.08);
  transition: background 0.2s;
  opacity: 0;
  animation: rowIn 0.45s cubic-bezier(0.16,1,0.3,1) forwards;
}

.rank-table tbody tr:last-child { border-bottom: none; }
.rank-table tbody tr:hover { background: rgba(78,205,196,0.05); }

@keyframes rowIn {
  from { opacity: 0; transform: translateX(12px); }
  to   { opacity: 1; transform: translateX(0); }
}

.rank-table td {
  padding: 16px 22px;
  font-size: 15px;
  font-weight: 700;
  color: #eaf6f4;
  vertical-align: middle;
}

/* Rank badge */
.rank-badge {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 38px; height: 38px;
  border-radius: 50%;
  font-size: 16px;
  font-weight: 900;
  background: rgba(78,205,196,0.1);
  border: 1.5px solid rgba(78,205,196,0.25);
  color: #7fb5ae;
}

.rank-badge.gold   { background: rgba(247,201,72,0.15); border-color: #f7c948; color: #f7c948; font-size: 18px; }
.rank-badge.silver { background: rgba(192,192,192,0.12); border-color: #c0c0c0; color: #c0c0c0; font-size: 18px; }
.rank-badge.bronze { background: rgba(205,127,50,0.12); border-color: #cd7f32; color: #cd7f32; font-size: 18px; }

/* Team cell */
.team-cell {
  display: flex;
  align-items: center;
  gap: 14px;
}

.team-cell-avatar {
  width: 44px; height: 44px;
  border-radius: 50%;
  background: rgba(78,205,196,0.1);
  border: 2px solid rgba(78,205,196,0.2);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  overflow: hidden;
  flex-shrink: 0;
}

.team-cell-avatar img { width: 100%; height: 100%; object-fit: cover; }

/* Score chip */
.score-chip {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  background: rgba(78,205,196,0.1);
  border: 1.5px solid rgba(78,205,196,0.25);
  border-radius: 50px;
  padding: 6px 16px;
  font-size: 15px;
  font-weight: 900;
  color: #4ecdc4;
}

.rank-table tbody tr:nth-child(1) .score-chip { background: rgba(247,201,72,0.1); border-color: rgba(247,201,72,0.35); color: #f7c948; }
.rank-table tbody tr:nth-child(2) .score-chip { background: rgba(192,192,192,0.1); border-color: rgba(192,192,192,0.3); color: #c0c0c0; }
.rank-table tbody tr:nth-child(3) .score-chip { background: rgba(205,127,50,0.1); border-color: rgba(205,127,50,0.3); color: #cd7f32; }
</style>

@php $emojis = ['🦁','🐯','🦊','🐺','🦅','🐉','🦋','🌊','⚡','🔥','🌙','💫']; @endphp

<div class="ranking-wrap">

  <!-- Title -->
  <div class="page-title">
    <div class="page-title-icon">🏅</div>
    <h1>ترتيب <span>الفرق</span></h1>
  </div>

  <!-- Podium (top 3) -->
  @if($teams->count() >= 3)
  <div class="podium">

    {{-- 2nd --}}
    <div class="podium-item second">
      <div class="podium-avatar">
        @if($teams[1]->image)
          <img src="{{ asset('storage/' . $teams[1]->image) }}" alt="">
        @else
          {{ $emojis[1 % count($emojis)] }}
        @endif
      </div>
      <div class="podium-name">{{ $teams[1]->name }}</div>
      <div class="podium-score">{{ $teams[1]->score }} نقطة</div>
      <div class="podium-block">🥈</div>
    </div>

    {{-- 1st --}}
    <div class="podium-item first">
      <div class="podium-avatar">
        @if($teams[0]->image)
          <img src="{{ asset('storage/' . $teams[0]->image) }}" alt="">
        @else
          {{ $emojis[0 % count($emojis)] }}
        @endif
      </div>
      <div class="podium-name">{{ $teams[0]->name }}</div>
      <div class="podium-score">{{ $teams[0]->score }} نقطة</div>
      <div class="podium-block">🥇</div>
    </div>

    {{-- 3rd --}}
    <div class="podium-item third">
      <div class="podium-avatar">
        @if($teams[2]->image)
          <img src="{{ asset('storage/' . $teams[2]->image) }}" alt="">
        @else
          {{ $emojis[2 % count($emojis)] }}
        @endif
      </div>
      <div class="podium-name">{{ $teams[2]->name }}</div>
      <div class="podium-score">{{ $teams[2]->score }} نقطة</div>
      <div class="podium-block">🥉</div>
    </div>

  </div>
  @endif

  <!-- Full Table -->
  <div class="rank-card">
    <table class="rank-table">
      <thead>
        <tr>
          <th>الترتيب</th>
          <th>الفريق</th>
          <th>النتيجة</th>
        </tr>
      </thead>
      <tbody>
        @foreach($teams as $index => $team)
        <tr style="animation-delay: {{ $index * 70 }}ms">

          <td>
            @if($index === 0)
              <span class="rank-badge gold">🥇</span>
            @elseif($index === 1)
              <span class="rank-badge silver">🥈</span>
            @elseif($index === 2)
              <span class="rank-badge bronze">🥉</span>
            @else
              <span class="rank-badge">{{ $index + 1 }}</span>
            @endif
          </td>

          <td>
            <div class="team-cell">
              <div class="team-cell-avatar">
                @if($team->image)
                  <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}">
                @else
                  {{ $emojis[$index % count($emojis)] }}
                @endif
              </div>
              {{ $team->name }}
            </div>
          </td>

          <td>
            <span class="score-chip">⭐ {{ $team->score }}</span>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

</div>

@endsection