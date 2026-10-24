@extends('layouts.app')

@section('content')

<style>
.create-wrap {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  max-width: 720px;
  margin: 0 auto;
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

/* Form card */
.form-card {
  background: #1c2f42;
  border: 2px solid rgba(78,205,196,0.18);
  border-radius: 24px;
  padding: 2.4rem 2.6rem;
  position: relative;
  overflow: hidden;
}

.form-card::after {
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

/* Section label */
.section-label {
  font-size: 13px;
  font-weight: 700;
  color: #4ecdc4;
  letter-spacing: 0.08em;
  margin-bottom: 0.8rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.section-label::after {
  content: '';
  flex: 1;
  height: 1px;
  background: rgba(78,205,196,0.18);
}

/* Textarea */
.field { margin-bottom: 1.8rem; }

.field label {
  display: block;
  font-size: 15px;
  font-weight: 700;
  color: #7fb5ae;
  margin-bottom: 0.55rem;
}

.field textarea {
  width: 100%;
  background: #162534;
  border: 2px solid rgba(78,205,196,0.18);
  border-radius: 14px;
  padding: 14px 18px;
  font-family: 'Cairo', sans-serif;
  font-size: 16px;
  font-weight: 700;
  color: #eaf6f4;
  outline: none;
  resize: vertical;
  min-height: 110px;
  transition: border-color 0.2s, box-shadow 0.2s;
  line-height: 1.6;
}

.field textarea:focus {
  border-color: #4ecdc4;
  box-shadow: 0 0 0 4px rgba(78,205,196,0.1);
}

.field textarea::placeholder { color: rgba(127,181,174,0.4); }

/* Answers grid */
.answers-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
  margin-bottom: 1.8rem;
}

@media (max-width: 540px) {
  .answers-grid { grid-template-columns: 1fr; }
  .form-card { padding: 1.8rem 1.4rem; }
}

.answer-field {
  position: relative;
}

.answer-field label {
  display: block;
  font-size: 14px;
  font-weight: 700;
  color: #7fb5ae;
  margin-bottom: 0.5rem;
  display: flex;
  align-items: center;
  gap: 8px;
}

.answer-letter-tag {
  width: 28px; height: 28px;
  background: rgba(78,205,196,0.1);
  border: 1.5px solid rgba(78,205,196,0.25);
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  font-weight: 900;
  color: #4ecdc4;
  flex-shrink: 0;
}

.answer-field input[type="text"] {
  width: 100%;
  background: #162534;
  border: 2px solid rgba(78,205,196,0.15);
  border-radius: 13px;
  padding: 12px 16px;
  font-family: 'Cairo', sans-serif;
  font-size: 15px;
  font-weight: 700;
  color: #eaf6f4;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}

.answer-field input[type="text"]:focus {
  border-color: #4ecdc4;
  box-shadow: 0 0 0 4px rgba(78,205,196,0.1);
}

.answer-field input[type="text"]::placeholder { color: rgba(127,181,174,0.35); }

/* Correct answer selector */
.correct-selector {
  margin-bottom: 2rem;
}

.correct-selector label {
  display: block;
  font-size: 15px;
  font-weight: 700;
  color: #7fb5ae;
  margin-bottom: 0.8rem;
}

.correct-options {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;
}

@media (max-width: 400px) {
  .correct-options { grid-template-columns: repeat(2, 1fr); }
}

.correct-option {
  position: relative;
}

.correct-option input[type="radio"] { display: none; }

.correct-option label {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  background: #162534;
  border: 2px solid rgba(78,205,196,0.15);
  border-radius: 12px;
  padding: 12px 8px;
  cursor: pointer;
  font-size: 15px;
  font-weight: 900;
  color: #7fb5ae;
  transition: border-color 0.2s, background 0.2s, color 0.2s, transform 0.18s;
  margin: 0;
}

.correct-option label:hover {
  border-color: #22c55e;
  background: rgba(34,197,94,0.06);
  color: #86efac;
  transform: translateY(-2px);
}

.correct-option input[type="radio"]:checked + label {
  border-color: #22c55e;
  background: rgba(34,197,94,0.12);
  color: #22c55e;
  box-shadow: 0 0 0 3px rgba(34,197,94,0.15);
}

.opt-letter {
  width: 26px; height: 26px;
  border-radius: 50%;
  background: rgba(34,197,94,0.1);
  border: 1.5px solid rgba(34,197,94,0.25);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  font-weight: 900;
}

/* Submit */
.submit-area {
  display: flex;
  justify-content: center;
}

.submit-btn {
  background: linear-gradient(135deg, #16a34a, #22c55e);
  border: none;
  border-radius: 50px;
  padding: 16px 80px;
  font-family: 'Cairo', sans-serif;
  font-size: 20px;
  font-weight: 900;
  color: #0a1a0f;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.25s;
  box-shadow: 0 6px 28px rgba(34,197,94,0.35);
  position: relative;
  overflow: hidden;
}

.submit-btn::before {
  content: '';
  position: absolute;
  top: 0; left: -80%;
  width: 60%; height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
  animation: btnShine 2.5s ease infinite;
}

@keyframes btnShine {
  0%  { left: -80%; }
  50% { left: 130%; }
  100%{ left: 130%; }
}

.submit-btn:hover {
  transform: translateY(-3px) scale(1.03);
  box-shadow: 0 12px 40px rgba(34,197,94,0.5);
}

.submit-btn:active { transform: scale(0.97); }
</style>

@php $letters = ['أ', 'ب', 'ج', 'د']; @endphp

<div class="create-wrap">

  <!-- Title -->
  <div class="page-title">
    <div class="page-title-icon">✏️</div>
    <h1>إضافة <span>سؤال جديد</span></h1>
  </div>

  <!-- Form Card -->
  <div class="form-card">
    <form action="{{ route('questions.store') }}" method="POST">
      @csrf

      <!-- Question text -->
      <div class="section-label">نص السؤال</div>
      <div class="field">
        <label>اكتب سؤالك هنا</label>
        <textarea name="question_text" placeholder="ما هو ..." required>{{ old('question_text') }}</textarea>
      </div>

      <!-- Answers -->
      <div class="section-label">الإجابات</div>
      <div class="answers-grid">
        @for($i = 0; $i < 4; $i++)
          <div class="answer-field">
            <label>
              <span class="answer-letter-tag">{{ $letters[$i] }}</span>
              الإجابة {{ $i + 1 }}
            </label>
            <input
              type="text"
              name="answers[]"
              placeholder="أدخل الإجابة..."
              value="{{ old('answers.' . $i) }}"
              required
            >
          </div>
        @endfor
      </div>

      <!-- Correct answer -->
      <div class="section-label">الإجابة الصحيحة</div>
      <div class="correct-selector">
        <label>اختر الإجابة الصحيحة</label>
        <div class="correct-options">
          @for($i = 0; $i < 4; $i++)
            <div class="correct-option">
              <input
                type="radio"
                name="correct_answer"
                id="correct_{{ $i }}"
                value="{{ $i }}"
                {{ old('correct_answer', 0) == $i ? 'checked' : '' }}
                required
              >
              <label for="correct_{{ $i }}">
                <span class="opt-letter">{{ $letters[$i] }}</span>
                الإجابة {{ $i + 1 }}
              </label>
            </div>
          @endfor
        </div>
      </div>

      <!-- Submit -->
      <div class="submit-area">
        <button type="submit" class="submit-btn">✓ حفظ السؤال</button>
      </div>

    </form>
  </div>

</div>

@endsection