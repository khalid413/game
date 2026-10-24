@extends('layouts.app')

@section('content')

<style>
.create-wrap {
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
  border: 2px dashed rgba(78,205,196,0.35);
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
  display: none;
  border-radius: 18px;
}

.avatar-preview.has-image { border-style: solid; border-color: #4ecdc4; }
.avatar-preview.has-image img { display: block; }
.avatar-preview.has-image .placeholder-icon { display: none; }

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
  background: linear-gradient(135deg, #2bb5ab, #4ecdc4);
  border: none;
  border-radius: 50px;
  padding: 18px 90px;
  font-family: 'Cairo', sans-serif;
  font-size: 21px;
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

@media (max-width: 480px) {
  .form-card  { padding: 1.8rem 1.4rem; }
  .submit-btn { padding: 16px 60px; font-size: 18px; }
}
</style>

<div class="create-wrap">

  <!-- Title -->
  <div class="page-title">
    <div class="page-title-icon">🛡️</div>
    <h1>إضافة <span>فريق جديد</span></h1>
  </div>

  <!-- Form Card -->
  <div class="form-card">
    <form action="{{ route('teams.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Team Name -->
      <div class="section-label">معلومات الفريق</div>
      <div class="field">
        <label>اسم الفريق</label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="أدخل اسم الفريق..." required>
      </div>

      <!-- Image Upload -->
      <div class="field">
        <label>صورة الفريق</label>
        <div class="image-upload-area">
          <div class="avatar-preview" id="avatarPreview">
            <span class="placeholder-icon">🏆</span>
            <img id="imagePreview" src="#" alt="Preview">
          </div>
          <div>
            <label class="upload-btn-label" for="image">📁 اختر صورة</label>
            <p class="upload-hint">اختياري — شعار أو صورة للفريق</p>
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
        <div class="member-item">
          <input type="text" name="members[]" placeholder="اسم العضو..." required>
          <button type="button" class="remove-btn" onclick="removeMemberField(this)">✕</button>
        </div>
      </div>

      <!-- Submit -->
      <div class="submit-area">
        <button type="submit" class="submit-btn">✓ حفظ الفريق</button>
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
      reader.onload = e => { preview.src = e.target.result; wrapper.classList.add('has-image'); };
      reader.readAsDataURL(this.files[0]);
    } else {
      preview.src = '#';
      wrapper.classList.remove('has-image');
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