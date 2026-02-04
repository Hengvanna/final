<!-- Sidebar -->
<div class="sidebar" data-background-color="white">
    <div class="sidebar-wrapper">
        <div class="sidebar-content">
            <ul class="nav nav-idg flex-column">
                <x-admin.layout.sidebar.menu :title="__('Dashboard')" :icon="'fas fa-th'" :route="route('dashboard')" />
                <x-admin.layout.sidebar.menu :title="__('Categories')" :icon="'fas fa-folder'" :route="route('categories.index')" :activePattern="'categories*'" />
                <x-admin.layout.sidebar.menu :title="__('Stock')" :icon="'fas fa-boxes'" :route="route('stocks.index')" :activePattern="'stocks*'" />
                <x-admin.layout.sidebar.menu :title="__('Sales')" :icon="'fas fa-shopping-cart'" :route="route('sales.index')" :activePattern="'sales*'" />
                <x-admin.layout.sidebar.menu :title="__('Report Stock')" :icon="'fas fa-chart-line'" :route="route('reports.stock')" :activePattern="'reports*'" />
            </ul>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var trigger = document.querySelector('a[data-bs-target="#reportSubmenu"]');
                    var submenu = document.getElementById('reportSubmenu');
                    var arrow = trigger ? trigger.querySelector('.submenu-arrow') : null;
                    if (trigger && submenu && arrow) {
                        submenu.addEventListener('show.bs.collapse', function() { arrow.style.transform = 'rotate(180deg)'; });
                        submenu.addEventListener('hide.bs.collapse', function() { arrow.style.transform = 'rotate(0deg)'; });
                        if (submenu.classList.contains('show')) arrow.style.transform = 'rotate(180deg)';
                    }
                });
            </script>
        </div>
    </div>
</div>
<!-- End Sidebar -->
