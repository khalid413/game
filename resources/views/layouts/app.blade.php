<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>مسابقة المعرفة</title>
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
    --danger:  #ef4444;
    --success: #22c55e;
  }

  body {
    min-height: 100vh;
    background: var(--bg);
    font-family: 'Cairo', sans-serif;
    color: var(--text);
    overflow-x: hidden;
  }

  /* Blobs */
  .blob {
    position: fixed;
    border-radius: 50%;
    pointer-events: none;
    z-index: 0;
    filter: blur(80px);
  }
  .blob-1 { width: 500px; height: 500px; top: -150px; left: -150px;  background: rgba(78,205,196,0.12); }
  .blob-2 { width: 400px; height: 400px; bottom: -120px; right: -100px; background: rgba(43,181,171,0.10); }
  .blob-3 { width: 280px; height: 280px; top: 45%; left: 48%; background: rgba(247,201,72,0.06); }

  /* Navbar */
  .navbar {
    position: sticky;
    top: 0;
    z-index: 100;
    background: rgba(22, 37, 52, 0.85);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--border);
    padding: 0 1.5rem;
    height: 66px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
  }

  .navbar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
  }

  .brand-icon {
    width: 42px; height: 42px;
    background: linear-gradient(135deg, var(--accent2), var(--accent));
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    box-shadow: 0 4px 16px rgba(78,205,196,0.3);
    flex-shrink: 0;
  }

  .brand-text {
    font-size: 20px;
    font-weight: 900;
    background: linear-gradient(90deg, var(--accent), var(--gold));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .nav-links {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  .nav-link {
    text-decoration: none;
    font-family: 'Cairo', sans-serif;
    font-size: 14px;
    font-weight: 700;
    padding: 8px 18px;
    border-radius: 50px;
    border: 1.5px solid var(--border);
    color: var(--muted);
    background: transparent;
    transition: color 0.2s, border-color 0.2s, background 0.2s, transform 0.18s;
  }

  .nav-link:hover {
    color: var(--accent);
    border-color: var(--accent);
    background: rgba(78,205,196,0.08);
    transform: translateY(-2px);
  }

  .nav-link.play {
    background: linear-gradient(135deg, var(--accent2), var(--accent));
    border-color: transparent;
    color: #0f1f2e;
  }

  .nav-link.play:hover {
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 6px 22px rgba(78,205,196,0.4);
    color: #0f1f2e;
  }

  .nav-link.results {
    border-color: rgba(247,201,72,0.35);
    color: var(--gold);
  }

  .nav-link.results:hover {
    border-color: var(--gold);
    background: rgba(247,201,72,0.08);
    color: var(--gold);
  }

  /* Page wrapper */
  .page-wrap {
    position: relative;
    z-index: 1;
    max-width: 1100px;
    margin: 0 auto;
    padding: 2.5rem 1.2rem 4rem;
  }

  /* Alerts */
  .alert {
    border-radius: 14px;
    padding: 14px 20px;
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 1.4rem;
    border: 1.5px solid;
    animation: slideDown 0.4s cubic-bezier(0.16,1,0.3,1) both;
  }

  .alert-success {
    background: rgba(34,197,94,0.1);
    border-color: rgba(34,197,94,0.35);
    color: #86efac;
  }

  .alert-danger {
    background: rgba(239,68,68,0.1);
    border-color: rgba(239,68,68,0.35);
    color: #fca5a5;
  }

  .alert ul { padding-right: 1.2rem; margin: 0; }

  @keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  @media (max-width: 560px) {
    .brand-text { display: none; }
    .nav-link   { font-size: 13px; padding: 7px 14px; }
  }
  </style>
</head>
<body>

<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>

<!-- Navbar -->
<nav class="navbar">
  <a href="{{ route('home') }}" class="navbar-brand">
    <div class="brand-icon">🏆</div>
    <span class="brand-text">مسابقة المعرفة</span>
  </a>
  <div class="nav-links">
    <a href="{{ route('teams.index') }}"     class="nav-link">الفرق</a>
    <a href="{{ route('questions.index') }}" class="nav-link">الأسئلة</a>
    <a href="{{ route('results.index') }}"   class="nav-link results">النتائج 🏅</a>
    <a href="{{ route('game.selectTeam') }}" class="nav-link play">العب ←</a>
  </div>
</nav>

<!-- Content -->
<div class="page-wrap">

  @if(session('success'))
    <div class="alert alert-success">✓ {{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">✕ {{ session('error') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @yield('content')

</div>

</body>
</html>