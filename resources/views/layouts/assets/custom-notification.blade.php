@php
    $flash = session('success') ? ['text' => session('success'), 'type' => 'success'] : (session('error') ? ['text' => session('error'), 'type' => 'danger'] : (session('warning') ? ['text' => session('warning'), 'type' => 'warning'] : (session('info') ? ['text' => session('info'), 'type' => 'info'] : null)));
@endphp
@if($flash)
<div class="toast-container position-fixed bottom-0 end-0 p-3" id="notification-container"></div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var container = document.getElementById('notification-container');
    if (!container) return;
    var toast = document.createElement('div');
    toast.className = 'toast show align-items-center text-bg-{{ $flash['type'] }} border-0';
    toast.setAttribute('role', 'alert');
    toast.innerHTML = '<div class="d-flex"><div class="toast-body">' + @json($flash['text']) + '</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>';
    container.appendChild(toast);
    if (typeof bootstrap !== 'undefined') new bootstrap.Toast(toast).show();
});
</script>
@endif
