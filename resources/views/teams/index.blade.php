@extends('layouts.app')

@section('content')

<style>
.teams-wrap {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  animation: fadeIn 0.6s cubic-bezier(0.16,1,0.3,1) both;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}

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
  font-size: 15px;
  font-weight: 900;
  color: #0f1f2e;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.25s;
  box-shadow: 0 6px 24px rgba(78,205,196,0.35);
  white-space: nowrap;
  position: relative;
  overflow: hidden;
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

.empty-icon { font-size: 52px; opacity: 0.6; }
.empty-text { font-size: 1.1rem; font-weight: 700; color: #7fb5ae; }

/* Table card */
.table-card {
  background: #1c2f42;
  border: 2px solid rgba(78,205,196,0.18);
  border-radius: 22px;
  overflow: hidden;
  position: relative;
}

.table-card::after {
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

.teams-table {
  width: 100%;
  border-collapse: collapse;
}

.teams-table thead tr {
  background: rgba(78,205,196,0.07);
  border-bottom: 1px solid rgba(78,205,196,0.18);
}

.teams-table th {
  padding: 16px 20px;
  font-size: 13px;
  font-weight: 900;
  color: #7fb5ae;
  text-align: right;
  letter-spacing: 0.05em;
  white-space: nowrap;
}

.teams-table tbody tr {
  border-bottom: 1px solid rgba(78,205,196,0.08);
  transition: background 0.2s;
  opacity: 0;
  animation: rowIn 0.45s cubic-bezier(0.16,1,0.3,1) forwards;
}

.teams-table tbody tr:last-child { border-bottom: none; }
.teams-table tbody tr:hover { background: rgba(78,205,196,0.04); }

@keyframes rowIn {
  from { opacity: 0; transform: translateX(10px); }
  to   { opacity: 1; transform: translateX(0); }
}

.teams-table td {
  padding: 14px 20px;
  font-size: 15px;
  font-weight: 700;
  color: #eaf6f4;
  vertical-align: middle;
}

/* Number badge */
.num-badge {
  width: 34px; height: 34px;
  border-radius: 50%;
  background: rgba(78,205,196,0.1);
  border: 1.5px solid rgba(78,205,196,0.22);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  font-weight: 900;
  color: #4ecdc4;
}

/* Team avatar */
.team-avatar {
  width: 52px; height: 52px;
  border-radius: 14px;
  object-fit: cover;
  border: 2px solid rgba(78,205,196,0.25);
}

.avatar-placeholder {
  width: 52px; height: 52px;
  border-radius: 14px;
  background: rgba(78,205,196,0.08);
  border: 2px dashed rgba(78,205,196,0.2);
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
}

/* Members list */
.members-list {
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.member-tag {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  font-weight: 700;
  color: #7fb5ae;
}

.member-tag::before {
  content: '';
  width: 6px; height: 6px;
  border-radius: 50%;
  background: rgba(78,205,196,0.4);
  flex-shrink: 0;
}

/* Action buttons */
.actions { display: flex; gap: 8px; align-items: center; }

.edit-btn {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(247,201,72,0.1);
  border: 1.5px solid rgba(247,201,72,0.3);
  border-radius: 10px;
  padding: 8px 16px;
  font-family: 'Cairo', sans-serif;
  font-size: 13px;
  font-weight: 900;
  color: #f7c948;
  text-decoration: none;
  transition: background 0.2s, border-color 0.2s, transform 0.18s;
  white-space: nowrap;
}

.edit-btn:hover {
  background: rgba(247,201,72,0.18);
  border-color: #f7c948;
  transform: translateY(-2px);
  color: #f7c948;
}

.delete-btn {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(239,68,68,0.1);
  border: 1.5px solid rgba(239,68,68,0.25);
  border-radius: 10px;
  padding: 8px 16px;
  font-family: 'Cairo', sans-serif;
  font-size: 13px;
  font-weight: 900;
  color: #ef4444;
  cursor: pointer;
  transition: background 0.2s, border-color 0.2s, transform 0.18s;
  white-space: nowrap;
}

.delete-btn:hover {
  background: rgba(239,68,68,0.2);
  border-color: #ef4444;
  transform: translateY(-2px);
}

@media (max-width: 640px) {
  .teams-table th:nth-child(4),
  .teams-table td:nth-child(4) { display: none; }
}
</style>

<div class="teams-wrap">

  <!-- Header -->
  <div class="page-header">
    <div class="page-title">
      <div class="page-title-icon">🛡️</div>
      <h1>قائمة <span>الفرق</span></h1>
    </div>
    <a href="{{ route('teams.create') }}" class="add-btn">+ إضافة فريق</a>
  </div>

  @if($teams->count())
    <div class="table-card">
      <table class="teams-table">
        <thead>
          <tr>
            <th>#</th>
            <th>الصورة</th>
            <th>اسم الفريق</th>
            <th>الأعضاء</th>
            <th>الإجراءات</th>
          </tr>
        </thead>
        <tbody>
          @foreach($teams as $team)
            <tr style="animation-delay: {{ $loop->index * 60 }}ms">

              <td><span class="num-badge">{{ $loop->iteration }}</span></td>

              <td>
                @if($team->image)
                  <img src="{{ asset('storage/' . $team->image) }}" alt="{{ $team->name }}" class="team-avatar">
                @else
                  <div class="avatar-placeholder">🏆</div>
                @endif
              </td>

              <td>{{ $team->name }}</td>

              <td>
                <div class="members-list">
                  @foreach($team->members as $member)
                    <span class="member-tag">{{ $member->name }}</span>
                  @endforeach
                </div>
              </td>

              <td>
                <div class="actions">
                  <a href="{{ route('teams.edit', $team->id) }}" class="edit-btn">✏️ تعديل</a>
                  <form action="{{ route('teams.destroy', $team->id) }}" method="POST"
                    onsubmit="return confirm('هل تريد حذف هذا الفريق؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">🗑 حذف</button>
                  </form>
                </div>
              </td>

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  @else
    <div class="empty-state">
      <div class="empty-icon">📭</div>
      <p class="empty-text">لا توجد فرق بعد. ابدأ بإضافة فريقك الأول!</p>
      <a href="{{ route('teams.create') }}" class="add-btn" style="margin-top:0.5rem">+ إضافة فريق</a>
    </div>
  @endif

</div>

@endsection