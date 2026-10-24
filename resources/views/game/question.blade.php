<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>مسابقة</title>
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
  --danger:  #ef4444;
}

body {
  min-height: 100vh;
  background: var(--bg);
  font-family: 'Cairo', sans-serif;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 1rem;
  position: relative;
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
  width: min(800px, 96vw);
  display: flex;
  flex-direction: column;
  gap: 1.8rem;
}

/* Header */
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 14px;
  flex-wrap: wrap;
  animation: slideDown 0.55s cubic-bezier(0.16,1,0.3,1) both;
}

@keyframes slideDown {
  from { opacity: 0; transform: translateY(-18px); }
  to   { opacity: 1; transform: translateY(0); }
}

.team-badge,
.q-counter,
.timer-box {
  display: flex;
  align-items: center;
  gap: 12px;
  background: var(--card);
  border: 1.5px solid var(--border);
  border-radius: 50px;
  padding: 12px 22px;
}

.team-dot {
  width: 12px; height: 12px;
  background: var(--accent);
  border-radius: 50%;
  flex-shrink: 0;
  animation: livePulse 2s ease infinite;
}

@keyframes livePulse {
  0%,100% { box-shadow: 0 0 0 0 rgba(78,205,196,0.6); }
  50%     { box-shadow: 0 0 0 9px rgba(78,205,196,0); }
}

.team-name {
  font-size: 20px;
  font-weight: 900;
  color: var(--accent);
}

.q-counter {
  font-size: 18px;
  font-weight: 900;
  color: var(--muted);
}

.timer-box {
  min-width: 120px;
  justify-content: center;
  font-size: 18px;
  font-weight: 900;
  color: var(--accent);
  transition: all 0.25s ease;
}

.timer-box.warning {
  color: var(--danger);
  border-color: rgba(239,68,68,0.45);
  box-shadow: 0 0 0 4px rgba(239,68,68,0.10);
  animation: pulseDanger 1s infinite;
}

@keyframes pulseDanger {
  0%,100% { transform: scale(1); }
  50%     { transform: scale(1.04); }
}

/* Progress bar */
.progress-wrap {
  height: 10px;
  background: var(--surface);
  border-radius: 10px;
  overflow: hidden;
  border: 1px solid var(--border);
  animation: slideDown 0.55s 0.08s cubic-bezier(0.16,1,0.3,1) both;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--accent2), var(--accent), var(--gold));
  border-radius: 10px;
  transition: width 1.2s cubic-bezier(0.16,1,0.3,1);
  position: relative;
  overflow: hidden;
}

.progress-fill::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
  animation: sheen 2.5s ease infinite;
}

@keyframes sheen {
  0%  { transform: translateX(-100%); }
  60% { transform: translateX(250%); }
  100%{ transform: translateX(250%); }
}

/* Question card */
.question-card {
  background: var(--card);
  border: 2px solid rgba(78,205,196,0.2);
  border-radius: 22px;
  padding: 3rem 3.2rem;
  text-align: center;
  animation: popIn 0.65s 0.18s cubic-bezier(0.16,1,0.3,1) both;
  position: relative;
  overflow: hidden;
}

.question-card::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--accent2), var(--accent), var(--gold), var(--accent), var(--accent2));
  background-size: 200% 100%;
  animation: borderFlow 3s linear infinite;
}

@keyframes borderFlow {
  0%   { background-position: 0% 0%; }
  100% { background-position: 200% 0%; }
}

@keyframes popIn {
  from { opacity: 0; transform: scale(0.94) translateY(14px); filter: blur(3px); }
  to   { opacity: 1; transform: scale(1) translateY(0); filter: blur(0); }
}

.question-label {
  font-size: 16px;
  font-weight: 700;
  color: var(--accent);
  margin-bottom: 1.2rem;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 14px;
}

.question-label::before,
.question-label::after {
  content: '';
  display: block;
  height: 2px;
  width: 55px;
  background: linear-gradient(90deg, transparent, var(--accent));
  opacity: 0.4;
  border-radius: 2px;
}
.question-label::before { transform: scaleX(-1); }

.question-text {
  font-size: clamp(1.65rem, 4.5vw, 2.4rem);
  font-weight: 900;
  color: var(--text);
  line-height: 1.7;
}

/* Answers */
.answers-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin-bottom: 1.6rem;
}

@media (max-width: 640px) {
  .answers-grid { grid-template-columns: 1fr; }
  .question-card { padding: 2.2rem 1.8rem; }
  .header { justify-content: center; }
}

.answer-btn {
  position: relative;
  display: flex;
  align-items: center;
  gap: 18px;
  background: var(--card);
  border: 2px solid var(--border);
  border-radius: 16px;
  padding: 1.5rem 1.8rem;
  cursor: pointer;
  text-align: right;
  transition: border-color 0.22s, background 0.22s, transform 0.18s, box-shadow 0.22s;
  opacity: 0;
  transform: translateY(20px) scale(0.97);
  overflow: hidden;
}

.answer-btn.visible {
  opacity: 1;
  animation: answerIn 0.55s cubic-bezier(0.16,1,0.3,1) forwards;
}

@keyframes answerIn {
  from { opacity: 0; transform: translateY(20px) scale(0.97); }
  to   { opacity: 1; transform: translateY(0) scale(1); }
}

.answer-btn:hover {
  background: var(--surface);
  border-color: var(--accent);
  transform: translateY(-3px) scale(1.015);
  box-shadow: 0 8px 28px rgba(78,205,196,0.15);
}

.answer-btn:active { transform: scale(0.98); }

.answer-btn.selected {
  background: rgba(78,205,196,0.12);
  border-color: var(--accent);
  box-shadow: 0 0 0 4px rgba(78,205,196,0.12);
}

.answer-btn.selected::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(110deg, transparent 35%, rgba(255,255,255,0.04) 50%, transparent 65%);
  animation: shimmer 1.8s ease infinite;
}

@keyframes shimmer {
  0%   { transform: translateX(-120%); }
  100% { transform: translateX(220%); }
}

.answer-letter {
  flex-shrink: 0;
  width: 54px; height: 54px;
  background: rgba(78,205,196,0.1);
  border: 2px solid rgba(78,205,196,0.3);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 23px;
  font-weight: 900;
  color: var(--accent);
  transition: all 0.22s;
}

.answer-btn:hover .answer-letter {
  background: rgba(78,205,196,0.22);
  border-color: var(--accent);
  box-shadow: 0 0 14px rgba(78,205,196,0.3);
}

.answer-btn.selected .answer-letter {
  background: var(--accent);
  color: var(--bg);
  border-color: var(--accent);
  box-shadow: 0 0 22px rgba(78,205,196,0.55);
}

.answer-text {
  font-size: clamp(1.1rem, 3vw, 1.4rem);
  font-weight: 900;
  color: var(--text);
  line-height: 1.5;
  flex: 1;
}

.answer-btn.selected .answer-text { color: #fff; }

.answer-btn.correct {
  opacity: 1;
  background: rgba(34,197,94,0.15);
  border-color: #22c55e;
  box-shadow: 0 0 0 4px rgba(34,197,94,0.15);
  pointer-events: none;
}
.answer-btn.correct .answer-letter {
  background: #22c55e;
  color: #0a1a0f;
  border-color: #22c55e;
  box-shadow: 0 0 22px rgba(34,197,94,0.6);
}
.answer-btn.correct .answer-text { color: #86efac; }

.answer-btn.wrong {
  opacity: 1;
  background: rgba(239,68,68,0.15);
  border-color: #ef4444;
  box-shadow: 0 0 0 4px rgba(239,68,68,0.15);
  pointer-events: none;
  animation: shake 0.45s cubic-bezier(0.36,0.07,0.19,0.97) both;
  transform-origin: center center;
}
.answer-btn.wrong .answer-letter {
  background: #ef4444;
  color: #fff;
  border-color: #ef4444;
  box-shadow: 0 0 22px rgba(239,68,68,0.55);
}
.answer-btn.wrong .answer-text { color: #fca5a5; }

@keyframes shake {
  0%,100% { transform: rotate(0deg) translateX(0); }
  15%     { transform: rotate(-1.5deg) translateX(-5px); }
  30%     { transform: rotate(1.5deg) translateX(5px); }
  45%     { transform: rotate(-1deg) translateX(-3px); }
  60%     { transform: rotate(1deg) translateX(3px); }
  75%     { transform: rotate(-0.5deg) translateX(-2px); }
  90%     { transform: rotate(0.5deg) translateX(2px); }
}

.answer-btn.dimmed {
  opacity: 0.4;
  pointer-events: none;
  filter: grayscale(40%);
}

/* Submit */
.submit-area {
  display: flex;
  justify-content: center;
  opacity: 0;
  transform: translateY(12px);
  transition: opacity 0.4s, transform 0.4s;
}

.submit-area.show {
  opacity: 1;
  transform: translateY(0);
}

.submit-btn {
  background: linear-gradient(135deg, var(--accent2), var(--accent));
  border: none;
  border-radius: 50px;
  padding: 18px 80px;
  font-family: 'Cairo', sans-serif;
  font-size: 22px;
  font-weight: 900;
  color: #0f1f2e;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.25s;
  box-shadow: 0 6px 28px rgba(78,205,196,0.4);
  position: relative;
  overflow: hidden;
}

.submit-btn::before {
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

.submit-btn:hover {
  transform: translateY(-3px) scale(1.03);
  box-shadow: 0 12px 40px rgba(78,205,196,0.55);
}

.submit-btn:active { transform: scale(0.97); }

.submit-btn:disabled {
  opacity: 0.7;
  cursor: not-allowed;
  transform: none;
}

/* Timeout state */
.timeout-note {
  display: none;
  text-align: center;
  color: #fca5a5;
  font-weight: 900;
  font-size: 18px;
  margin-top: 10px;
}

.timeout-note.show {
  display: block;
}
</style>
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>

<div class="container">

  <div class="header">
    <div class="team-badge">
      <div class="team-dot"></div>
      <span class="team-name">{{ $team->name }}</span>
    </div>

    <div class="q-counter">
      سؤال {{ $questionIndex ?? 1 }} من {{ $totalQuestions ?? 50 }}
    </div>

    <div class="timer-box" id="timer-box">
      ⏳ <span id="timer-text">15</span> ثانية
    </div>
  </div>

  <div class="progress-wrap">
    @php $total = !empty($totalQuestions) ? $totalQuestions : 1; @endphp
    <div class="progress-fill" style="width: {{ (($questionIndex ?? 1) / $total) * 100 }}%;"></div>
  </div>

  <div class="question-card">
    <div class="question-label">السؤال</div>
    <p class="question-text">{{ $question->question_text }}</p>
  </div>

  <form method="POST" action="{{ route('game.submit', [$team->id, $question->id]) }}" id="quiz-form">
    @csrf

    <div class="answers-grid">
      @foreach($question->answers as $index => $answer)
        @php $letters = ['أ','ب','ج','د']; @endphp
        <button
          type="button"
          class="answer-btn"
          data-answer-id="{{ $answer->id }}"
          data-correct="{{ $answer->is_correct ? '1' : '0' }}"
        >
          <div class="answer-letter">{{ $letters[$index] ?? '؟' }}</div>
          <span class="answer-text">{{ $answer->answer_text }}</span>
        </button>
      @endforeach
    </div>

    <input type="hidden" name="answer_id" id="selected-answer" value="">

    <div class="submit-area" id="submit-area">
      <button type="button" class="submit-btn" id="confirm-btn">✓ تأكيد الإجابة</button>
    </div>

    <div class="timeout-note" id="timeout-note">انتهى الوقت</div>
  </form>
</div>

<script>
  const QUESTION_TIME = 30; // change it from here

  const form         = document.getElementById('quiz-form');
  const btns         = document.querySelectorAll('.answer-btn');
  const hiddenInput  = document.getElementById('selected-answer');
  const submitArea   = document.getElementById('submit-area');
  const confirmBtn   = document.getElementById('confirm-btn');
  const timerBox     = document.getElementById('timer-box');
  const timerText    = document.getElementById('timer-text');
  const timeoutNote  = document.getElementById('timeout-note');

  let locked = false;
  let timeLeft = QUESTION_TIME;
  let countdown = null;

  btns.forEach((btn, i) => {
    setTimeout(() => btn.classList.add('visible'), 500 + i * 270);
  });

  function lockAllButtons() {
    btns.forEach(btn => {
      btn.style.pointerEvents = 'none';
    });
  }

  function startTimer() {
    timerText.textContent = timeLeft;

    countdown = setInterval(() => {
      if (locked) {
        clearInterval(countdown);
        return;
      }

      timeLeft--;
      timerText.textContent = timeLeft;

      if (timeLeft <= 3) {
        timerBox.classList.add('warning');
      }

      if (timeLeft <= 0) {
        clearInterval(countdown);
        handleTimeout();
      }
    }, 1000);
  }

  function handleTimeout() {
    if (locked) return;

    locked = true;
    lockAllButtons();

    submitArea.classList.remove('show');
    timeoutNote.classList.add('show');
    timerText.textContent = '0';
    timerBox.classList.add('warning');

    // reveal correct answer when no answer selected
    let hasSelected = !!hiddenInput.value;
    let selected = document.querySelector('.answer-btn.selected');
    let selectedId = selected ? selected.dataset.answerId : null;

    btns.forEach(btn => {
      btn.classList.remove('selected', 'correct', 'wrong', 'dimmed');
    });

    btns.forEach((btn, i) => {
      setTimeout(() => {
        if (btn.dataset.correct === '1') {
          btn.classList.add('correct');
        } else if (hasSelected && btn.dataset.answerId === selectedId) {
          btn.classList.add('wrong');
        } else {
          btn.classList.add('dimmed');
        }
      }, i * 150);
    });

    setTimeout(() => {
form.submit();
    }, btns.length * 150 + 900);
  }

  btns.forEach(btn => {
    btn.addEventListener('click', function () {
      if (locked) return;

      btns.forEach(b => b.classList.remove('selected'));
      this.classList.add('selected');
      hiddenInput.value = this.dataset.answerId;
      submitArea.classList.add('show');
    });
  });

  confirmBtn.addEventListener('click', function () {
    if (locked) return;

    const selected = document.querySelector('.answer-btn.selected');
    if (!selected || !hiddenInput.value) return;

    locked = true;
    clearInterval(countdown);

    confirmBtn.disabled = true;

    const selectedId = selected.dataset.answerId;

    btns.forEach(btn => {
      btn.classList.remove('selected', 'correct', 'wrong', 'dimmed');
      btn.style.pointerEvents = 'none';
    });

    btns.forEach((btn, i) => {
      setTimeout(() => {
        if (btn.dataset.correct === '1') {
          btn.classList.add('correct');
        } else if (btn.dataset.answerId === selectedId) {
          btn.classList.add('wrong');
        } else {
          btn.classList.add('dimmed');
        }
      }, i * 150);
    });

    setTimeout(() => {
      form.submit();
    }, btns.length * 150 + 700);
  });

  startTimer();
</script>
</body>
</html>