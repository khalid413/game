@extends('layouts.app')

@section('content')

<style>
.edit-wrap {
  max-width: 640px;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 2rem;
  animation: fadeIn 0.6s cubic-bezier(0.16,1,0.3,1) both;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}

.page-title {
  display: flex;
  align-items: center;
  gap: 16px;
}

.page-title-icon {
  width: 56px; height: 56px;
  background: linear-gradient(135deg, #d4a017, #f7c948);
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  box-shadow: 0 8px 28px rgba(247,201,72,0.35);
  flex-shrink: 0;
}

.page-title h1 {
  font-size: clamp(1.5rem, 4vw, 2.2rem);
  font-weight: 900;
  color: #eaf6f4;
}

.page-title h1 span {
  background: linear-gradient(90deg, #f7c948, #4ecdc4);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Form card */
.form-card {
  background: #1c2f42;
  border: 2px solid rgba(78,205,196,0.2);
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
  background: linear-gradient(90deg, #d4a017, #f7c948, #4ecdc4, #f7c948, #d4a017);
  background-size: 200% 100%;
  animation: borderFlow 3s linear infinite;
}

@keyframes borderFlow {
  0%   { background-position: 0%; }
  100% { background-position: 200%; }
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

/* Fields */
.field { margin-bottom: 1.6rem; }

.field label {
  display: block;
  font-size: 15px;
  font-weight: 700;
  color: #7fb5ae;
  margin-bottom: 0.55rem;
}

.field input[type="text"] {
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
  transition: border-color 0.2s, box-shadow 0.2s;
}

.field input[type="text"]:focus {
  border-color: #4ecdc4;
  box-shadow: 0 0 0 4px rgba(78,205,196,0.1);
}

.field input[type="text"]::placeholder { color: rgba(127,181,174,0.45); }

/* Image upload */
.image-upload-area {
  display: flex;
  align-items: center;
  gap: 1.4rem;
  flex-wrap: wrap;
}

.avatar-preview {
  width: 100px; height: 100px;
  border-radius: 20px;
  background: #162534;
  border: 2px solid rgba(78,205,196,0.35);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 36px;
  flex-shrink: 0;
  overflow: hidden;
  transition: border-color 0.2s;
  position: relative;
}

.avatar-preview img {
  width: 100%; height: 100%;
  object-fit: cover;
}

.avatar-preview.no-image {
  border-style: dashed;
  border-color: rgba(78,205,196,0.3);
}

.avatar-preview.no-image img { display: none; }
.avatar-preview.no-image .placeholder-icon { display: flex; }
.placeholder-icon { display: none; }

.avatar-preview.has-new { border-style: solid; border-color: #4ecdc4; }

.upload-btn-label {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #162534;
  border: 2px solid rgba(78,205,196,0.18);
  border-radius: 12px;
  padding: 11px 22px;
  font-family: 'Cairo', sans-serif;
  font-size: 15px;
  font-weight: 700;
  color: #4ecdc4;
  cursor: pointer;
  transition: border-color 0.2s, background 0.2s, transform 0.18s;
  margin-bottom: 0.5rem;
}

.upload-btn-label:hover {
  border-color: #4ecdc4;
  background: rgba(78,205,196,0.08);
  transform: translateY(-2px);
}

.upload-hint {
  font-size: 13px;
  font-weight: 700;
  color: #7fb5ae;
}

input[type="file"] { display: none; }

/* Divider */
.divider {
  height: 1px;
  background: rgba(78,205,196,0.18);
  margin: 1.8rem 0;
}

/* Members */
.members-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.members-title {
  font-size: 15px;
  font-weight: 700;
  color: #7fb5ae;
}

.add-member-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(78,205,196,0.1);
  border: 1.5px solid rgba(78,205,196,0.3);
  border-radius: 50px;
  padding: 8px 20px;
  font-family: 'Cairo', sans-serif;
  font-size: 14px;
  font-weight: 900;
  color: #4ecdc4;
  cursor: pointer;
  transition: background 0.2s, border-color 0.2s, transform 0.18s;
}

.add-member-btn:hover {
  background: rgba(78,205,196,0.18);
  border-color: #4ecdc4;
  transform: translateY(-2px);
}

#members-wrapper { display: flex; flex-direction: column; gap: 10px; }

.member-item {
  display: flex;
  gap: 10px;
  align-items: center;
  animation: memberIn 0.35s cubic-bezier(0.16,1,0.3,1) both;
}

@keyframes memberIn {
  from { opacity: 0; transform: translateX(10px); }
  to   { opacity: 1; transform: translateX(0); }
}

.member-item input[type="text"] {
  flex: 1;
  background: #162534;
  border: 2px solid rgba(78,205,196,0.18);
  border-radius: 12px;
  padding: 12px 16px;
  font-family: 'Cairo', sans-serif;
  font-size: 15px;
  font-weight: 700;
  color: #eaf6f4;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}

.member-item input[type="text"]:focus {
  border-color: #4ecdc4;
  box-shadow: 0 0 0 4px rgba(78,205,196,0.1);
}

.member-item input[type="text"]::placeholder { color: rgba(127,181,174,0.45); }

.remove-btn {
  width: 42px; height: 42px;
  background: rgba(239,68,68,0.1);
  border: 1.5px solid rgba(239,68,68,0.25);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  color: #ef4444;
  cursor: pointer;
  flex-shrink: 0;
  transition: background 0.2s, border-color 0.2s, transform 0.18s;
}

.remove-btn:hover {
  background: rgba(239,68,68,0.2);
  border-color: #ef4444;
  transform: scale(1.08);
}

/* Submit */
.submit-area {
  display: flex;
  justify-content: center;
  margin-top: 2rem;
}

.submit-btn {
  background: linear-gradient(135deg, #d4a017, #f7c948);
  border: none;
  border-radius: 50px;
  padding: 18px 90px;
  font-family: 'Cairo', sans-serif;
  font-size: 21px;
  font-weight: 900;
  color: #0f1f2e;
  cursor: pointer;
  transition: transform 0.2s, box-shadow 0.25s;
  box-shadow: 0 6px 28px rgba(247,201,72,0.35);
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
  box-shadow: 0 12px 40px rgba(247,201,72,0.5);
}

.submit-btn:active { transform: scale(0.97); }

@media (max-width: 480px) {
  .form-card  { padding: 1.8rem 1.4rem; }
  .submit-btn { padding: 16px 60px; font-size: 18px; }
}
</style>

<div class="edit-wrap">

  <!-- Title -->
  <div class="page-title">
    <div class="page-title-icon">✏️</div>
    <h1>تعديل <span>{{ $team->name }}</span></h1>
  </div>

  <!-- Form Card -->
  <div class="form-card">
    <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <!-- Team Name -->
      <div class="section-label">معلومات الفريق</div>
      <div class="field">
        <label>اسم الفريق</label>
        <input type="text" name="name" value="{{ old('name', $team->name) }}" placeholder="أدخل اسم الفريق..." required>
      </div>

      <!-- Image Upload -->
      <div class="field">
        <label>صورة الفريق</label>
        <div class="image-upload-area">
          <div class="avatar-preview {{ $team->image ? '' : 'no-image' }}" id="avatarPreview">
            @if($team->image)
              <img id="imagePreview" src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}">
            @else
              <span class="placeholder-icon" style="display:flex; font-size:36px;">🏆</span>
              <img id="imagePreview" src="#" alt="Preview" style="display:none;">
            @endif
          </div>
          <div>
            <label class="upload-btn-label" for="image">📁 تغيير الصورة</label>
            <p class="upload-hint">اتركه فارغاً للإبقاء على الصورة الحالية</p>
          </div>
        </div>
        <input type="file" name="image" id="image" accept="image/*">
      </div>

      <div class="divider"></div>

      <!-- Members -->
      <div class="section-label">أعضاء الفريق</div>
      <div class="members-header">
        <span class="members-title">قائمة الأعضاء</span>
        <button type="button" class="add-member-btn" onclick="addMemberField()">+ إضافة عضو</button>
      </div>

      <div id="members-wrapper">
        @foreach($team->members as $member)
          <div class="member-item">
            <input type="text" name="members[]" value="{{ $member->name }}" placeholder="اسم العضو..." required>
            <button type="button" class="remove-btn" onclick="removeMemberField(this)">✕</button>
          </div>
        @endforeach
      </div>

      <!-- Submit -->
      <div class="submit-area">
        <button type="submit" class="submit-btn">✓ حفظ التعديلات</button>
      </div>

    </form>
  </div>

</div>

<script>
  document.getElementById('image').addEventListener('change', function () {
    const preview = document.getElementById('imagePreview');
    const wrapper = document.getElementById('avatarPreview');

    if (this.files && this.files[0]) {
      const reader = new FileReader();
      reader.onload = e => {
        preview.src = e.target.result;
        preview.style.display = 'block';
        const placeholder = wrapper.querySelector('.placeholder-icon');
        if (placeholder) placeholder.style.display = 'none';
        wrapper.classList.remove('no-image');
        wrapper.classList.add('has-new');
      };
      reader.readAsDataURL(this.files[0]);
    }
  });

  function addMemberField() {
    const wrapper = document.getElementById('members-wrapper');
    const div = document.createElement('div');
    div.className = 'member-item';
    div.innerHTML = `
      <input type="text" name="members[]" placeholder="اسم العضو..." required>
      <button type="button" class="remove-btn" onclick="removeMemberField(this)">✕</button>
    `;
    wrapper.appendChild(div);
  }

  function removeMemberField(btn) {
    const wrapper = document.getElementById('members-wrapper');
    if (wrapper.querySelectorAll('.member-item').length > 1) {
      btn.parentElement.remove();
    }
  }
</script>

@endsection