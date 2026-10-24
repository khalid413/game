@extends('layouts.app')

@section('content')

<style>
.questions-wrap {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  animation: fadeIn 0.6s cubic-bezier(0.16,1,0.3,1) both;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* Page header */
.page-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
  flex-wrap: wrap;
}

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
  font-size: clamp(1.5rem, 4vw, 2.2rem);
  font-weight: 900;
  color: #eaf6f4;
}

.page-title h1 span {
  background: linear-gradient(90deg, #4ecdc4, #f7c948);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.add-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, #2bb5ab, #4ecdc4);
  border: none;
  border-radius: 50px;
  padding: 12px 28px;
  font-family: 'Cairo', sans-serif;
  font-size: 16px;
  font-weight: 900;
  color: #0f1f2e;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.25s;
  box-shadow: 0 6px 24px rgba(78,205,196,0.35);
  position: relative;
  overflow: hidden;
  white-space: nowrap;
}

.add-btn::before {
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

.add-btn:hover {
  transform: translateY(-2px) scale(1.03);
  box-shadow: 0 10px 36px rgba(78,205,196,0.5);
  color: #0f1f2e;
}

/* Empty state */
.empty-state {
  background: #1c2f42;
  border: 2px dashed rgba(78,205,196,0.2);
  border-radius: 22px;
  padding: 4rem 2rem;
  text-align: center;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 1rem;
}

.empty-icon {
  font-size: 52px;
  opacity: 0.6;
}

.empty-text {
  font-size: 1.1rem;
  font-weight: 700;
  color: #7fb5ae;
}

/* Question cards list */
.questions-list {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.question-card {
  background: #1c2f42;
  border: 2px solid rgba(78,205,196,0.15);
  border-radius: 20px;
  overflow: hidden;
  transition: border-color 0.22s, box-shadow 0.22s, transform 0.2s;
  opacity: 0;
  animation: cardIn 0.5s cubic-bezier(0.16,1,0.3,1) forwards;
  position: relative;
}

.question-card::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, #2bb5ab, #4ecdc4, #f7c948, #4ecdc4, #2bb5ab);
  background-size: 200% 100%;
  opacity: 0;
  transition: opacity 0.25s;
  animation: borderFlow 3s linear infinite;
}

@keyframes borderFlow {
  0%   { background-position: 0% 0%; }
  100% { background-position: 200% 0%; }
}

.question-card:hover { border-color: rgba(78,205,196,0.4); box-shadow: 0 8px 32px rgba(78,205,196,0.1); transform: translateY(-2px); }
.question-card:hover::after { opacity: 1; }

@keyframes cardIn {
  from { opacity: 0; transform: translateY(18px) scale(0.98); }
  to   { opacity: 1; transform: translateY(0) scale(1); }
}

/* Question header */
.q-header {
  display: flex;
  align-items: flex-start;
  gap: 16px;
  padding: 1.4rem 1.6rem 1.2rem;
}

.q-number {
  flex-shrink: 0;
  width: 44px; height: 44px;
  background: rgba(78,205,196,0.1);
  border: 2px solid rgba(78,205,196,0.25);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 17px;
  font-weight: 900;
  color: #4ecdc4;
  margin-top: 2px;
}

.q-text {
  font-size: clamp(1rem, 2.5vw, 1.2rem);
  font-weight: 900;
  color: #eaf6f4;
  line-height: 1.6;
  flex: 1;
}

/* Divider */
.q-divider {
  height: 1px;
  background: rgba(78,205,196,0.1);
  margin: 0 1.6rem;
}

/* Answers */
.answers-list {
  padding: 1rem 1.6rem 1.4rem;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.answer-row {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 14px;
  border-radius: 12px;
  background: #162534;
  border: 1.5px solid rgba(78,205,196,0.1);
  transition: border-color 0.2s;
}

.answer-row.correct {
  background: rgba(34,197,94,0.08);
  border-color: rgba(34,197,94,0.3);
}

.answer-dot {
  width: 10px; height: 10px;
  border-radius: 50%;
  background: rgba(78,205,196,0.25);
  flex-shrink: 0;
}

.answer-row.correct .answer-dot {
  background: #22c55e;
  box-shadow: 0 0 8px rgba(34,197,94,0.5);
}

.answer-row-text {
  font-size: 14px;
  font-weight: 700;
  color: #7fb5ae;
  flex: 1;
  line-height: 1.4;
}

.answer-row.correct .answer-row-text { color: #86efac; }

.correct-badge {
  font-size: 12px;
  font-weight: 900;
  background: rgba(34,197,94,0.15);
  border: 1px solid rgba(34,197,94,0.35);
  color: #22c55e;
  border-radius: 50px;
  padding: 3px 12px;
  white-space: nowrap;
}

@media (max-width: 480px) {
  .q-header { padding: 1.1rem 1.2rem 1rem; gap: 12px; }
  .answers-list { padding: 0.8rem 1.2rem 1.2rem; }
}
</style>

<div class="questions-wrap">

  <!-- Header -->
  <div class="page-header">
    <div class="page-title">
      <div class="page-title-icon">❓</div>
      <h1>قائمة <span>الأسئلة</span></h1>
    </div>
    <a href="{{ route('questions.create') }}" class="add-btn">+ إضافة سؤال</a>
  </div>

  <!-- Content -->
  @if($questions->count())
    <div class="questions-list">
      @foreach($questions as $question)
        <div class="question-card" style="animation-delay: {{ $loop->index * 70 }}ms">

          <!-- Question text -->
          <div class="q-header">
            <div class="q-number">{{ $loop->iteration }}</div>
            <p class="q-text">{{ $question->question_text }}</p>
          </div>

          <div class="q-divider"></div>

          <!-- Answers -->
          <div class="answers-list">
            @foreach($question->answers as $answer)
              <div class="answer-row {{ $answer->is_correct ? 'correct' : '' }}">
                <div class="answer-dot"></div>
                <span class="answer-row-text">{{ $answer->answer_text }}</span>
                @if($answer->is_correct)
                  <span class="correct-badge">✓ صحيحة</span>
                @endif
              </div>
            @endforeach
          </div>

        </div>
      @endforeach
    </div>

  @else
    <div class="empty-state">
      <div class="empty-icon">📭</div>
      <p class="empty-text">لا توجد أسئلة بعد. ابدأ بإضافة سؤالك الأول!</p>
      <a href="{{ route('questions.create') }}" class="add-btn" style="margin-top: 0.5rem;">+ إضافة سؤال</a>
    </div>
  @endif

</div>

@endsection