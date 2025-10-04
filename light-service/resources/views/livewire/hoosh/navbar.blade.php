<nav class="navbar navbar-dark bg-{{ isAdmin() ? 'dark' : 'primary' }} px-4">
    <span class="navbar-brand"> {{ isAdmin() ? 'ناحیه کاربری مدیر' : 'داشبورد کاربر' }}</span>
    <button type="button" wire:click='logout' class="btn btn-warning">خروج</button>
</nav>
