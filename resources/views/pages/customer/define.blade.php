@extends('components.master')

@section('style')
<style>
    .customer-search-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .search-title {
        color: #2c3e50;
        margin-bottom: 1.5rem;
        font-weight: 600;
    }
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    .btn-search {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: transform 0.2s;
    }
    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
</style>
@endsection

@section('content')
<div class="customer-search-container">
    <h2 class="search-title text-center">ค้นหารหัสลูกค้า</h2>
    <form id="customerSearchForm">
        <div class="mb-4">
            <label for="cardID" class="form-label">รหัสลูกค้า</label>
            <input 
                type="text" 
                class="form-control form-control-lg" 
                id="cardID" 
                name="cardID"
                placeholder="กรุณากรอกรหัสลูกค้า (เช่น cus001)" 
                required
                autocomplete="off"
            >
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-search btn-lg">
                <i class="bi bi-search"></i> ค้นหา
            </button>
        </div>
    </form>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const customer = [
        {id : 1 , cardID : "cus001"},
        {id : 2 , cardID : "cus002"},
        {id : 3 , cardID : "cus003"}
    ];

    document.getElementById('customerSearchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const cardID = document.getElementById('cardID').value.trim();
        
        if (!cardID) {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณากรอกรหัสลูกค้า',
                text: 'โปรดกรอกรหัสลูกค้าก่อนค้นหา',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#667eea'
            });
            return;
        }

        // ค้นหาใน array customer
        const foundCustomer = customer.find(c => c.cardID.toLowerCase() === cardID.toLowerCase());
        
        if (foundCustomer) {
            // ถ้าเจอ ให้ redirect ไปหน้า detail พร้อมส่ง cardID
            window.location.href = `/customer/detail?cardID=${encodeURIComponent(cardID)}`;
        } else {
            // ถ้าไม่เจอ แสดง sweetalert
            Swal.fire({
                icon: 'error',
                title: 'ไม่พบรหัสลูกค้านี้',
                text: `ไม่พบรหัสลูกค้า "${cardID}" ในระบบ`,
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#dc3545'
            });
        }
    });

    // Focus ที่ input เมื่อโหลดหน้า
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('cardID').focus();
    });
</script>
@endsection

