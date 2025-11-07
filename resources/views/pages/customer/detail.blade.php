@extends('components.master')

@section('style')
<style>
    .customer-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }
    .detail-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-bottom: 2rem;
    }
    .detail-title {
        color: #2c3e50;
        margin-bottom: 1.5rem;
        font-weight: 600;
        border-bottom: 3px solid #667eea;
        padding-bottom: 0.5rem;
    }
    .detail-item {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }
    .detail-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .detail-value {
        font-size: 1.1rem;
        color: #2c3e50;
        margin: 0;
    }
    .badge-gender {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        border-radius: 20px;
    }
    .btn-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 500;
        transition: transform 0.2s;
    }
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    .btn-back {
        background: #6c757d;
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 500;
    }
    .btn-back:hover {
        background: #5a6268;
    }
    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .form-control:disabled {
        background-color: #e9ecef;
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
<div class="customer-detail-container">
    <div class="detail-card">
        <h2 class="detail-title">รายละเอียดลูกค้า</h2>
        
        <div id="customerInfo">
            <div class="detail-item">
                <div class="detail-label">รหัสลูกค้า</div>
                <p class="detail-value" id="displayCardID">-</p>
            </div>
            <div class="detail-item">
                <div class="detail-label">ชื่อลูกค้า</div>
                <p class="detail-value" id="displayName">-</p>
            </div>
            <div class="detail-item">
                <div class="detail-label">เบอร์โทรศัพท์</div>
                <p class="detail-value" id="displayTel">-</p>
            </div>
            <div class="detail-item">
                <div class="detail-label">เพศ</div>
                <p class="detail-value">
                    <span class="badge badge-gender" id="displayGen">-</span>
                </p>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="button" class="btn btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editCustomerModal">
                <i class="bi bi-pencil-square"></i> แก้ไขข้อมูล
            </button>
            <a href="/customer/define" class="btn btn-secondary btn-back">
                <i class="bi bi-arrow-left"></i> กลับไปหน้าแรก
            </a>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">แก้ไขข้อมูลลูกค้า</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCustomerForm">
                    <div class="mb-3">
                        <label for="editCardID" class="form-label">รหัสลูกค้า</label>
                        <input type="text" class="form-control" id="editCardID" disabled>
                        <small class="form-text text-muted">ไม่สามารถแก้ไขรหัสลูกค้าได้</small>
                    </div>
                    <div class="mb-3">
                        <label for="editName" class="form-label">ชื่อลูกค้า</label>
                        <input type="text" class="form-control" id="editName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTel" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="editTel" required>
                    </div>
                    <div class="mb-3">
                        <label for="editGen" class="form-label">เพศ</label>
                        <select class="form-select" id="editGen" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="saveCustomerBtn">บันทึก</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    const customerDetail = [
        {id : 1 , cardID : "cus001" , name : "Foke" , tel : "809519186" , gen : "male"},
        {id : 2 , cardID : "cus002" , name : "Twor" , tel : "0123456789" , gen : "male"},
        {id : 3 , cardID : "cus003" , name : "khuat" , tel : "0123456789" , gen : "male"},
        {id : 4 , cardID : "cus004" , name : "fseff" , tel : "0123456789" , gen : "male"},
        {id : 5 , cardID : "cus005" , name : "fsrsseff" , tel : "0123456789" , gen : "male"}
    ];

    // เก็บข้อมูลปัจจุบันที่แก้ไข (ไม่แก้ไข array customerDetail จริง)
    let currentCustomerData = null;

    // ฟังก์ชันสำหรับดึง cardID จาก URL parameter
    function getCardIDFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('cardID');
    }

    // ฟังก์ชันสำหรับแสดงข้อมูลลูกค้า
    function displayCustomerData(customer) {
        document.getElementById('displayCardID').textContent = customer.cardID;
        document.getElementById('displayName').textContent = customer.name;
        document.getElementById('displayTel').textContent = customer.tel;
        
        const genBadge = document.getElementById('displayGen');
        genBadge.textContent = customer.gen === 'male' ? 'ชาย' : 'หญิง';
        genBadge.className = 'badge badge-gender ' + (customer.gen === 'male' ? 'bg-primary' : 'bg-danger');
    }

    // ฟังก์ชันสำหรับโหลดข้อมูลลูกค้าตาม cardID
    // ดึงข้อมูลจาก array customerDetail ใหม่ทุกครั้ง เพื่อให้ข้อมูล sync กับ array
    function loadCustomerData() {
        const cardID = getCardIDFromURL();
        
        if (!cardID) {
            Swal.fire({
                icon: 'error',
                title: 'ไม่พบรหัสลูกค้า',
                text: 'ไม่พบรหัสลูกค้าใน URL',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#dc3545'
            }).then(() => {
                window.location.href = '/customer/define';
            });
            return;
        }

        // ค้นหาข้อมูลลูกค้าจาก array customerDetail ใหม่ทุกครั้ง
        // เพื่อให้ข้อมูลที่แสดง sync กับ array เมื่อ array เปลี่ยน
        const foundCustomer = customerDetail.find(c => c.cardID.toLowerCase() === cardID.toLowerCase());
        
        if (!foundCustomer) {
            Swal.fire({
                icon: 'error',
                title: 'ไม่พบรหัสลูกค้านี้',
                text: `ไม่พบข้อมูลลูกค้าสำหรับรหัส "${cardID}"`,
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#dc3545'
            }).then(() => {
                window.location.href = '/customer/define';
            });
            return;
        }

        // สร้าง copy ใหม่จาก array ทุกครั้งที่โหลด
        // เพื่อให้ข้อมูล sync กับ array เมื่อ array เปลี่ยน
        currentCustomerData = JSON.parse(JSON.stringify(foundCustomer));
        
        // แสดงข้อมูลจาก array ล่าสุด
        displayCustomerData(currentCustomerData);
    }

    // ฟังก์ชันสำหรับโหลดข้อมูลลงใน form แก้ไข
    function loadDataToEditForm() {
        if (currentCustomerData) {
            document.getElementById('editCardID').value = currentCustomerData.cardID;
            document.getElementById('editName').value = currentCustomerData.name;
            document.getElementById('editTel').value = currentCustomerData.tel;
            document.getElementById('editGen').value = currentCustomerData.gen;
        }
    }

    // ฟังก์ชันสำหรับบันทึกข้อมูลที่แก้ไข
    function saveCustomerData() {
        const name = document.getElementById('editName').value.trim();
        const tel = document.getElementById('editTel').value.trim();
        const gen = document.getElementById('editGen').value;

        if (!name || !tel) {
            Swal.fire({
                icon: 'warning',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                text: 'โปรดกรอกชื่อและเบอร์โทรศัพท์',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#667eea'
            });
            return;
        }

        // อัปเดตข้อมูลปัจจุบันเท่านั้น (ไม่แก้ไข array customerDetail จริง)
        // เพื่อให้เมื่อรีเฟรชหน้า ข้อมูลจะกลับเป็นค่าจาก array ตามเดิม
        currentCustomerData.name = name;
        currentCustomerData.tel = tel;
        currentCustomerData.gen = gen;

        // แสดงข้อมูลที่อัปเดตแล้ว
        displayCustomerData(currentCustomerData);

        // ปิด modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('editCustomerModal'));
        modal.hide();

        Swal.fire({
            icon: 'success',
            title: 'บันทึกข้อมูลสำเร็จ',
            text: 'ข้อมูลลูกค้าถูกอัปเดตแล้ว (เมื่อรีเฟรชหน้าข้อมูลจะกลับเป็นค่าจาก array)',
            confirmButtonText: 'ตกลง',
            confirmButtonColor: '#28a745',
            timer: 3000
        });
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
        loadCustomerData();

        // เมื่อเปิด modal ให้โหลดข้อมูลลงใน form
        const editModal = document.getElementById('editCustomerModal');
        editModal.addEventListener('show.bs.modal', function() {
            loadDataToEditForm();
        });

        // เมื่อกดปุ่มบันทึก
        document.getElementById('saveCustomerBtn').addEventListener('click', function() {
            saveCustomerData();
        });

        // เมื่อกด submit form (ป้องกันการ submit อัตโนมัติ)
        document.getElementById('editCustomerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            saveCustomerData();
        });
    });

    // เมื่อรีเฟรชหน้า ข้อมูลจะกลับเป็นค่าจาก array customerDetail อัตโนมัติ
    // เพราะเราไม่แก้ไข array จริง แต่แก้ไขแค่ currentCustomerData เท่านั้น
    // เมื่อโหลดหน้าใหม่ loadCustomerData() จะดึงข้อมูลจาก array ใหม่เสมอ
</script>
@endsection

