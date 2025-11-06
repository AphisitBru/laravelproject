@extends('components.master')

@section('content')
<div class="row justify-content-center">
    <h2 class="mb-0 text-center">เครื่องคิดเลข</h2>
        <form id="calculatorForm">
            <div class="mb-3">
                <label for="num1" class="form-label">ตัวเลขที่ 1</label>
                <input type="text" class="form-control" id="num1" placeholder="กรอกตัวเลขแรก" required pattern="[0-9]+(\.[0-9]{1,2})?">
            </div>
            <div class="mb-3">
                <label for="operator" class="form-label">ตัวดำเนินการ</label>
                    <select class="form-select" id="operator" required>
                        <option value="+">บวก (+)</option>
                        <option value="-">ลบ (-)</option>
                        <option value="*">คูณ (*)</option>
                        <option value="/">หาร (/)</option>
                    </select>
            </div>
            <div class="mb-3">
                <label for="num2" class="form-label">ตัวเลขที่ 2</label>
                <input type="text" class="form-control" id="num2" placeholder="กรอกตัวเลขที่สอง" required pattern="[0-9]+(\.[0-9]{1,2})?">
            </div>    
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">คำนวณ</button>
            </div>
        </form>
@endsection

@section('script')
<script type="module">
    function calculate(num1, num2, operator) {
        if (operator === '/' && num2 === 0) {
            return { error: 'ไม่สามารถหารด้วยศูนย์ได้' };
        }
        
        let result = 0;
        switch(operator) {
            case '+': result = num1 + num2; break;
            case '-': result = num1 - num2; break;
            case '*': result = num1 * num2; break;
            case '/': result = num1 / num2; break;
            default: result = 0;
        }
        
        return { result };
    }

    function validateNumberInput(value) {
        value = value.replace(/[^0-9.]/g, '');
        
        const dotCount = (value.match(/\./g) || []).length;
        if (dotCount > 1) {
            const firstDotIndex = value.indexOf('.');
            value = value.substring(0, firstDotIndex + 1) + value.substring(firstDotIndex + 1).replace(/\./g, '');
        }
        
        if (value.includes('.')) {
            const parts = value.split('.');
            if (parts[1] && parts[1].length > 2) {
                value = parts[0] + '.' + parts[1].substring(0, 2);
            }
        }
        return value;
    }
    
    const num1Input = document.getElementById('num1');
    const num2Input = document.getElementById('num2');
    const operatorSelect = document.getElementById('operator');
    const calculatorForm = document.getElementById('calculatorForm');
    const answerElement = document.getElementById('answer');
    
    num1Input.addEventListener('input', function(e) {
        e.target.value = validateNumberInput(e.target.value);
    });
    
    num2Input.addEventListener('input', function(e) {
        e.target.value = validateNumberInput(e.target.value);
    });
    
    num1Input.addEventListener('paste', function(e) {
        e.preventDefault();
        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
        const validated = validateNumberInput(pastedText);
        e.target.value = validated;
    });
    
    num2Input.addEventListener('paste', function(e) {
        e.preventDefault();
        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
        const validated = validateNumberInput(pastedText);
        e.target.value = validated;
    });
    
    calculatorForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const num1 = parseFloat(num1Input.value);
        const num2 = parseFloat(num2Input.value);
        const operator = operatorSelect.value;
        
        if (isNaN(num1) || isNaN(num2)) {
            answerElement.textContent = 'กรุณากรอกตัวเลขที่ถูกต้อง';
            answerElement.classList.replace('text-warning', 'text-danger');
            return;
        }
        
        const calculation = calculate(num1, num2, operator);
        
        if (calculation.error) {
            answerElement.textContent = calculation.error;
            answerElement.classList.replace('text-warning', 'text-danger');
        } else {
            const formattedResult = calculation.result % 1 === 0 
                ? calculation.result.toString() 
                : parseFloat(calculation.result.toFixed(2));
            answerElement.textContent = formattedResult;
            answerElement.classList.replace('text-danger', 'text-warning');
        }
    });
</script>
@endsection