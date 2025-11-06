<header class="bg-primary text-white py-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0"><a href="{{ url('/') }}" class="text-white text-decoration-none">TestProject</a></h1>
            <nav class="d-flex gap-3 align-items-center">
                <a href="{{ url('/') }}" class="text-white text-decoration-none {{ request()->is('/') ? 'fw-bold' : '' }}">หน้าแรก</a>
                <a href="{{ url('/calculator') }}" class="text-white text-decoration-none {{ request()->is('calculator') ? 'fw-bold' : '' }}">เครื่องคิดเลข</a>
                <a href="{{ url('/customer/define') }}" class="text-white text-decoration-none {{ request()->is('customer/*') ? 'fw-bold' : '' }}">ค้นหาลูกค้า</a>
            </nav>
        </div>
    </div>
</header>

